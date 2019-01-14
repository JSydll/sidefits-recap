<?php
// Load the environment
require_once(__DIR__."/../environment/load_environment.php");
// OVERALL DATA MODEL OF MIXED OPERATIONS (
// INCLUDING BOTH NEO4J AND MYSQL AS WELL AS MIXED FUNCTIONS

// Require the data_classes for building data objects
require("data_classes.php");

// Including the basic CRUD functions in both databases
require("neo4jdata_functions.php");
require("mysqldata_functions.php");

// FUNCTIONS THAT INVOLVE BOTH DATABASES
// The Neo4j data model mostly returns objects, the MySql simple arrays
// (as there are no functions querying multiple rows in MySQL)


// READING

// WORKOUTS
//// Getting the full workout by ID (combines data from MySQL and Neo4j)
/////// It's possible to pass a data_workoutPrev object to the class
/////// which data gets copied into the full data set - that way reducing
/////// requests against the database
    function data_getWorkoutFull($workoutID, $workoutPreviewObj = NULL){
        // The full data set contains both data sources. Creating the full object
        // by filling up each subobjects separately and then adding.
        $workoutPreviewComponents = new data_workoutPreview();

        // If there is no preview object passed to the function,
        // get the Neo4j part of the data
        if($workoutPreviewObj == NULL){
            $workoutPreviewComponents = neo4j_getWorkoutByID($workoutID)[0];
        } else {
            $workoutPreviewComponents = $workoutPreviewObj;
        }

        // Now copy preview data in full data object
        $workoutFullObj = new data_workoutFull();
        $workoutFullObj = $workoutPreviewComponents;

        // Get tags of the workout
        $workoutFullObj->tags = neo4j_getWorkoutTags($workoutID);

        // Finally add data from MySQL to the object
        $workoutFullComponents = mysql_getWorkoutByID($workoutID);

        $workoutFullObj->annotations = $workoutFullComponents[0];
        $workoutFullObj->pdfPath = $workoutFullComponents[1];
        $workoutFullObj->exerciseMap = $workoutFullComponents[2];
        $workoutFullObj->exerciseDescriptions = $workoutFullComponents[3];

        return $workoutFullObj;
    }

// EXERCISES
//// Getting the full exercise by ID (combines data from MySQL and Neo4j)
/////// It's possible to pass a data_exercisePrev object to the class
/////// which data gets copied into the full data set - that way reducing
/////// requests against the database
    function data_getExerciseFull($exerciseID, $exercisePreviewObj = NULL){
        // The full data set contains both data sources. Creating the full object
        // by filling up each subobjects separately and then adding.
        $exercisePreviewComponents = new data_exercisePreview();

        // If there is no preview object passed to the function,
        // get the Neo4j part of the data
        if($exercisePreviewObj == NULL){
            $exercisePreviewComponents = neo4j_getExerciseByID($exerciseID)[0];
        } else {
            $exercisePreviewComponents = $exercisePreviewObj;
        }

        // Now copy preview data in full data object
        $exerciseFullObj = new data_exerciseFull();
        $exerciseFullObj = $exercisePreviewComponents;

        // Finally add data from MySQL to the object
        $exerciseFullComponents = mysql_getExerciseByID($exerciseID);

        $exerciseFullObj->annotations = $exerciseFullComponents[0];
        $exerciseFullObj->pdfPath = $exerciseFullComponents[1];
        $exerciseFullObj->exerciseMap = $exerciseFullComponents[2];

        return $exerciseFullObj;
    }

// WRITING

