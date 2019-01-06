<?php
// Load the environment
require_once(__DIR__."/../environment/load_environment.php");

function sendChallengeMail($senderName, $senderMail, $senderMessage, $workoutName, $workoutLink, $emailList, $subject, $userLocale){
    // Get the email body
    $guzzleClient = new GuzzleHttp\Client();
    // Make sure, all url passed data is encoded
    $senderNameEncoded = urlencode($senderName);
    $senderMailEncoded = urlencode($senderMail);
    $senderMessageEncoded = urlencode($senderMessage);
    $workoutNameEncoded = urlencode($workoutName);
    $workoutLinkEncoded = urlencode($workoutLink);
    if($userLocale == "de_DE"){
        $resourceURI = "../api/model/emailchain/Recommendation_Mail_DE.php?in=".$senderNameEncoded."&ie=".$senderMailEncoded."&m=".$senderMessageEncoded."&wn=".$workoutNameEncoded."&wl=".$workoutLinkEncoded;
    } else {
        $resourceURI = "../api/model/emailchain/Recommendation_Mail_EN.php?in=".$senderNameEncoded."&ie=".$senderMailEncoded."&m=".$senderMessageEncoded."&wn=".$workoutNameEncoded."&wl=".$workoutLinkEncoded;
    }
    $guzzleResponse = $guzzleClient->get($resourceURI);
    $html = (string)$guzzleResponse->getBody();

    // Prepare the message
    $mail = new PHPMailer;
    $mail->setFrom($senderMail, $senderName);
    // Add all selected email addresses
    foreach($emailList as $email){
        $mail->addAddress($email);
    }
    $mail->addReplyTo($senderMail, $senderName);
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";
    $mail->AltBody = strip_tags($senderMessage);
    $mail->Subject = $subject;
    $mail->Body = $html;
    // Send it!
    if($mail->send()) {
        return true;
    } else {
        return false;
    }
}

function sendInvitationMail($senderName, $senderMail, $emailList, $userLocale){
    // Get the email body
    $guzzleClient = new GuzzleHttp\Client();
    // Make sure, all url passed data is encoded
    $senderNameEncoded = urlencode($senderName);
    $senderMailEncoded = urlencode($senderMail);
    if($userLocale == "de_DE"){
        $resourceURI = "../api/model/emailchain/WorkoutCloud_been_invited_DE.php?in=".$senderNameEncoded."&ie=".$senderMailEncoded;
    } else {
        $resourceURI = "../api/model/emailchain/WorkoutCloud_been_invited_EN.php?in=".$senderNameEncoded."&ie=".$senderMailEncoded;
    }
    $guzzleResponse = $guzzleClient->get($resourceURI);
    $html = (string)$guzzleResponse->getBody();

    // Prepare the message
    $mail = new PHPMailer;
    $mail->setFrom($senderMail, $senderName);
    // Add all selected email addresses
    foreach($emailList as $email){
        $mail->addAddress($email);
    }
    $mail->addReplyTo($senderMail, $senderName);
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";
    if($userLocale == "de_DE"){
        $mail->Subject = "Einladung zur WorkoutCloud";
    } else {
        $mail->Subject = "WorkoutCloud invitation";
    }
    $mail->Body = $html;
    // Send it!
    if($mail->send()) {
        return true;
    } else {
        return false;
    }
}

function sendInvitersMail($senderName, $senderMail, $userLocale){
    // Get the email body
    $guzzleClient = new GuzzleHttp\Client();
    // Make sure, all url passed data is encoded
    $senderNameEncoded = urlencode($senderName);
    $senderMailEncoded = urlencode($senderMail);
    if($userLocale == "de_DE"){
        $resourceURI = "../api/model/emailchain/WorkoutCloud_inviter_DE.php";
    } else {
        $resourceURI = "../api/model/emailchain/WorkoutCloud_inviter_EN.php";
    }
    $guzzleResponse = $guzzleClient->get($resourceURI);
    $html = (string)$guzzleResponse->getBody();

    // Prepare the message
    $mail = new PHPMailer;
    if($userLocale == "de_DE"){
        $mail->setFrom("cloud@sidefits.com", "Josch von Sidefits");
    } else {
        $mail->setFrom("cloud@sidefits.com", "Phil from Sidefits");
    }
    $mail->addAddress($senderMail, $senderName);
    $mail->addReplyTo("cloud@sidefits.com", "Sidefits Team");
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";
    if($userLocale == "de_DE"){
        $mail->Subject = "Einladung zur WorkoutCloud";
    } else {
        $mail->Subject = "WorkoutCloud invitation";
    }
    $mail->Body = $html;
    // Send it!
    if($mail->send()) {
        return true;
    } else {
        return false;
    }
}

