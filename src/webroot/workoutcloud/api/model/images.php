<?php
// Load data model
require(__DIR__."/data_functions.php");
// Load image resize library
require(__DIR__.'/image-resize/ImageResize.php');
use \Eventviva\ImageResize;

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
            $basePath = "/images/workouts/";
            break;
        case "user":
            $basePath = "/images/users/";
            break;
        case "exercise":
            $basePath = "/images/exercises/";
            break;
        else:
            $slimapi->halt(403, "No known image type.");
            exit;
    }
    // Make sure, the file is existing
    $filePath = $basePath.$imgName;
    if(is_file($filePath)){
        echo "file found";
        // Scale it and return the scaled image
        /*$image = new ImageResize($filePath);
        $image->resizeToBestFit($width, $height);
        $image->output(IMAGETYPE_PNG);*/
    } else {
        echo "file not found";
        // Image not existing, return a default image (scaled)
        /* $filePath = $basePath."default-1.jpg";
        $image = new ImageResize($filePath);
        $image->resizeToBestFit($width, $height);
        $image->output(IMAGETYPE_PNG); */
    }
});

// Finally execute the prepared routes if called
$slimapi->run();
?>
