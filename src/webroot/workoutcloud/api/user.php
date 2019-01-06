<?php
// Load data model (comes with the environment)
require("model/data_functions.php");
require("model/message_functions.php");

// Initialize JWT class
use \Firebase\JWT\JWT;

// Initiiate the Slim framework
$slimapi = new \Slim\Slim();
$reqbody = $slimapi->request->getBody();
// Prepare the database data objects with data provided in the request body
$bodyDecoded = json_decode($reqbody, true);

$slimapi->add(new \Slim\Middleware\JwtAuthentication([
    "secret" => $ENV_VARS["JWT_SECRET_KEY"],
    "rules" => [
        new \Slim\Middleware\JwtAuthentication\RequestPathRule([
            "path" => "/",
            "passthrough" => ["/login", "/register", "/fbsignin", "/confirm", "/search", "/public", "/passwordRecovery", "/debug"]
        ])],
    "callback" => function ($options) use ($slimapi) {
        // Store the token data for usage in routes
        $slimapi->jwt = (array) $options["decoded"];

        if(isset($slimapi->jwt->unconfirmed)){
            $slimapi->halt(409, 'Unconfirmed.');
        }
        // Add a closure middleware helping to recreate the JWT during a lasting session
        /* $slimapi->add(function($request, $response, $next){
            $response = $next($request, $response);
            $response->header()
        }); */
    },
    "error" => function ($arguments) use ($slimapi) {
        return $slimapi->response->write(var_dump($arguments));
    }
]));

$slimapi->get('/debug', function() use ($slimapi){
            //echo password_hash("BETAlaunch16", PASSWORD_DEFAULT);
            echo "Nothing to see here!";
    });

// Function to get the token data in case only some data needs to be handed over to the function
function getToken(){
    global $ENV_VARS;
    if(($server_header = getenv("HTTP_AUTHORIZATION") ) !== false){
        $tokenArray = explode(" ", $server_header);
        if($tokenArray[0] === "Bearer"){
            $tokenDecoded = (array) JWT::decode($tokenArray[1], $ENV_VARS["JWT_SECRET_KEY"], array('HS256'));
        } else {
            $tokenDecoded = [""];
        }
    } else {
        $tokenDecoded = [""];
    }
    return $tokenDecoded;
}

// USER AUTH //////////////////////////////////////////

// User login using email and pass
$slimapi->post('/login', function() use ($slimapi, $bodyDecoded) {
    global $ENV_VARS;

    // Search user by email
    $userArr = neo4j_authUserByEmail($bodyDecoded["email"]);

    // Compare credentials
    if(count($userArr) == 1){
        if(password_verify($bodyDecoded['password'], $userArr[0]->password)){
            // Password correct
            // Check if mail address is confirmed
            if($userArr[0]->confirmed){
                // User is valid. Create token.
                $issuedTime = time();
                $token = array("name" => $userArr[0]->name,
                                "user_id" => $userArr[0]->user_id,
                                "iat" => $issuedTime,
                                "exp" => ($issuedTime + 48 * 60));
                $response = array("token"=>JWT::encode($token, $ENV_VARS["JWT_SECRET_KEY"]), "status" => 200, "data" => "Successfully logged in.");
            } else {
                $slimapi->halt(409, 'Unconfirmed.');
            }
        } else {
            // Password incorrect.
            $slimapi->halt(409, 'Wrong password.');
        }
    } else {
        // User not found
        $slimapi->halt(409, 'User not found.');
    }

    $return = json_encode($response);

    echo $return;
});

