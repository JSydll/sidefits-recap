<?php
/* Script to handle file operations such as storing or deleting */
// Load data model (comes with the environment)
require("model/data_functions.php");

// Initiiate the Slim framework
$slimapi = new \Slim\Slim();
$reqbody = $slimapi->request->getBody();
// Prepare the database data objects with data provided in the request body
$bodyDecoded = json_decode($reqbody, true);

// Image upload
$slimapi->group('/upload', function() use ($slimapi) {
    // Store workout pictures
    $slimapi->post('/workoutPic', function() use ($slimapi){
        // Check if there is a valid image
        if(!is_uploaded_file($_FILES["file"]["tmp_name"])){
            $slimapi->halt(400, 'No images uploaded!');
        } else {
            $image = $_FILES["file"];
            $wname = str_replace(" ", "", $_POST["wname"]);
            // Also remove special chars and several hyphens following each other
            $wname = preg_replace("/[^A-Za-z0-9\-]/", "", $wname);
            $wname = preg_replace("/-+/", "-", $wname);
            $image_type = array_pop(explode(".", $image["name"]));
            if(move_uploaded_file($image['tmp_name'], __DIR__.'/../view/images/workouts/'.$wname.".".$image_type) === true) {
                $image_infos = array('url' => 'images/workouts/'. $wname.".".$image_type, 'name' => $wname.".".$image_type);
                $return = json_encode($image_infos);
                echo $return;
            } else {
                $slimapi->halt(400, 'Something went wrong during file upload');
            }
        }
    });
    // Store user profile pictures
    $slimapi->post('/profilePic', function() use ($slimapi){
        // Check if there is a valid image
        if(!is_uploaded_file($_FILES["file"]["tmp_name"])){
            $slimapi->halt(400, 'No images uploaded!');
        } else {
            $image = $_FILES["file"];
            $uname = str_replace(" ", "", $_POST["uname"]);
            // Also remove special chars and several hyphens following each other
            $uname = preg_replace("/[^A-Za-z0-9\-]/", "", $uname);
            $uname = preg_replace("/-+/", "-", $uname);
            $image_type = array_pop(explode(".", $image["name"]));
            if(move_uploaded_file($image['tmp_name'], __DIR__.'/../view/images/user/profile/'.$uname.".".$image_type) === true) {
                $image_infos = array('url' => 'images/workouts/'. $uname.".".$image_type, 'name' => $uname.".".$image_type);
                $return = json_encode($image_infos);
                echo $return;
            } else {
                $slimapi->halt(400, 'Something went wrong during file upload');
            }
        }
    });        
});
    




$slimapi->run();
?>