// WORKOUTS
//// Creating workout
//// Helper function to create a pdf
function data_createPDF($userID, $mysqlDataObject, $neo4jDataObject, $tagsArray = NULL){
    global $ENV_VARS;
    // Generate a PDF ////
    // Preparations //////
    // Get user information
    $creator = new data_userProfile();
    $creator = neo4j_getUserByID($userID)[0];

    // Create temporary html file
    // Get the html
    $guzzleClient = new GuzzleHttp\Client();

    // Check if there are tags
    if($tagsArray != NULL){
        $wTags = $tagsArray;
    } else {
        $wTags = [];
    }

    //Prepare the data to be sent to the template
    $wdata = [
                "form_params" => [
                    "createPDF" => true,
                    "lang" => ($creator->locale == "de_DE" ? "de_DE" : "en_EN"),
                    "wname" => $neo4jDataObject->name,
                    "wPicPath" => $neo4jDataObject->picPath,
                    "creatorName" => $creator->name,
                    "creatorShortBio" => $creator->shortBio,
                    "creatorPicPath" => $creator->picPath,
                    "creatorContact" => $creator->contact,
                    "creatorVisible" => $creator->visible,
                    "wDimensions" => $neo4jDataObject->dimensions,
                    "wTags" => $wTags,
                    "wDuration" => $neo4jDataObject->duration,
                    "wDifficulty" => $neo4jDataObject->difficulty,
                    "wRoundCount" => $neo4jDataObject->roundCount,
                    "wExCount" => $neo4jDataObject->exCount,
                    "wAnnotations" => $mysqlDataObject->annotations,
                    "wExerciseMap" => $mysqlDataObject->exerciseMap,
                    "wExerciseDescriptions" => $mysqlDataObject->exerciseDescriptions
                ]
             ];
    $wname = str_replace(" ", "-", $neo4jDataObject->name);
    // Also remove special chars and several hyphens following each other
    $wname = preg_replace("/[^A-Za-z0-9\-]/", "", $wname);
    $wname = preg_replace("/-+/", "-", $wname);

    $pdf_folder = __DIR__."/../../view/data/pdf/";

    $html = $guzzleClient->request("POST", $ENV_VARS["PDF_CREATION_TEMPLATE"], $wdata)->getBody();

    file_put_contents(__DIR__."/pdf/temp.html", $html);
    // Create the pdf
    $command = $ENV_VARS["WKHTMLTOPDF_CALL"]." -L 0mm -R 0mm -T 0mm -B 0mm --viewport-size 1600x900 --lowquality --load-media-error-handling skip --exclude-from-outline --encoding UTF-8 ".__DIR__."/pdf/temp.html ".$pdf_folder.$wname.".pdf";

    $default = ini_get('max_execution_time');
    set_time_limit(180);
    exec($command);
    set_time_limit($default);

    return $ENV_VARS["PDF_BASE_PATH"].$wname.".pdf";
}

/////// First, store the workout in MySQL and receive the auto incremented ID
/////// Use the ID to create a corresponding nodes and connections
    function data_createWorkout($userID, $mysqlDataObject, $neo4jDataObject, $exerciseIdArray, $tagsArray = NULL){
        global $ENV_VARS;
        // Determine whether there is no workout image and append a random one
        if($neo4jDataObject->picPath == ""){
            $neo4jDataObject->picPath = "default-".rand(1, 206).".jpg";
        }

        // Get exercise descriptions
        $exerciseDescriptions = [];
        for($i = 0; $i < count($exerciseIdArray); $i++){
            // First get each exercise's neo4j data
            $neo4jExerciseData = new data_exercisePreview();
            $neo4jExerciseData = neo4j_getExerciseById($exerciseIdArray[$i])[0];

            // Now create a new full exercise object
            $exerciseDescriptions[$i] = new data_exerciseFull();
            $exerciseDescriptions[$i] = $neo4jExerciseData;
            $exerciseDescriptions[$i]->fullDescr = mysql_getExerciseByID($exerciseIdArray[$i]);
        }

        // Append the exercise descriptions to the mysqldata object
        $mysqlDataObject->exerciseDescriptions = $exerciseDescriptions;

        // Now create the PDF
        $pdfPath = data_createPDF($userID, $mysqlDataObject, $neo4jDataObject, $tagsArray);

        // Store path in mysql
        $mysqlDataObject->pdfPath = $pdfPath;

        // Create new entry in MySQL and receive the newly generated workout ID
        $workoutID = mysql_createWorkout($mysqlDataObject);

        // With the generated workout ID generate a new node in Neo4j
        neo4j_createWorkout($userID, $workoutID, $neo4jDataObject);

        // Create connections to selected tags
        if($tagsArray != NULL){
            neo4j_workoutHasTag($workoutID, $tagsArray);
        }

        // Create connections to selected exercises
        neo4j_workoutHasExercise($workoutID, $exerciseIdArray);

        return $workoutID;
    }