$slimapi->post('/register', function() use ($slimapi, $bodyDecoded){
    global $ENV_VARS;

    // Check if user already exists
    // Search by email
    $userArr = neo4j_authUserByEmail($bodyDecoded["email"]);

    if(count($userArr) == 0){
        // Build data object
        $newUser = new data_userProfileFull();
        $newUser->name = $bodyDecoded["displayName"];
        $newUser->email = $bodyDecoded["email"];
        $newUser->user_id = bin2hex(openssl_random_pseudo_bytes(8));
        $newUser->password = password_hash($bodyDecoded["password"], PASSWORD_DEFAULT);
        $newUser->locale = $bodyDecoded["locale"];
        // Attach customizer info if available
        if(isset($bodyDecoded["gender"])){
            $newUser->gender = $bodyDecoded["gender"];
        }
        if(isset($bodyDecoded["preferences"])){
            $newUser->preferences = [
                            "difficulty" => (isset($bodyDecoded["preferences"]["difficulty"]) ? $bodyDecoded["preferences"]["difficulty"] : [2.0, 4.0]),
                             "dimensions" => (isset($bodyDecoded["preferences"]["dimensions"]) ? $bodyDecoded["preferences"]["dimensions"] : []),
                             "motives" => (isset($bodyDecoded["preferences"]["motives"]) ? $bodyDecoded["preferences"]["motives"] : ["Healthy"]),
                             "frequency" => (isset($bodyDecoded["preferences"]["frequency"]) ? $bodyDecoded["preferences"]["frequency"] : 3)
                             ];
        }
        $newUser->confirmed = false;
        $newUser->confirmationCode = bin2hex(openssl_random_pseudo_bytes(8));
        // Prepare the arrays of motives and dimensions to which the new user should get connected
        // Create user
        if(count(neo4j_createUser($newUser)) != 0){
            // Send the email for registration and create token if successfull
            if(sendRegistrationMail($newUser->email, $newUser->name, $newUser->locale, $newUser->confirmationCode)) {
                // Create temporary token
                $issuedTime = time();
                $token = array("name" => $newUser->name,
                                "user_id" => $newUser->user_id,
                                "unconfirmed" => true,
                                "iat" => $issuedTime,
                                "exp" => ($issuedTime + 2 * 60));
                $response = array("token"=>JWT::encode($token, $ENV_VARS["JWT_SECRET_KEY"]), "status" => 200, "data" => "Accout created.");
            } else {
                $slimapi->halt(409, "Registration email not sent.");
            }
        } else {
            // Error on user creation
            $slimapi->halt(409, 'Something crashed.');
        }
    } else {
        // User duplicate
        $slimapi->halt(409, 'User duplicate.');
    }

    $return = json_encode($response);

    echo $return;
});

$slimapi->post('/confirm', function() use ($slimapi, $bodyDecoded){
    global $ENV_VARS;

    if(isset($bodyDecoded["confirmationCode"])){
        // Look up user by confirmationCode and set the confirmed status 'true'
        // (Function returns true if change was successfull)
        $confirmed = neo4j_confirmUserMail($bodyDecoded["confirmationCode"]);

        if($confirmed["count"]){
            sendConfirmationMail($confirmed["email"], $confirmed["name"], $confirmed["locale"]);
            // If the temporary register token still exists, create a real token.
            // Otherwise user needs to log in again. (Same device/ same session security strategy)
            $tempTokenData = getToken();

            if(array_key_exists("user_id", $tempTokenData)){
                // Token exists, get user data and create new one
                $issuedTime = time();
                $token = array("name" => $tempTokenData["name"],
                                "user_id" => $tempTokenData["user_id"],
                                "iat" => $issuedTime,
                                "exp" => ($issuedTime + 48 * 60));
                $response = array("token"=>JWT::encode($token, $ENV_VARS["JWT_SECRET_KEY"]), "status" => 200, "data" => "Confirmed and logged in.");
            } else {
                $response = array("status" => 200, "data" => "Successfully confirmed.");
            }
        } else {
            $slimapi->halt(409, 'Code invalid or already confirmed.');
        }
    } else {
        $slimapi->halt(409, 'No code supplied.');
    }
});

