<?php

// MYSQL DATA MODEL FUNCTIONS
// GENERAL FUNCTIONS TO COMMUNICATE WITH MYSQL

//// Function to do all the preparing, committing and receiving the query data
//// $preparedParamsArray expects an array of ["all_param_types", {parameter_var_addresses}]
function mysql_commitQuery($queryString, $preparedParamsArray = NULL){
    // Look for the connection variable outside of the function
    global $mysql_con;
        
    // Prepare the statement and get the error msg if it fails, continue if ok
    if ( !($querySTMT = $mysql_con->prepare($queryString)) ) {
        $queryResult = "Prepare failed: (" . $mysql_con->errno . ") " . $mysql_con->error;
    } else {
        // Check if there are parameters to bind to the query amd
        // bind them dynamically to the query using call_user_func_array
        if($preparedParamsArray != NULL){
            if( !(call_user_func_array(array($querySTMT, 'bind_param'), $preparedParamsArray)) ){
                $queryResult = "Parameter binding failed of the query:\n".$queryString;
            }
        }   
        // Executing and getting the results of the query
        if( !($querySTMT->execute()) ){
            $queryResult = "Execute failed: (" . $querySTMT->errno . ") " . $querySTMT->error;
        } else { // Everything went good, get the results           
            // Differentiate between SELECT, INSERT, UPDATE and DELETE operations
            // as some of them do not return any result, but the status or the 
            // insert_id should be handed over to the caller
            if(strpos($queryString, "INSERT") !== false){
                // Return the insert_id after an insert
                $queryResult = $querySTMT->insert_id;       
            
            } else if(strpos($queryString, "UPDATE") !== false || strpos($queryString, "DELETE") !== false){
                // Return a boolean value for successful update or deletion 
                $queryResult = true;                 
            } else {          
                // Return the selected data (i.e. a numeric array)
                $resultSet = $querySTMT->get_result();

                $queryResult = $resultSet->fetch_row();
                // Free the resultSet
                $resultSet->free();
            }                
        }                 
        // Close statement
        $querySTMT->close();
    }
    
    return $queryResult;    
}

// READING

//// DIRECT CALL FOR ELEMENTS (BY ID)
//// ... for workouts
    function mysql_getWorkoutByID($workoutID){       
        // Built the MySqlStatement
        $query = "SELECT annotations, pdfPath, exerciseMap, exerciseDescriptions FROM sfwb_workouts WHERE workout_id = ?";

        // Built the array of parameters and their types to be bind to the query statement
        $params = array("i", &$workoutID );
        
        // Do the query and get the results
        $result = mysql_commitQuery($query, $params);
        // Unserialize the exerciseMap
        $result[2] = unserialize($result[2]);
        $result[3] = unserialize($result[3]);

        return $result;
    }
    
    // Generate random name
    function mysql_getRandomWorkoutName(){
        // Get a random verb
        $query = "SELECT verbs FROM sfwb_namegen ORDER BY RAND( ) LIMIT 1";
        $rands[0] = mysql_commitQuery($query)[0];        
        $query = "SELECT adjectives FROM sfwb_namegen ORDER BY RAND( ) LIMIT 1";
        $rands[1] = mysql_commitQuery($query)[0]; 
        $query = "SELECT nouns FROM sfwb_namegen ORDER BY RAND( ) LIMIT 1";
        $rands[2] = mysql_commitQuery($query)[0];
        // Now randomly choose either a verb or an adjective and build a string
        $result = $rands[rand(0,1)]." ".$rands[2];
        return $result;
    }
    
//// ... for exercises
    function mysql_getExerciseByID($exerciseID){
        // Built the MySqlStatement
        $query = "SELECT fullDescr FROM sfwb_exercises WHERE exercise_id = ?";

        // Built the array of parameters and their types to be bind to the query statement
        $params = array("i", &$exerciseID );

        // Do the query and get the results
        $result = mysql_commitQuery($query, $params);

        return $result[0];
    }


