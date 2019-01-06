<?php
// Load data model
require("model/data_functions.php");

// Initiiate the Slim framework
$slimapi = new \Slim\Slim();
$reqbody = $slimapi->request->getBody();

// TAG RELATED READING FUNCTIONS

// Get most relevant tags
$slimapi->get('/(:limit)', function($limit = 10){
    // Explicit casting of numeric values
    $limit = (int)$limit;
    
    // Fire the Neo4j function
    $resultTags = array();
    $resultTags = neo4j_getRelevantTags($limit);
    
    $return = json_encode($resultTags);
    
    echo $return;        
});

// Search tag by name
$slimapi->get('/search/:string(/:limit)', function($string, $limit = 10){
    // Explicit casting of numeric values
    $limit = (int)$limit;
    
    // Search in Neo4j for the tags 
    $searchResult = array();  
    $searchResult = neo4j_searchTag($string, $limit);
    
    $return = json_encode($searchResult);
    
    echo $return;    
});           


// TAG RELATED WRITING FUNCTIONS

// Create connection to tag(s)

// Remove connection to tag(s)


// Finally execute the prepared routes if called
$slimapi->run();
?>