$slimapi->post('/fbsignin', function() use ($slimapi, $bodyDecoded){
    global $ENV_VARS;

    if(isset($bodyDecoded["code"])){
        // Connect to facebook and get data
       $params = [
            'code' => $bodyDecoded["code"],
            'client_id' => $bodyDecoded["clientId"],
            'redirect_uri' => $bodyDecoded["redirectUri"],
            'client_secret' => $ENV_VARS["FB_SECURE_KEY"]
        ];

        // Exchange authorization code for access token.
        $guzzleClient = new GuzzleHttp\Client();

        $guzzleResponse = $guzzleClient->get($ENV_VARS["FB_OAUTH_PATH"], ['query' => $params]);
        $body = json_decode((string)$guzzleResponse->getBody(),true);

         // Step 2. Retrieve profile information about the current user.
        $guzzleResponse = $guzzleClient->get($ENV_VARS["FB_GRAPH_PATH"].'?fields=id,name,email,picture,friends,locale,link&access_token='.$body['access_token']);
        $profile = json_decode((string)$guzzleResponse->getBody(),true);

    if(isset($profile["id"])){
        // Check whether user can be found by fbid
        $userArr = neo4j_getUserByFB($profile["id"]);
        // Get picture, email and friendlist
        if(count($userArr) != 0){
            // User in db so update info (like email or picture) and create token
            // First prepare the facebook image url and the name of the file
            $imgUrl = explode("?", $profile["picture"]["data"]["url"])[0];
            $uname = str_replace(" ", "", $profile["name"]);
            $uname = preg_replace("/[^A-Za-z0-9\-]/", "", $uname);
            $uname = preg_replace("/-+/", "-", $uname);
            $image_type = array_pop(explode(".", $imgUrl));
            // Now copy image to local filesystem
            //copy($profile["picture"]["data"]["url"], __DIR__.'/../view/images/user/profile/'.$uname.".".$image_type);
            // Built neo4j object
            $updateUser = new data_userProfileFull();
            // Get old values
            $updateUser = $userArr[0];
            // Now overwrite with actualized data
            $updateUser->name = $profile["name"];
            $updateUser->email = $profile["email"];
            $updateUser->picPath = $uname.".".$image_type;
            $updateUser->locale = $profile["locale"];
            $updateUser->confirmed = true;
            // Update user
            if(count(neo4j_updateUserProfile($updateUser)) != 0){
                // Create user token
                $issuedTime = time();
                $token = array("name" => $userArr[0]->name,
                                "user_id" => $userArr[0]->user_id,
                                "iat" => $issuedTime,
                                "exp" => ($issuedTime + 48 * 60));
                $response = array("token"=>JWT::encode($token, $ENV_VARS["JWT_SECRET_KEY"]), "status" => 200, "data" => "Successfully logged in.");
            } else {
                $slimapi->halt(409, 'Something crashed.');
            }

        // Insert find by email again
        } else {
            // Check whether user already logged in with the email used for fb, too, and merge accounts if so.
            $userArr = neo4j_authUserByEmail($profile["email"]);
            if(count($userArr) != 0){
                // First prepare the facebook image url and the name of the file
                $imgUrl = explode("?", $profile["picture"]["data"]["url"])[0];
                $uname = str_replace(" ", "", $profile["name"]);
                $uname = preg_replace("/[^A-Za-z0-9\-]/", "", $uname);
                $uname = preg_replace("/-+/", "-", $uname);
                $image_type = array_pop(explode(".", $imgUrl));
                // Now copy image to local filesystem
                copy($profile["picture"]["data"]["url"], __DIR__.'/../view/images/user/profile/'.$uname.".".$image_type);
                // Built neo4j object
                $updateUser = new data_userProfileFull();
                // Get old values
                $updateUser = $userArr[0];
                // Now overwrite with the new/ actualized data
                $updateUser->fbid = $profile["id"];
                $updateUser->picPath = $uname.".".$image_type;
                $updateUser->locale = $profile["locale"];
                $updateUser->confirmed = true;
                // Update user
                if(count(neo4j_updateUserProfile($updateUser)) != 0){
                    // Create user token
                    $issuedTime = time();
                    $token = array("name" => $userArr[0]->name,
                                    "user_id" => $userArr[0]->user_id,
                                    "iat" => $issuedTime,
                                    "exp" => ($issuedTime + 48 * 60));
                    $response = array("token"=>JWT::encode($token, $ENV_VARS["JWT_SECRET_KEY"]), "status" => 200, "data" => "Merged accounts and logged in.");
                } else {
                    $slimapi->halt(409, 'Something crashed.');
                }
            } else {
                // User could neither be found by fbid nor by email
                // If user authenticated but could not be found in the db by fbid or email, create a new user
                // First prepare the facebook image url and the name of the file
                $imgUrl = explode("?", $profile["picture"]["data"]["url"])[0];
                $uname = str_replace(" ", "", $profile["name"]);
                $uname = preg_replace("/[^A-Za-z0-9\-]/", "", $uname);
                $uname = preg_replace("/-+/", "-", $uname);
                $image_type = array_pop(explode(".", $imgUrl));
                // Now copy image to local filesystem
                copy($profile["picture"]["data"]["url"], __DIR__.'/../view/images/user/profile/'.$uname.".".$image_type);
                // Build data object
                $newUser = new data_userProfileFull();
                $newUser->name = $profile["name"];
                $newUser->email = $profile["email"];
                $newUser->picPath = $uname.".".$image_type;
                $newUser->contact = $profile["link"];
                $newUser->confirmed = true;
                $newUser->fbid = $profile["id"];
                $newUser->user_id = bin2hex(openssl_random_pseudo_bytes(8));
                // Create random password to prevent entering without password
                $newUser->password = password_hash(bin2hex(openssl_random_pseudo_bytes(8)), PASSWORD_DEFAULT);
                $newUser->locale = $profile["locale"];
                // Attach customizer info if available
                if(isset($bodyDecoded["gender"])){
                    $newUser->gender = $bodyDecoded["gender"];
                }
                if(isset($bodyDecoded["preferences"])){
                    $newUser->preferences = [
                                "difficulty" => (isset($bodyDecoded["preferences"]["difficulty"]) ? $bodyDecoded["preferences"]["difficulty"] : [2.0, 4.0]),
                                "dimensions" => (isset($bodyDecoded["preferences"]["dimensions"]) ? $bodyDecoded["preferences"]["dimensions"] : []),
                                "motives" => (isset($bodyDecoded["preferences"]["motives"]) ? $bodyDecoded["preferences"]["motives"] : ["Healthy"]),
                                "frequency" => (isset($bodyDecoded["preferences"]["frequency"]) ? $bodyDecoded["preferences"]["frequency"] : 3)
                             ];
                }
                // Create user
                if(count(neo4j_createUser($newUser)) != 0){
                    // User created. Build token.
                    $issuedTime = time();
                    $token = array("name" => $newUser->name,
                                    "user_id" => $newUser->user_id,
                                    "iat" => $issuedTime,
                                    "exp" => ($issuedTime + 48 * 60));
                    $response = array("token"=>JWT::encode($token, $ENV_VARS["JWT_SECRET_KEY"]), "status" => 200, "data" => "Account created and logged in.");
                } else {
                    // Error on user creation
                    $slimapi->halt(409, 'Something crashed.');
                }
            }
        }
    } else {
         $slimapi->halt(409, 'Not authenticated with facebook.');
    }

    $return = json_encode($response);

    echo $return;
    }
});