//// Updating workout
/////// As data objects are passed to the function, it is important to set
/////// all object variables prior to execution, as empty vars will be substituted
/////// by the default values. Tags and exercises are optional, as they can but don't
/////// need to be changed. If they are passed to the function, ALL given tags or exercises
/////// are disconnected and new connections to the specified elements are created.
    function data_updateWorkout($userID, $mysqlDataObject, $neo4jDataObject, $tagsArray = NULL, $exerciseIdArray = NULL){
        // Determine whether there is no workout image and append a random one
        if($neo4jDataObject->picPath == ""){
            $neo4jDataObject->picPath = "default-".rand(1, 20).".jpg";
        }

        // Get exercise descriptions
        $exerciseDescriptions = [];
        for($i = 0; $i < count($exerciseIdArray); $i++){
            // First get each exercise's neo4j data
            $neo4jExerciseData = new data_exercisePreview();
            $neo4jExerciseData = neo4j_getExerciseById($exerciseIdArray[$i])[0];

            // Now create a new full exercise object
            $exerciseDescriptions[$i] = new data_exerciseFull();
            $exerciseDescriptions[$i] = $neo4jExerciseData;
            $exerciseDescriptions[$i]->fullDescr = mysql_getExerciseByID($exerciseIdArray[$i]);
        }

        // Append the exercise descriptions to the mysqldata object
        $mysqlDataObject->exerciseDescriptions = $exerciseDescriptions;

        // Create a new PDF from the new data
        $mysqlDataObject->pdfPath = data_createPDF($userID, $mysqlDataObject, $neo4jDataObject, $tagsArray);

        // Update the data in MySQL with the id stored in Neo4j and passed in the dataObject
        mysql_updateWorkout($neo4jDataObject->workout_id, $mysqlDataObject);

        // Update the properties of the node in Neo4j
        neo4j_updateWorkout($neo4jDataObject);

        // Check whether tags were passed to the function and update the relationships
        if($tagsArray != NULL){
            // Remove ALL connections to old tags
            neo4j_removeWorkoutHasTag($neo4jDataObject->workout_id);
            // ... and create new connection to the specified array of tags
            neo4j_workoutHasTag($neo4jDataObject->workout_id, $tagsArray);
        }

        // Check whether an exercise array was passed and update
        if($exerciseIdArray != NULL){
            // Remove ALL connections to old exercises
            neo4j_removeWorkoutHasExercises($neo4jDataObject->workout_id);
            // ... and create new connections
            neo4j_workoutHasExercise($neo4jDataObject->workout_id, $exerciseIdArray);
        }

        return $neo4jDataObject->workout_id;

    }


//// Deleting workout
    function data_deleteWorkout($workoutID){
        // First delete corresponding node in Neo4j, then in MySql
        neo4j_removeWorkout($workoutID);
        mysql_removeWorkout($workoutID);
    }

// EXERCISES
//// Creating exercise
/////// First, store the workout in MySQL and receive the auto incremented ID
/////// Use the ID to create a corresponding nodes and connections
    function data_createExercise($mysqlDataObject, $neo4jDataObject, $similarExercisesIdArray = NULL, $tagsArray = NULL){
        // Create new entry in MySQL and receive the newly generated exercise ID
        $exerciseID = mysql_createExercise($mysqlDataObject);

        // With the generated exercise ID generate a new node in Neo4j
        neo4j_createExercise($exerciseID, $neo4jDataObject);

        // Create connections to specified other exercises (SIMILAR)
        if($similarExercisesIdArray != NULL){
            neo4j_exerciseSimilar($exerciseID, $similarExercisesIdArray);
        }

        // Create connections to specified tags (HAS_TAG)
        if($tagsArray != NULL){
            neo4j_exerciseHasTag($exerciseID, $tagsArray);
        }
    }

//// Updating exercise
/////// Tags and exercises are optional, as they can but don't
/////// need to be changed. If they are passed to the function, ALL given tags or exercises
/////// are disconnected and new connections to the specified elements are created.
    function data_updateExercise($mysqlDataObject, $neo4jDataObject, $similarExercisesIdArray = NULL, $tagsArray = NULL){
        // Update the data in MySQL with the id stored in Neo4j and passed in the dataObject
        mysql_updateExercise($neo4jDataObject->exercise_id, $mysqlDataObject);

        // Update the properties of the node in Neo4j
        neo4j_updateExercise($neo4jDataObject);

        // Check whether an exercise array was passed and update the SIMILAR connections
        if($similarExercisesIdArray != NULL){
            // Remove ALL connections to old exercises
            neo4j_removeExerciseSimilar($neo4jDataObject->exercise_id);
            // ... and create new connections
            neo4j_exerciseSimilar($neo4jDataObject->exercise_id, $similarExercisesIdArray);
        }

        // Check whether tags were passed to the function and update the relationships
        if($tagsArray != NULL){
            // Remove ALL connections to old tags
            neo4j_removeExerciseHasTag($neo4jDataObject->exercise_id);
            // ... and create new connection to the specified array of tags
            neo4j_exerciseHasTag($neo4jDataObject->exercise_id, $tagsArray);
        }

    }

// Currently, it's not possible to delete an exercise due to the high incorporation

?>
