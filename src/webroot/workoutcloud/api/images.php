<?php
// Load data model
require("model/data_functions.php");
// Load image resize library
require('model/image-resize/ImageResize.php');


// Initiiate the Slim framework
$slimapi = new \Slim\Slim();
$reqbody = $slimapi->request->getBody();
// Prepare the database data objects with data provided in the request body
$bodyDecoded = json_decode($reqbody, true);

$slimapi->get('/resize/:type/:height/:width/:imgName', function($type, $height, $width, $imgName) use ($slimapi) {
    // Casting of numeric values
    $height = (int)$height;
    $width = (int)$width;
    // Set the image base path depending on image type
    switch($type){
        case "workout":
            $basePath = "../view/images/workouts/";
            break;
        case "user":
            $basePath = "../view/images/users/";
            break;
        case "exercise":
            $basePath = "../view/images/exercises/";
            break;
        default:
            $slimapi->halt(403, "No known image type.");
            exit;
    }
    // Make sure, the file is existing
    $filePath = $basePath.$imgName;
    if(file_exists($filePath)){
        // Scale it and return the scaled image
        $image = new \Eventviva\ImageResize($filePath);
        $image->resizeToBestFit($width, $height);
        $slimapi->response()->header('Content-Type', 'content-type: image/png');
        $image->output(IMAGETYPE_PNG);
    } else {
        // Image not existing, return a default image (scaled)
        $filePath = $basePath."default-1.jpg";
        $image = new \Eventviva\ImageResize($filePath);
        $image->resizeToBestFit($width, $height);
        $slimapi->response()->header('Content-Type', 'content-type: image/png');
        $image->output(IMAGETYPE_PNG);
    }
});

// Finally execute the prepared routes if called
$slimapi->run();
?>