// GENERAL USER DATA API /////////
// READING   /////////
    // Search for a user by name
    $slimapi->get('/search/:string(/:limit)(/:skip)', function($string, $limit = 5, $skip = 0) use ($slimapi){
        // Casting of numeric values
        $limit = (int)$limit;
        $skip = (int)$skip;
        // Get the token data (if available)
        $userData = getToken();

        $userMatches = [];
        $userMatches = neo4j_searchUserByName($string, $limit, $skip);

        // Get sample workouts
        for($i = 0; $i < count($userMatches); $i++){
            $userMatches[$i]->sampleWorkouts = neo4j_getUserCreatedWorkouts($userMatches[$i]->user_id, 3, 0);
        }
        // If the user is logged in, check if there's a following
        if(array_key_exists("user_id", $userData)){
            for($i = 0; $i < count($userMatches); $i++){
                $userMatches[$i]->isFollowed = neo4j_userFollowedUser($userData["user_id"], $userMatches[$i]->user_id);
            }
        }

        $return = json_encode($userMatches);

        echo $return;
    });

    // Get user by ID
    $slimapi->get('/public/:uid', function($uid) use ($slimapi){
        // Get the token data (if available)
        $me = getToken();
        // Now get the profile info of the given user
        $userProfile = neo4j_getUserByID($uid)[0];
        // If the user couldn't be found, throw an error and exit
        if(isset($userProfile->user_id)){
            // Remove password hash to be shown outside
            unset($userProfile->password);
            // Get sample workouts
            $userProfile->sampleWorkouts = neo4j_getUserCreatedWorkouts($userProfile->user_id, 10, 0);
            // If there is me logged in, check if there's a following
            if(array_key_exists("user_id", $me)){
                $userProfile->isFollowed = neo4j_userFollowedUser($me["user_id"], $userProfile->user_id);
            }

            $return = json_encode($userProfile);

            echo $return;
        } else {
            $slimapi->halt(403, 'Unknown user.');
        }
    });

    // Get people followed by a user
    $slimapi->get('/follows(/:limit)(/:skip)', function($limit = 10, $skip = 0) use ($slimapi){
        if(isset($slimapi->jwt["user_id"])){
            $uid = $slimapi->jwt["user_id"];
            // Casting of numeric values
            $limit = (int)$limit;
            $skip = (int)$skip;

            $followers = [];
            $followers = neo4j_getFollowers($uid, $skip, $limit, "followed_by_user");

            // Get sample workouts
            for($i = 0; $i < count($followers); $i++){
                $followers[$i]->sampleWorkouts = neo4j_getUserCreatedWorkouts($followers[$i]->user_id, 3, 0);
                $followers[$i]->isFollowed = neo4j_userFollowedUser($uid, $followers[$i]->user_id);
            }

            $return = json_encode($followers);

            echo $return;
        } else {
           $slimapi->halt(403, 'Not logged in.');
        }
    });

    // Get people following a user
    $slimapi->get('/followed(/:limit)(/:skip)', function($limit = 10, $skip = 0) use ($slimapi) {
        if(isset($slimapi->jwt["user_id"])){
            $uid = $slimapi->jwt["user_id"];
            // Casting of numeric values
            $limit = (int)$limit;
            $skip = (int)$skip;

            $following = [];
            $following = neo4j_getFollowers($uid, $skip, $limit, "following_user");

            // Get sample workouts
            for($i = 0; $i < count($following); $i++){
                $following[$i]->sampleWorkouts = neo4j_getUserCreatedWorkouts($following[$i]->user_id, 3, 0);
                $following[$i]->isFollowed = neo4j_userFollowedUser($uid, $following[$i]->user_id);
            }

            $return = json_encode($following);

            echo $return;
        } else {
            $slimapi->halt(403, 'Not logged in.');
        }
    });

