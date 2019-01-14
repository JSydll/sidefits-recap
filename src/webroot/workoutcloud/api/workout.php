<?php
// Load data model
require("model/data_functions.php");

// Initialize JWT class
use \Firebase\JWT\JWT;

// Initiiate the Slim framework
$slimapi = new \Slim\Slim();
$reqbody = $slimapi->request->getBody();
// Prepare the database data objects with data provided in the request body
$bodyDecoded = json_decode($reqbody, true);

$slimapi->add(new \Slim\Middleware\JwtAuthentication([
    "secure" => false, // For development only
    "secret" => $ENV_VARS["JWT_SECRET_KEY"],
    "rules" => [
        new \Slim\Middleware\JwtAuthentication\RequestPathRule([
            "path" => "/user",
            "passthrough" => []
        ])],
    "callback" => function ($options) use ($slimapi) {
        // Store the token data for usage in routes
        $slimapi->jwt = (array)$options["decoded"];

        // Check expiration date
        /* if($slimapi->jwt->exp < time()){
            $slimapi->halt(403, 'Your session expired. Please login again.');
        } */
    }
]));

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
// WORKOUT RELATED READING FUNCTIONS
// Workout by ID
    $slimapi->get('/:id', function($id){
        // Casting of numeric values
        $id = (int)$id;

        // Getting the result
        $queryResult = neo4j_getWorkoutByID($id);

        $return = json_encode($queryResult);

        echo $return;
    });

    // Full view of a workout
    $slimapi->get('/:id/full', function($id) use ($reqbody) {
        // Get the token data
        $userData = getToken();

        // Casting of numeric values
        $id = (int)$id;

        $workoutResult = new data_workoutFull();
        // Check the request body if there's already some data
        if($reqbody != ""){
            $prevData = new data_workoutPreview();
            // Decode the body and write data to object
            $bodyDecoded = json_decode($reqbody, true);

            // Write the data from the body into the object
            $prevData->name = $bodyDecoded["name"];
            $prevData->workout_id = $bodyDecoded["workout_id"];
            $prevData->dimensions = $bodyDecoded["dimensions"];
            $prevData->roundCount = $bodyDecoded["roundCount"];
            $prevData->exCount = $bodyDecoded["exCount"];
            $prevData->difficulty = $bodyDecoded["difficulty"];
            $prevData->duration = $bodyDecoded["duration"];
            $prevData->picPath = $bodyDecoded["picPath"];
            $prevData->creator_name = $bodyDecoded["creator_name"];
            $prevData->creator_id = $bodyDecoded["creator_user_id"];
            $prevData->creator_picPath = $bodyDecoded["creator_picPath"];
            $prevData->creator_shortBio = $bodyDecoded["creator_shortBio"];

            // Now send the data request
            $workoutResult = data_getWorkoutFull($id, $prevData);
        } else {
            // Get the full exercise from scratch
            $workoutResult = data_getWorkoutFull($id);
        }

        if(array_key_exists("user_id", $userData)){
            $uid = $userData["user_id"];
            // Check if user liked the workout and if following the creator
            $workoutResult->isLiked = neo4j_userLikedWorkout($uid, $workoutResult->workout_id);
            $workoutResult->creator_isFollowed = neo4j_userFollowedUser($uid, $workoutResult->creator_id);
        } else {
            $workoutResult->isLiked = false;
            $workoutResult->creator_isFollowed = false;
        }


        // Encode return value as JSON String
        $return = json_encode($workoutResult);

        echo $return;
    });

// Get the tags of a workout
    $slimapi->get('/:id/tags', function($id){
        // Casting of numeric values
        $id = (int)$id;

        $tagsArray = neo4j_getWorkoutTags($id);

        $return = json_encode($tagsArray);

        echo $return;
    });

// Get the exercises of a workout
    $slimapi->get('/:id/exercises', function($id){
        // Casting of numeric values
        $id = (int)$id;

        $tagsArray = neo4j_getWorkoutExercises($id);

        $return = json_encode($tagsArray);

        echo $return;
    });

// Get the exercises of a workout