function sendRegistrationMail($userMail, $userName, $userLocale, $confirmationCode){
    // Get the email body
    $guzzleClient = new GuzzleHttp\Client();
    if($userLocale == "de_DE"){
        $resourceURI = "../api/model/emailchain/Registration_WorkoutCloud_DE.php?s=".urlencode("Account aktivieren")."&c=".$confirmationCode;
    } else {
        $resourceURI = "../api/model/emailchain/Registration_WorkoutCloud_EN.php?s=".urlencode("Activate your account")."&c=".$confirmationCode;
    }
    $guzzleResponse = $guzzleClient->get($resourceURI);
    $html = (string)$guzzleResponse->getBody();

    // Prepare the message
    $mail = new PHPMailer;
    if($userLocale == "de_DE"){
        $mail->setFrom("cloud@sidefits.com", "Josch von Sidefits");
    } else {
        $mail->setFrom("cloud@sidefits.com", "Phil from Sidefits");
    }
    $mail->addAddress($userMail, $userName);
    $mail->addReplyTo("cloud@sidefits.com", "Sidefits Team");
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";
    if($userLocale == "de_DE"){
        $mail->Subject = "WorkoutCloud: Account aktivieren";
    } else {
        $mail->Subject = "WorkoutCloud: Account activation";
    }
    $mail->Body = $html;
    // Send it!
    if($mail->send()) {
        return true;
    } else {
        return false;
    }        
}

function sendRememberMail($userMail, $userName, $userLocale, $confirmationCode){
    // Get the email body
    $guzzleClient = new GuzzleHttp\Client();
    if($userLocale == "de_DE"){
        $resourceURI = "../api/model/emailchain/Registration_reminder_DE.php?s=".urlencode("Reminder: Account aktivieren")."&c=".$confirmationCode;
    } else {
        $resourceURI = "../api/model/emailchain/Registration_reminder_DE.php?s=".urlencode("Reminder: Activate your account")."&c=".$confirmationCode;
    }
    $guzzleResponse = $guzzleClient->get($resourceURI);
    $html = (string)$guzzleResponse->getBody();

    // Prepare the message
    $mail = new PHPMailer;
    if($userLocale == "de_DE"){
        $mail->setFrom("cloud@sidefits.com", "Josch von Sidefits");
    } else {
        $mail->setFrom("cloud@sidefits.com", "Phil from Sidefits");
    }
    $mail->addAddress($userMail, $userName);
    $mail->addReplyTo("cloud@sidefits.com", "Sidefits Team");
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";
    if($userLocale == "de_DE"){
        $mail->Subject = "WorkoutCloud: Account aktivieren";
    } else {
        $mail->Subject = "WorkoutCloud: Account activation";
    }
    $mail->Body = $html;
    // Send it!
    if($mail->send()) {
        return true;
    } else {
        return false;
    }
}

function sendConfirmationMail($userMail, $userName, $userLocale){
    // Get the email body
    $guzzleClient = new GuzzleHttp\Client();
    if($userLocale == "de_DE"){
        $resourceURI = "../api/model/emailchain/WorkoutCloud_verified_welcome_email_DE.php";
    } else {
        $resourceURI = "../api/model/emailchain/WorkoutCloud_verified_welcome_email_EN.php";
    }
    $guzzleResponse = $guzzleClient->get($resourceURI);
    $html = (string)$guzzleResponse->getBody();

    // Prepare the message
    $mail = new PHPMailer;
    if($userLocale == "de_DE"){
        $mail->setFrom("cloud@sidefits.com", "Josch von Sidefits");
    } else {
        $mail->setFrom("cloud@sidefits.com", "Phil from Sidefits");
    }
    $mail->addAddress($userMail, $userName);
    $mail->addReplyTo("cloud@sidefits.com", "Sidefits Team");
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";
    if($userLocale == "de_DE"){
        $mail->Subject = "WorkoutCloud: Account wurde aktiviert";
    } else {
        $mail->Subject = "WorkoutCloud: Account successfully activated";
    }
    $mail->Body = $html;
    // Send it!
    if($mail->send()) {
        return true;
    } else {
        return false;
    }
}

function sendPWResetMail($userMail, $userName, $userLocale, $userToken){
    // Get the email body
    $guzzleClient = new GuzzleHttp\Client();
    // Make sure, all url passed data is encoded
    $emailEncoded = urlencode($userMail);
    $nameEncoded = urlencode($userName); 
    if($userLocale == "de_DE"){
       $resourceURI = "../api/model/emailchain/Password_Reset_DE.php?m=".$emailEncoded."&n=".$nameEncoded."&s=".urlencode("Neues Passwort setzen")."&t=".$userToken;
    } else {
        $resourceURI = "../api/model/emailchain/Password_Reset_EN.php?m=".$emailEncoded."&n=".$nameEncoded."&s=".urlencode("Set a new password")."&t=".$userToken;   
    }
    $guzzleResponse = $guzzleClient->get($resourceURI);    
    $html = (string)$guzzleResponse->getBody();
    
    // Prepare the message
    $mail = new PHPMailer;
    if($userLocale == "de_DE"){
        $mail->setFrom("cloud@sidefits.com", "Josch von Sidefits");    
    } else {
        $mail->setFrom("cloud@sidefits.com", "Phil from Sidefits");    
    }   
    $mail->addAddress($userMail, $userName);
    $mail->addReplyTo("cloud@sidefits.com", "Sidefits Team");
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";
    if($userLocale == "de_DE"){
        $mail->Subject = "WorkoutCloud: Neues Passwort setzen";
    } else {
        $mail->Subject = "WorkoutCloud: Password reset";
    }
    $mail->Body = $html;
    // Send it!
    if($mail->send()) {
        return true;
    } else {
        return false;
    }
}



?>