// Start reset password process
$slimapi->post('/passwordRecovery', function() use ($slimapi, $bodyDecoded){
    global $ENV_VARS;

    if(isset($bodyDecoded["resetEmail"])){
        //-- If there is already a token, an email and a new password passed, check again if the token is valid and overwrite
        // the old password if so.
        if(isset($bodyDecoded["resetToken"])){
            if(isset($bodyDecoded["newPassword"])){
                // Check, if there is a user with the passed email
                $userArr = neo4j_authUserByEmail($bodyDecoded["resetEmail"]);
                // Extract the information of the passed token
                try{
                    $resetTokenExtracted = (array) JWT::decode($bodyDecoded["resetToken"], $ENV_VARS["JWT_SECRET_KEY"], array('HS256'));
                    if(count($userArr) != 0){
                        $requestedToken = neo4j_getPWResetToken($userArr[0]->user_id);
                        if( ($requestedToken == $bodyDecoded["resetToken"]) && ($resetTokenExtracted["email"] == $bodyDecoded["resetEmail"]) ){
                            // Token is existant, now check if it hasn't expired.
                            if($resetTokenExtracted["exp"] >= time()){
                                // Token is still valid so everything is fine - reset password now
                                $return = neo4j_setUserPassword($userArr[0]->user_id, password_hash($bodyDecoded["newPassword"], PASSWORD_DEFAULT));
                                echo $return;
                            } else {
                                $slimapi->halt(403, 'Reset token expired.');
                            }
                        } else {
                            $slimapi->halt(403, 'Reset token wrong.');
                        }
                    } else {
                        $slimapi->halt(403, 'Email matched no account.');
                    }
                } catch(\Exception $e){
                    $slimapi->halt(403, 'Reset token expired.');
                }

            } else {
                //-- If there is only the resetEmail and a token passed, check if the token is valid and return the result
                // Check, if there is a user with the passed email
                $userArr = neo4j_authUserByEmail($bodyDecoded["resetEmail"]);
                // Extract the information of the passed token
                try{
                    $resetTokenExtracted = (array) JWT::decode($bodyDecoded["resetToken"], $ENV_VARS["JWT_SECRET_KEY"], array('HS256'));
                    if(count($userArr) != 0){
                        $requestedToken = neo4j_getPWResetToken($userArr[0]->user_id);
                        // Return true only if the token is the same as the one passed, the email passed is matching the one in the token and the token is still valid
                        echo ( ($requestedToken == $bodyDecoded["resetToken"]) && ($resetTokenExtracted["exp"] >= time()) && ($resetTokenExtracted["email"] == $bodyDecoded["resetEmail"]) );
                    } else {
                        $slimapi->halt(403, 'Email matched no account.');
                    }
                } catch(\Exception $e){
                    $slimapi->halt(403, 'Reset token expired.');
                }

            }
        } else {
        //-- If there is nothing more than the email passed on this route, initiate the process
        // by creating a reset token, send the reset mail and remark the corresponding user account with that credentials
            // Create a new token
            $tokenRaw = array("email" => $bodyDecoded["resetEmail"], "exp" => (time() + 48 * 60));
            $token = JWT::encode($tokenRaw, $ENV_VARS["JWT_SECRET_KEY"]);
            // Attach the token to the account connected with the passed email
            // But check first, if there is a user with the passed email
            $userArr = neo4j_authUserByEmail($bodyDecoded["resetEmail"]);
            if(count($userArr) != 0){
                neo4j_setPWResetToken($userArr[0]->user_id, $token);
                // Send the email with the token
                if(sendPWResetMail($userArr[0]->email, $userArr[0]->name, $userArr[0]->locale, $token)) {
                    echo true;
                } else {
                    $slimapi->halt(403, "Password reset email not sent.");
                }
            } else {
                $slimapi->halt(403, 'Email matched no account.');
            }
        }
    } else {
        $slimapi->halt(403, 'No email passed.');
    }
});