// Search workout
    $slimapi->post('/search/:string(/:limit)(/:skip)', function($string, $limit = 5, $skip = 0) use ($bodyDecoded){
        // Casting of numeric values
        $limit = (int)$limit;
        $skip = (int)$skip;
        // Get the token data
        $userData = getToken();
        // Get filter if set
        $difficultyRange = (isset($bodyDecoded["difficulty"]) ? $bodyDecoded["difficulty"] : [0, 0]);
        $timeRange = (isset($bodyDecoded["time"]) ? $bodyDecoded["time"] : [0, 0]);
        // Search
        $searchResults = [];
        $searchResults = neo4j_searchWorkout($string, $difficultyRange, $timeRange, $limit, $skip);
        // Add the tags and the exercises to the workout previews
        for($i = 0; $i < count($searchResults); $i++){
            $searchResults[$i]->tags = neo4j_getWorkoutTags($searchResults[$i]->workout_id);
            $searchResults[$i]->exerciseNames = neo4j_getWorkoutExercises($searchResults[$i]->workout_id);
        }
        // If user is logged in, check if workout is liked
        if(array_key_exists("user_id",$userData)){
            $uid = $userData["user_id"];
            for($i = 0; $i < count($searchResults); $i++){
                $searchResults[$i]->isLiked = neo4j_userLikedWorkout($uid, $searchResults[$i]->workout_id);
            }
        } else {
            for($i = 0; $i < count($searchResults); $i++){
                $searchResults[$i]->isLiked = false;
            }
        }

        // Encode return value as JSON String
        $return = json_encode($searchResults);

        echo $return;
    });

// Random workout
    $slimapi->get('/random/(:limit)(/:skip)(/:tags)', function($limit = 100, $skip = 0, $tags = NULL){
        // Get the token data
        $userData = getToken();

        // Casting of numeric values
        $skip = (int)$skip;
        $limit = (int)$limit;

        // Get the random workouts paginated and eventually filtered by tags
        $randomResults = [];
        $randomResults = neo4j_getRandomWorkouts($limit, $skip, $tags);

        // Add the tags and the exercises to the workout previews
        for($i = 0; $i < count($randomResults); $i++){
            $randomResults[$i]->tags = neo4j_getWorkoutTags($randomResults[$i]->workout_id);
            $randomResults[$i]->exerciseNames = neo4j_getWorkoutExercises($randomResults[$i]->workout_id);
        }

        // If user is logged in, check if workout is liked
        if(array_key_exists("user_id",$userData)){
            $uid = $userData["user_id"];
            for($i = 0; $i < count($randomResults); $i++){
                $randomResults[$i]->isLiked = neo4j_userLikedWorkout($uid, $randomResults[$i]->workout_id);
            }
        } else {
            for($i = 0; $i < count($randomResults); $i++){
                $randomResults[$i]->isLiked = false;
            }
        }

        // Encode return value as JSON String
        $return = json_encode($randomResults);

        echo $return;
    });
// Random name for a workout
    $slimapi->get('/randomName/', function(){
        echo json_encode(mysql_getRandomWorkoutName());
    });

// Most liked workouts
    $slimapi->get('/mostliked/(:limit)(/:skip)(/:tags)', function($tags = NULL, $limit = 10, $skip = 0){
        // Get the token data
        $userData = getToken();

        // Casting of numeric values
        $skip = (int)$skip;
        $limit = (int)$limit;

        // Get most liked workouts
        $likedResults = [];
        $likedResults = neo4j_getMostLikedWorkouts($limit, $skip, $tags);

        // Add the tags and the exercises to the workout previews
        for($i = 0; $i < count($likedResults); $i++){
            $likedResults[$i]->tags = neo4j_getWorkoutTags($likedResults[$i]->workout_id);
            $likedResults[$i]->exerciseNames = neo4j_getWorkoutExercises($likedResults[$i]->workout_id);
        }

        // If user is logged in, check if workout is liked
        if(array_key_exists("user_id",$userData)){
            $uid = $userData["user_id"];
            for($i = 0; $i < count($likedResults); $i++){
                $likedResults[$i]->isLiked = neo4j_userLikedWorkout($uid, $likedResults[$i]->workout_id);
            }
        } else {
            for($i = 0; $i < count($likedResults); $i++){
                $likedResults[$i]->isLiked = false;
            }
        }

        // Encode return values as JSON String
        $return = json_encode($likedResults);

        echo $return;
    });

