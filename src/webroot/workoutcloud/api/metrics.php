<?php
/* Script to handle file operations such as storing or deleting */
// Load data model (comes with the environment)
require("model/data_functions.php");

// Initiiate the Slim framework
$slimapi = new \Slim\Slim();
// Slim should return csv values at this endpoint
$slimapi->response->headers->set('Content-Type', 'text/csv');
// Prepare the database data objects with data provided in the request body
$reqbody = $slimapi->request->getBody();
$bodyDecoded = json_decode($reqbody, true);

// users (activated, total), workouts, workouts per user, likes per user, workout with max likes, most active creator
$slimapi->get('/kpis', function(){
    $metrics = neo4j_basicMetrics(); 
   
    // Build the csv string suiting the needs of CYFE
    // Number Widget
    $csvString = "Total User, Confirmed User(%), Workouts, Workouts/User, Likes/User, Leading Workout is ".$metrics["leaders"]["mostLikedWorkout"]["name"]." by ".$metrics["leaders"]["mostLikedWorkout"]["creatorName"]." - ".$metrics["leaders"]["mostLikedWorkout"]["creatorEmail"].", Leading Creator is ".$metrics["leaders"]["mostActiveCreator"]["name"]." - ".$metrics["leaders"]["mostActiveCreator"]["email"]."\r\n";
    $csvString .= $metrics["users"]["total"].", ".(round(($metrics["users"]["confirmed"] / $metrics["users"]["total"]), 4) * 100).", ".$metrics["workouts"]["total"].", ".round(($metrics["workouts"]["total"] / $metrics["users"]["total"]), 2).", ".round(($metrics["likes"]["total"] / $metrics["users"]["confirmed"]), 2).", ".$metrics["leaders"]["mostLikedWorkout"]["likes"]." Likes, ".$metrics["leaders"]["mostActiveCreator"]["workouts"]." Workouts";  
    
    echo $csvString;
}); 

// User registration graph
$slimapi->get('/registrations', function(){
    $data = neo4j_registrationData();
    $csvString = "Date, Aggregated Users\r\n";
    for($i = 0; $i < count($data); $i++){
        $csvString .= $data[$i]["date"].", ".$data[$i]["count"]."\r\n";    
    }
    $csvString .= "Type,area\r\n";
    $csvString .= "Total,".$data[count($data)-1]["count"];
    
    echo $csvString; 
});

$slimapi->get('/slackappintegrations', function(){
    // Count the files in the bot team save direcory
    $fi = new FilesystemIterator("../../nodeapps/db_slackbutton_bot/teams", FilesystemIterator::SKIP_DOTS);
    // Store the iterator count
    $filecount = iterator_count($fi);
    // Prepare and return the csv string
    $csvString = "App Integrations\r\n".$filecount;
    echo $csvString;
});

$slimapi->run();
?>