// Single user related requests
$slimapi->group('/me', function() use ($slimapi, $bodyDecoded){
    // Get profile info (displayable)
    $slimapi->get('', function() use ($slimapi){
        if(isset($slimapi->jwt["user_id"])){
            $uid = $slimapi->jwt["user_id"];
            $user = neo4j_getUserByID($uid)[0];
            // Remove password hash from being shown public
            unset($user->password);
            $return = json_encode($user);
            echo $return;
        } else {
            $slimapi->halt(403, 'Not logged in.');
        }
    });
    // Update user profile (displayable info)
    $slimapi->put('', function() use ($slimapi, $bodyDecoded){
        if(isset($slimapi->jwt["user_id"])){
            $uid = $slimapi->jwt["user_id"];
            // Get old info first to prevent any unwanted data changes
            $profileData = neo4j_getUserByID($uid)[0];
            // Now set new data
            $profileData->name = $bodyDecoded["name"];
            $profileData->user_id = $uid;
            $profileData->email = $bodyDecoded["email"];
            $profileData->picPath = $bodyDecoded["picPath"];
            $profileData->contact = $bodyDecoded["contact"];
            $profileData->visible = $bodyDecoded["visible"];
            $profileData->shortBio = $bodyDecoded["shortBio"];
            $profileData->gender = $bodyDecoded["gender"];
            $profileData->preferences = [
                                    "difficulty" => $bodyDecoded["preferences"]["difficulty"],
                                     "dimensions" => $bodyDecoded["preferences"]["dimensions"],
                                     "motives" => $bodyDecoded["preferences"]["motives"],
                                     "frequency" => $bodyDecoded["preferences"]["frequency"]
                                    ];
            // As changing the profile is only possible after completed confirmation,
            // make sure, user stays confirmed.
            $profileData->confirmed = true;

            // Now push the data to the backend and receive the updated profile
            $updatedProfile = neo4j_updateUserProfile($profileData);
            $return = json_encode($updatedProfile[0]);
            echo $return;
        } else {
            $slimapi->halt(403, 'Not logged in.');
        }
    });

    // Delete user account process
    $slimapi->delete('', function() use($slimapi) {
        if(isset($slimapi->jwt["user_id"])){
            $uid = $slimapi->jwt["user_id"];

        } else {
            $slimapi->halt(403, 'Not logged in.');
        }
    });

    // Update password process
    $slimapi->put('/setPassword', function() use ($slimapi, $bodyDecoded){
        if(isset($slimapi->jwt["user_id"])){
            $uid = $slimapi->jwt["user_id"];
            $return = neo4j_setUserPassword($uid, password_hash($bodyDecoded["newPassword"], PASSWORD_DEFAULT));
            echo $return;
        } else {
            $slimapi->halt(403, 'Not logged in.');
        }
    });
});

// Following other users
    $slimapi->post('/follow/:passiveUid', function($passiveUid) use ($slimapi) {
        if(isset($slimapi->jwt["user_id"])){
            $uid = $slimapi->jwt["user_id"];

            $isFollowing = neo4j_followUnfollow($uid, $passiveUid);

            echo $isFollowing;
        } else {
            $slimapi->halt(403, 'Not logged in.');
        }
    });

$slimapi->run();

?>
