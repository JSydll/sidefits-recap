<?php
// Load data model
require("model/data_functions.php");

// Initiiate the Slim framework
$slimapi = new \Slim\Slim();
$reqbody = $slimapi->request->getBody();

// EXERCISE RELATED GET REQUESTS
    // Search resource given
    $slimapi->get('/search/:string(/:limit)(/:skip)', function($string, $limit = 5, $skip = 0){        
        // Casting of numeric values
        $limit = (int)$limit;
        $skip = (int)$skip;
        
        // Search, get a maximum of 5 results
        $searchResults = neo4j_searchExercise($string, $limit, $skip);
        
        // Encode return value as JSON String
        $return = json_encode($searchResults);
        
        echo $return;
    });
    
    // Random resource given
    $slimapi->get('/random(/:skip)(/:limit)(/:tags+)', function($skip = 0, $limit = 5, $tags = NULL){
        // Casting of numeric values
        $skip = (int)$skip;
        $limit = (int)$limit;
        
        // Get the random exercises paginated and eventually filtered by tags
        $randomResults = neo4j_getRandomExercises($skip, $limit, $tags);
        
        // Encode return value as JSON String
        $return = json_encode($randomResults);
        
        echo $return;
    });
    
    // Id resource given
    $slimapi->get('/:id', function($id){                                                                           // TODO: TEST WITH REAL DATA
        // Casting of numeric values
        $id = (int)$id;
        
        // Get the exercise preview
        $exerciseResult = neo4j_getExerciseByID($id);
        
        // Encode return value as JSON String
        $return = json_encode($exerciseResult);
        
        echo $return;
    });
    
        // Similar resource given
        $slimapi->get('/:id/similar(/:limit)', function($id, $limit = 5){
            // Casting of numeric values
            $id = (int)$id;
            $limit = (int)$limit;
    
            // Get the similar exercises
            $similarResults = neo4j_getSimilarExercises($id, $limit);
    
            // Encode return value as JSON String
            $return = json_encode($similarResults);
    
            echo $return;
        });
    
        // Full resource given 
        $slimapi->get('/:id/full', function($id) use ($reqbody) {
            // Casting of numeric values
            $id = (int)$id;
            
            // Check the request body if there's already some data
            if($reqbody != ""){
                $prevData = new data_exercisePreview();
                // Decode the body and write data to object
                $bodyDecoded = json_decode($reqbody); 
                
                // Write the data in the row into the object
                $prevData->name = $bodyDecoded["name"];
                $prevData->exercise_id = $bodyDecoded["exercise_id"];
                $prevData->alias = $bodyDecoded["alias"];
                $prevData->picPath = $bodyDecoded["picPath"];
                $prevData->shortDescr = $bodyDecoded["shortDescr"];
            
                // Now send the data request
                $exerciseResult = data_getExerciseFull($id, $prevData);
            } else {
                // Get the full exercise from scratch
                $exerciseResult = data_getExerciseFull($id);    
            }
            
            // Encode return value as JSON String
            $return = json_encode($exerciseResult);
    
            echo $return;
        });

$slimapi->run();


?>