// Tags given
    $slimapi->post('/tagged(/:limit)(/:skip)', function($limit = 10, $skip = 0) use ($bodyDecoded) {
        // Get the token data
        $userData = getToken();

        // Casting of numeric values
        $skip = (int)$skip;
        $limit = (int)$limit;

        // Getting the tags
        $tagsArray = $bodyDecoded["tags"];
        // Get filter if set
        $difficultyRange = (isset($bodyDecoded["difficulty"]) ? $bodyDecoded["difficulty"] : [0, 0]);
        $timeRange = (isset($bodyDecoded["time"]) ? $bodyDecoded["time"] : [0, 0]);

        // Get tagged workouts
        $taggedResults = array();
        $taggedResults = neo4j_getTaggedWorkouts($tagsArray, $difficultyRange, $timeRange, $limit, $skip);

        // Add the tags and the exercises to the workout previews
        for($i = 0; $i < count($taggedResults); $i++){
            $taggedResults[$i]->tags = neo4j_getWorkoutTags($taggedResults[$i]->workout_id);
            $taggedResults[$i]->exerciseNames = neo4j_getWorkoutExercises($taggedResults[$i]->workout_id);
        }

        // If user is logged in, check if workout is liked
        if(array_key_exists("user_id",$userData)){
            $uid = $userData["user_id"];
            for($i = 0; $i < count($taggedResults); $i++){
                $taggedResults[$i]->isLiked = neo4j_userLikedWorkout($uid, $taggedResults[$i]->workout_id);
            }
        } else {
            for($i = 0; $i < count($taggedResults); $i++){
                $taggedResults[$i]->isLiked = false;
            }
        }

        $return = json_encode($taggedResults);

        echo $return;
    });

