<?php
// API Endpoint for sending messages
// Load data model (comes with the environment)
require("model/data_functions.php");
require("model/message_functions.php");

// Initiiate the Slim framework
$slimapi = new \Slim\Slim();
$reqbody = $slimapi->request->getBody();
// Prepare the database data objects with data provided in the request body
$bodyDecoded = json_decode($reqbody, true);

// Send a workout per email
$slimapi->post('/workout/PDFperMail', function() use ($slimapi, $bodyDecoded){    
    // Check wheter at least one email was selected    
    if(count($bodyDecoded["emailList"]) > 0){
        // Now send the email(s)
        if(!sendChallengeMail($bodyDecoded["initiatorName"], $bodyDecoded["initiatorEmail"], $bodyDecoded["message"], $bodyDecoded["workoutName"], $bodyDecoded["workoutURL"], $bodyDecoded["emailList"], $bodyDecoded["subject"], $bodyDecoded["locale"])) {
            $slimapi->halt(500, "Email could not be sent. Error ".$mail->ErrorInfo.".");
        } else {
            echo 'Message has been sent';
        }
    } else {
        $slimapi->halt(400, "No email recipients defined.");
    }
});

// Invite people by email
$slimapi->post('/user/invite', function() use ($slimapi, $bodyDecoded){
    // Check wheter at least one email was selected
    if(count($bodyDecoded["emailList"]) > 0){
        // Now send the email(s)
        if(!sendInvitationMail($bodyDecoded["initiatorName"], $bodyDecoded["initiatorEmail"], $bodyDecoded["emailList"], $bodyDecoded["locale"])) {
            $slimapi->halt(500, "Email could not be sent. Error ".$mail->ErrorInfo.".");
        } else {
            // Send invitator's email, too.
            sendInvitersMail($bodyDecoded["initiatorName"], $bodyDecoded["initiatorEmail"], $bodyDecoded["locale"]);
            echo 'Message has been sent';
        }
    } else {
        $slimapi->halt(400, "No email recipients defined.");
    }
});

// Send account activation emails
$slimapi->post('/user/remember', function() use ($slimapi){
    $arr3doUser = neo4j_get3doUser();
    foreach($user as $arr3doUser){
        if(sendRememberMail($user["email"], $user["name"], $user["locale"], $user["confirmationCode"])){
            // Remember Mail successfully sent, so mark user
            neo4j_markRememberedUser($user["user_id"], "confirmation older than 3 days");
        } else {
            echo "Remembering failed for ".$user['name']." <".$user['email'].">\n";
        }    
    }    
});

$slimapi->post('/exercisePropose', function() use ($slimapi, $bodyDecoded){
    // Check wheter at least one email was selected
    // Build and send the email to selected recipients
    $mail = new PHPMailer;
    
    $mail->setFrom($bodyDecoded["email"], $bodyDecoded["name"]);
    $mail->addAddress("joschka.sondhof@gmx.de");
    $mail->addAddress("phimae@me.com");    
    $mail->addReplyTo($bodyDecoded["email"], $bodyDecoded["name"]);
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";
    $mail->Subject = $bodyDecoded["subject"];
    $mail->Body    = "<p>".$bodyDecoded["message"]."</p>";
    $mail->AltBody = strip_tags($bodyDecoded["message"]);

    if(!$mail->Send()) {
        $slimapi->halt(500, "Email could not be sent. Error ".$mail->ErrorInfo.".");
    } else {
        echo 'Message has been sent';
    }  
});


// Run the slim app
$slimapi->run();
?>