// WRITING

//// WORKOUTS
/////// Create workout
/////// ATTENSION: THE IDENTIFING ID IS CREATED BY MySQL, so be sure to first store the data set
///////             in MySQL DB and afterwards in Neo4j
    function mysql_createWorkout($mysqlDataObj){
        // Built the MySqlStatement
        $query = "INSERT INTO sfwb_workouts (annotations, pdfPath, exerciseMap, exerciseDescriptions) ";
        $query .= " VALUES ( ? , ? , ? , ?)";

        $exerciseMapSerial = serialize($mysqlDataObj->exerciseMap);
        $exerciseDescriptionsSerial = serialize($mysqlDataObj->exerciseDescriptions);
        // Built the array of parameters and their types to be bind to the query statement
        // (by getting the data out of the passed object)        
        $params = array("ssss", & $mysqlDataObj->annotations, & $mysqlDataObj->pdfPath, & $exerciseMapSerial , & $exerciseDescriptionsSerial);
        
        // Do the query and check if there are no results (e.g. no error messages, so the creation was successfull)
        $result =  mysql_commitQuery($query, $params);
        
        return $result;    
    } 

/////// Update workout details
    function mysql_updateWorkout($workoutID, $mysqlDataObj){
        // Built the MySqlStatement
        $query = "UPDATE sfwb_workouts ";
        $query .= "SET annotations = ? , pdfPath = ?, exerciseMap = ?, exerciseDescriptions = ? ";
        $query .= "WHERE workout_id = ? ";

        $exerciseMapSerial = serialize($mysqlDataObj->exerciseMap);
        $exerciseDescriptionsSerial = serialize($mysqlDataObj->exerciseDescriptions);
        // Built the array of parameters and their types to be bind to the query statement
        // (by getting the data out of the passed object)     
        $params = array("ssssi", & $mysqlDataObj->annotations, & $mysqlDataObj->pdfPath, & $exerciseMapSerial, & $exerciseDescriptionsSerial, &$workoutID );

        // Do the query and check if there are no results (e.g. no error messages, so the creation was successfull)
        $result = mysql_commitQuery($query, $params);

        return $result;        
    }

/////// Remove a workout from the database (
/////// doesn't delete eventual files on the filesystem but just stored paths)
    function mysql_removeWorkout($workoutID){
        // Built the MySqlStatement
        $query = "DELETE FROM sfwb_workouts WHERE workout_id = ? ";

        // Built the array of parameters and their types to be bind to the query statement
        $params = array("i", &$workoutID );

        // Do the query and check if there are no results (e.g. no error messages, so the creation was successfull)
        $result = mysql_commitQuery($query, $params);

        return $result;    
    }

//// EXERCISE
//// Although not included in the current frontend, these functions
//// may be used to manage the exercises
/////// Creating an exercise
    function mysql_createExercise($mysqlDataObj){
        // Built the MySqlStatement
        $query = "INSERT INTO sfwb_exercise (fullDescr) ";
        $query .= " VALUES ( ? )";

        // Built the array of parameters and their types to be bind to the query statement
        // (by getting the data out of the passed object)     
        $params = array("s", & $mysqlDataObj->fullDescr );

        // Do the query and check if there are no results (e.g. no error messages, so the creation was successfull)
        $result = mysql_commitQuery($query, $params);

        return $result;   
    }

/////// Updating an exercise
    function mysql_updateExercise($exerciseID, $mysqlDataObj){
        // Built the MySqlStatement
        $query = "UPDATE sfwb_exercise ";
        $query .= "SET fullDescr = ? ";
        $query .= "WHERE exercise_id = ? ";

        // Built the array of parameters and their types to be bind to the query statement
        // (by getting the data out of the passed object)     
        $params = array("si", & $mysqlDataObj->fullDescr, &$exerciseID );

        // Do the query and check if there are no results (e.g. no error messages, so the creation was successfull)
        $result = mysql_commitQuery($query, $params);

        return $result;    
    }

?>