// Customized workouts (given the information of the customizer)
    $slimapi->post('/customized(/:limit)(/:skip)', function($limit = 10, $skip = 0) use ($slimapi, $bodyDecoded){
        // Get the token data if available
        $userData = getToken();
        // Casting numeric values
        $limit = (int)$limit;
        $skip = (int)$skip;
        // Be sure, there is customizer info
        if(isset($bodyDecoded["preferences"]["motives"])&&count($bodyDecoded["preferences"]["motives"])){
            // Get the workouts with the customizer info
            $customWorkouts = [];
            $customWorkouts = neo4j_getCustomizedWorkouts($bodyDecoded["preferences"], $limit, $skip);
            // Add the tags and the exercises to the workout previews
            for($i = 0; $i < count($customWorkouts); $i++){
                $customWorkouts[$i]->tags = neo4j_getWorkoutTags($customWorkouts[$i]->workout_id);
                $customWorkouts[$i]->exerciseNames = neo4j_getWorkoutExercises($customWorkouts[$i]->workout_id);
            }

            // If user is logged in, check if workout is liked
            if(array_key_exists("user_id",$userData)){
                $uid = $userData["user_id"];
                for($i = 0; $i < count($customWorkouts); $i++){
                    $customWorkouts[$i]->isLiked = neo4j_userLikedWorkout($uid, $customWorkouts[$i]->workout_id);
                }
            } else {
                for($i = 0; $i < count($customWorkouts); $i++){
                    $customWorkouts[$i]->isLiked = false;
                }
            }

            $return = json_encode($customWorkouts);

            echo $return;
        } else {
            $slimapi->halt(403, 'No custom data passed.');
        }

    });

    // Requests focused on a specific user
    $slimapi->group('/user', function() use ($slimapi) {
        //// Get a users favorite workouts
        $slimapi->get('/favorites(/:limit)(/:skip)', function($limit = 10, $skip = 0) use($slimapi){
            if(isset($slimapi->jwt["user_id"])){
                $uid = $slimapi->jwt["user_id"];
                // Casting of numeric values
                $skip = (int)$skip;
                $limit = (int)$limit;

                // Get result set
                $favorites = [];
                $favorites = neo4j_getUserFavs($uid, $limit, $skip);

                // Add the tags and the exercises to the workout previews
                for($i = 0; $i < count($favorites); $i++){
                    $favorites[$i]->tags = neo4j_getWorkoutTags($favorites[$i]->workout_id);
                    $favorites[$i]->exerciseNames = neo4j_getWorkoutExercises($favorites[$i]->workout_id);
                    // As only liked workouts are received from db, set isLiked to true by default
                     $favorites[$i]->isLiked = true;

                }

                $return = json_encode($favorites);

                echo $return;
            } else {
                $slimapi->halt(403, 'Not logged in.');
            }
        });

        // Get workouts created by an user
        $slimapi->get('/created(/:limit)(/:skip)', function($limit = 10, $skip = 0) use ($slimapi){
            if(isset($slimapi->jwt["user_id"])){
                $uid = $slimapi->jwt["user_id"];
                // Casting of numeric values
                $skip = (int)$skip;
                $limit = (int)$limit;

                // Get result set
                $createdWorkouts = [];
                $createdWorkouts = neo4j_getUserCreatedWorkouts($uid, $limit, $skip);

                // Add the tags and the exercises to the workout previews
                for($i = 0; $i < count($createdWorkouts); $i++){
                    $createdWorkouts[$i]->tags = neo4j_getWorkoutTags($createdWorkouts[$i]->workout_id);
                    $createdWorkouts[$i]->exerciseNames = neo4j_getWorkoutExercises($createdWorkouts[$i]->workout_id);
                }

                // Check whether the resulting workouts are liked
                for($i = 0; $i < count($createdWorkouts); $i++){
                    $createdWorkouts[$i]->isLiked = neo4j_userLikedWorkout($uid, $createdWorkouts[$i]->workout_id);
                }

                $return = json_encode($createdWorkouts);

                echo $return;
            } else {
                $slimapi->halt(403, 'Not logged in.');
            }
        });

        // Get workouts similar to a users likes
        $slimapi->get('/personalized(/:limit)(/:skip)', function($limit = 10, $skip = 0) use ($slimapi) {
             if(isset($slimapi->jwt["user_id"])){
                $uid = $slimapi->jwt["user_id"];
                // Casting of numeric values
                $skip = (int)$skip;
                $limit = (int)$limit;

                // Get result set - First, look for personalized workouts, then for workouts based on user's preferences and finally random workouts
                $personalizedWorkouts = [];
                /// Personalized workouts
                $personalizedWorkouts = neo4j_getPersonalizedWorkouts($uid, $limit, $skip);
                /// Additional workouts
                $resCount = count($personalizedWorkouts);
                if($resCount < $limit){
                    $subLimit = max($limit - $resCount, 0);
                    $subSkip = max($skip - $limit, 0);
                    // Get user preferences and workouts based on that
                    $userData = neo4j_getUserByID($uid)[0];
                    $preferenceWorkouts = neo4j_getCustomizedWorkouts($userData->preferences, $subLimit, $subSkip);
                    $personalizedWorkouts = array_merge($personalizedWorkouts, $preferenceWorkouts);
                    // If there are too less preference workouts, check for featured workouts
                    $resCount = count($preferenceWorkouts);
                    if($resCount < $subLimit){
                        $subLimit = max($subLimit - $resCount, 0);
                        $subSkip = max($subSkip - $subLimit, 0);
                        $featuredWorkouts = neo4j_getRandomWorkouts($subLimit, $subSkip);
                        $personalizedWorkouts = array_merge($personalizedWorkouts, $featuredWorkouts);
                    }
                }

                // Add the tags and the exercises to the workout previews
                for($i = 0; $i < count($personalizedWorkouts); $i++){
                    $personalizedWorkouts[$i]->tags = neo4j_getWorkoutTags($personalizedWorkouts[$i]->workout_id);
                    $personalizedWorkouts[$i]->exerciseNames = neo4j_getWorkoutExercises($personalizedWorkouts[$i]->workout_id);
                }

                // Check whether the resulting workouts are liked
                for($i = 0; $i < count($personalizedWorkouts); $i++){
                    $personalizedWorkouts[$i]->isLiked = neo4j_userLikedWorkout($uid, $personalizedWorkouts[$i]->workout_id);
                }

                $return = json_encode($personalizedWorkouts);

                echo $return;
            } else {
                $slimapi->halt(403, 'Not logged in.');
            }
        });
    });

// WORKOUT RELATED WRITING FUNCTIONS
    // Workout creation
    $slimapi->put('/user/create', function() use ($slimapi, $bodyDecoded) {
        if(isset($slimapi->jwt["user_id"])){
            $uid = $slimapi->jwt["user_id"];

            // Data to be stored in mysql
            $mysqlDataObject = new data_mysql_workoutData();
            $mysqlDataObject->annotations = $bodyDecoded['annotations'];
            $mysqlDataObject->exerciseMap = $bodyDecoded['exerciseMap'];
            $mysqlDataObject->pdfPath = "";


            // Data to be stored in Neo4j
            $neo4jDataObject = new data_neo4j_workoutProps();
            $neo4jDataObject->name = $bodyDecoded['name'];
            $neo4jDataObject->dimensions = $bodyDecoded['dimensions'];
            $neo4jDataObject->duration = $bodyDecoded['duration'];
            $neo4jDataObject->roundCount = $bodyDecoded['roundCount'];
            $neo4jDataObject->exCount = $bodyDecoded['exCount'];
            $neo4jDataObject->picPath = $bodyDecoded['picPath'];
            $neo4jDataObject->difficulty = $bodyDecoded['difficulty'];

            // IDs of inbound exercises
            $exerciseIdArray = $bodyDecoded['exerciseIDs'];

            // Array of userd tags
            $tagsArray = $bodyDecoded['tags'];

            // Create the workout in both databases
            $newWorkoutID = data_createWorkout($uid, $mysqlDataObject, $neo4jDataObject, $exerciseIdArray, $tagsArray);

            echo $newWorkoutID;
        } else {
            $slimapi->halt(403, 'Not logged in.');
        }
    });

    // Update a workout
    $slimapi->put('/user/update', function() use ($slimapi, $bodyDecoded) {
        if(isset($slimapi->jwt["user_id"])){
            $uid = $slimapi->jwt["user_id"];

            // Data to be stored in mysql
            $mysqlDataObject = new data_mysql_workoutData();
            $mysqlDataObject->annotations = $bodyDecoded['annotations'];
            $mysqlDataObject->exerciseMap = $bodyDecoded['exerciseMap'];
            $mysqlDataObject->pdfPath = "";  // PDF recreation will be handled on data_dunctions side.


            // Data to be stored in Neo4j
            $neo4jDataObject = new data_neo4j_workoutProps();
            $neo4jDataObject->name = $bodyDecoded['name'];
            $neo4jDataObject->workout_id = $bodyDecoded['workout_id'];
            $neo4jDataObject->dimensions = $bodyDecoded['dimensions'];
            $neo4jDataObject->duration = $bodyDecoded['duration'];
            $neo4jDataObject->roundCount = $bodyDecoded['roundCount'];
            $neo4jDataObject->exCount = $bodyDecoded['exCount'];
            $neo4jDataObject->picPath = $bodyDecoded['picPath'];
            $neo4jDataObject->difficulty = $bodyDecoded['difficulty'];

            // IDs of inbound exercises
            $exerciseIdArray = $bodyDecoded['exerciseIDs'];

            // Array of userd tags
            $tagsArray = $bodyDecoded['tags'];

            // Create the workout in both databases
            $updatedWorkoutID = data_updateWorkout($uid, $mysqlDataObject, $neo4jDataObject, $tagsArray, $exerciseIdArray);

            echo $updatedWorkoutID;
        } else {
            $slimapi->halt(403, 'Not logged in.');
        }
    });

    // Like/ dislike a workout
    $slimapi->post('/user/:wid/like', function($wid) use ($slimapi){
        if(isset($slimapi->jwt["user_id"])){
            $uid = $slimapi->jwt["user_id"];
            // Casting of numeric values
            $wid = (int)$wid;

            $isLiked = neo4j_likeDislikeWorkout($uid, $wid);

            echo $isLiked;
        } else {
            $slimapi->halt(403, 'Not logged in.');
        }
    });
// Finally execute the prepared routes if called
$slimapi->run();
?>
