<?php

// NEO4J DATA MODEL FUNCTIONS
// GENERAL FUNCTIONS TO COMMUNICATE WITH NEO4J
//// Function to do the whole query building and result retrieval
//// $namedParams expects an array of "param_name" => param_data
function neo4j_commitQuery($queryString, $namedParams = NULL){
    // Look for the connection variable outside of the function
    global $neo4jclient;

    // Pass the query to Neo4j
    $queryCommit = new Everyman\Neo4j\Cypher\Query($neo4jclient, $queryString, $namedParams);

    // Get the results, returns message on failure
    $queryResult = $queryCommit->getResultSet();

    // Return the result object to the caller
    return $queryResult;
}

// Building the data objects out of the query results
//// ... for queries which result in the standard data_workoutPreview object
function neo4j_mkObj_wPrev($queryResult){
    // Prepare a result array
    $resultArray = array();

    // Loop through every element of the resultSet
    for($i = 0; $i < count($queryResult); $i++){
        // Create a new instance of the preview object
        $resultArray[$i] = new data_workoutPreview();

        // Write the data in the row into the object
        $resultArray[$i]->name = $queryResult[$i]["w.name"];
        $resultArray[$i]->workout_id = $queryResult[$i]["w.workout_id"];
        $resultArray[$i]->dimensions = [];
        foreach($queryResult[$i]["w.dimensions"] as $dimension){
            array_push($resultArray[$i]->dimensions, $dimension);
        }
        $resultArray[$i]->duration = $queryResult[$i]["w.duration"];
        $resultArray[$i]->exCount = $queryResult[$i]["w.exCount"];
        $resultArray[$i]->roundCount = $queryResult[$i]["w.roundCount"];
        $resultArray[$i]->difficulty = $queryResult[$i]["w.difficulty"];
        $resultArray[$i]->picPath = $queryResult[$i]["w.picPath"];
        $resultArray[$i]->creator_name = $queryResult[$i]["u.name"];
        $resultArray[$i]->creator_id = $queryResult[$i]["u.user_id"];
        $resultArray[$i]->creator_picPath = $queryResult[$i]["u.picPath"];
        $resultArray[$i]->creator_shortBio = $queryResult[$i]["u.shortBio"];
    }
    // Now each element in the result array is a preview object
    return $resultArray;
}

//// ... for queries which result in the standard data_exercisePreview object
function neo4j_mkObj_ePrev($queryResult){
    // Prepare a result array
    $resultArray = array();

    // Loop through every element of the resultSet
    for($i = 0; $i < count($queryResult); $i++){
        // Create a new instance of the preview object
        $resultArray[$i] = new data_exercisePreview();

        // Write the data in the row into the object
        $resultArray[$i]->name = $queryResult[$i]["e.name"];
        $resultArray[$i]->exercise_id = $queryResult[$i]["e.exercise_id"];
        $resultArray[$i]->duration = $queryResult[$i]["e.duration"];
        $resultArray[$i]->alias = [];
        if(isset($queryResult[$i]["e.alias"])){
            foreach($queryResult[$i]["e.alias"] as $alias){
                array_push($resultArray[$i]->alias, $alias);
            }
        }
        $resultArray[$i]->picPath = [];
        if(isset($queryResult[$i]["e.picPath"] )){
            foreach($queryResult[$i]["e.picPath"] as $pic){
                array_push($resultArray[$i]->picPath, $pic);
            }
        }
        $resultArray[$i]->shortDescr = $queryResult[$i]["e.shortDescr"];
        $resultArray[$i]->execModi = [];
        foreach($queryResult[$i]["e.execModi"] as $mode){
            array_push($resultArray[$i]->execModi, $mode);
        }
        $resultArray[$i]->dimensions = [];
        foreach($queryResult[$i]["e.dimensions"] as $dimension){
            array_push($resultArray[$i]->dimensions, $dimension);
        }
        $resultArray[$i]->equipment = $queryResult[$i]["e.equipment"];
        $resultArray[$i]->difficulty = $queryResult[$i]["e.difficulty"];
    }
    // Now each element in the result array is a preview object
    return $resultArray;
}

//// ... for queries which result in the standard data_userProfile object
function neo4j_mkObj_uProfile($queryResult){
    // Prepare a result array
    $resultArray = array();

    // Loop through every element of the resultSet
    for($i = 0; $i < count($queryResult); $i++){
        // Create a new instance of the preview object
        $resultArray[$i] = new data_userProfile();

        // Write the data in the row into the object
        $resultArray[$i]->name = $queryResult[$i]["u.name"];
        $resultArray[$i]->user_id = $queryResult[$i]["u.user_id"];
        $resultArray[$i]->email =  $queryResult[$i]["u.email"];
        $resultArray[$i]->confirmed =  $queryResult[$i]["u.confirmed"];
        $resultArray[$i]->contact = $queryResult[$i]["u.contact"];
        $resultArray[$i]->visible = $queryResult[$i]["u.visible"];
        $resultArray[$i]->picPath = $queryResult[$i]["u.picPath"];
        $resultArray[$i]->shortBio = $queryResult[$i]["u.shortBio"];
        $resultArray[$i]->locale = $queryResult[$i]["u.locale"];
        $resultArray[$i]->gender = $queryResult[$i]["u.gender"];
    }
    // Now each element in the result array is a preview object
    return $resultArray;
}

//// ... for queries which result in the full data_userProfile object
function neo4j_mkObj_uProfileFull($queryResult){
    // Prepare a result array
    $resultArray = array();

    // Loop through every element of the resultSet
    for($i = 0; $i < count($queryResult); $i++){
        // Create a new instance of the preview object
        $resultArray[$i] = new data_userProfileFull();

        // Write the data in the row into the object
        $resultArray[$i]->name = $queryResult[$i]["u.name"];
        $resultArray[$i]->user_id = $queryResult[$i]["u.user_id"];
        $resultArray[$i]->contact = $queryResult[$i]["u.contact"];
        $resultArray[$i]->visible = $queryResult[$i]["u.visible"];
        $resultArray[$i]->picPath = $queryResult[$i]["u.picPath"];
        $resultArray[$i]->shortBio = $queryResult[$i]["u.shortBio"];
        $resultArray[$i]->locale = $queryResult[$i]["u.locale"];
        $resultArray[$i]->gender = (isset($queryResult[$i]["u.gender"]) ? $queryResult[$i]["u.gender"] : "male" );
        // Prepare the motive, difficulty and dimension arrays
        $difficulty = [];
        $dimensions = [];
        $motives = [];
        if(isset($queryResult[$i]["u.preferredDifficulty"])){
            foreach($queryResult[$i]["u.preferredDifficulty"] as $val){
                array_push($difficulty, $val);
            }
        }
        if(isset($queryResult[$i]["preferredDimensions"])){
            foreach($queryResult[$i]["preferredDimensions"] as $dim){
                array_push($dimensions, $dim);
            }
        }
        if(isset($queryResult[$i]["motives"])){
            foreach($queryResult[$i]["motives"] as $m){
                array_push($motives, $m);
            }
        }
        $resultArray[$i]->preferences = [
                    "difficulty" => $difficulty,
                    "dimensions" => $dimensions,
                    "motives" => $motives,
                    "frequency" => (isset($queryResult[$i]["u.trainingFrequency"]) ? $queryResult[$i]["u.trainingFrequency"] : 3)
                    ];
        $resultArray[$i]->password = (isset($queryResult[$i]["u.password"]) ? $queryResult[$i]["u.password"] : "" );
        $resultArray[$i]->email = $queryResult[$i]["u.email"];
        $resultArray[$i]->confirmed =  (isset($queryResult[$i]["u.confirmed"]) ? $queryResult[$i]["u.confirmed"] : false);
        $resultArray[$i]->fbid = (isset($queryResult[$i]["u.fbid"])?$queryResult[$i]["u.fbid"]:"");
    }
    // Now each element in the result array is a preview object
    return $resultArray;
}

// READING

//// DIRECT CALL FOR ELEMENTS
//// ... for users (byID)
function neo4j_getUserByID($userID){
    // Built the Cypher query with named parameters
    //// Find the user by ID and return the profile relevant information
    $query = "MATCH (u:User {user_id: {user_id} }) ";
    $query .= "OPTIONAL MATCH (m:Motive)<-[:PREFERS]-(u)-[:PREFERS]->(d:Dimension) ";
    $query .= "RETURN u.name, u.password, u.user_id, u.email, u.confirmed, u.contact, u.visible, u.shortBio, u.locale, u.picPath,
                u.gender, u.preferredDifficulty, u.trainingFrequency, COLLECT(DISTINCT m.name) AS motives, COLLECT(DISTINCT d.name) AS preferredDimensions LIMIT 1";

    // Define the named parameters array
    $params = array("user_id" => $userID);

    // Sending the Cypher query and retrieving the result set
    $resultSet = neo4j_commitQuery($query, $params);

    $returnArr = neo4j_mkObj_uProfileFull($resultSet);

    return $returnArr;
}

//// ... for users (byEmail)
function neo4j_getUserByEmail($userEmail){
    // Built the Cypher query with named parameters
    //// Find the user by email and return the profile relevant information
    $query = "MATCH (u:User {email: {email} }) ";
    $query .= "RETURN u.name, u.user_id, u.confirmed, u.contact, u.visible, u.shortBio, u.locale, u.picPath, u.gender LIMIT 1";

    // Define the named parameters array
    $params = array("email" => $userEmail);

    // Sending the Cypher query and retrieving the result set
    $resultSet = neo4j_commitQuery($query, $params);

    $returnArr = neo4j_mkObj_uProfile($resultSet);

    return $returnArr;
}

//// ... for users (byEmail) RETURN FULL USER OBJECT (JUST FOR AUTH PURPOSE)
function neo4j_authUserByEmail($userEmail){
    // Built the Cypher query with named parameters
    //// Find the user by email and return the profile relevant information
    $query = "MATCH (u:User {email: {email} }) ";
    $query .= "OPTIONAL MATCH (m:Motive)<-[:PREFERS]-(u)-[:PREFERS]->(d:Dimension) ";
    $query .= "RETURN u.name, u.password, u.user_id, u.email, u.confirmed, u.contact, u.visible, u.shortBio, u.locale, u.picPath,
                u.gender, u.preferredDifficulty, u.trainingFrequency, COLLECT(DISTINCT m.name) AS motives, COLLECT(DISTINCT d.name) AS preferredDimensions LIMIT 1";
    // Define the named parameters array
    $params = array("email" => $userEmail);

    // Sending the Cypher query and retrieving the result set
    $resultSet = neo4j_commitQuery($query, $params);

    $returnArr = neo4j_mkObj_uProfileFull($resultSet);

    return $returnArr;
}

//// ... for users (byFacebook)
function neo4j_getUserByFB($fbid){
    // Built the Cypher query with named parameters
    //// Find the user by email and return the profile relevant information
    $query = "MATCH (u:User {fbid: {fbid} }) ";
    $query .= "OPTIONAL MATCH (m:Motive)<-[:PREFERS]-(u)-[:PREFERS]->(d:Dimension) ";
    $query .= "RETURN u.name, u.password, u.fbid, u.user_id, u.email, u.confirmed, u.contact, u.visible, u.shortBio, u.locale, u.picPath,
                u.gender, u.preferredDifficulty, u.trainingFrequency, COLLECT(DISTINCT m.name) AS motives, COLLECT(DISTINCT d.name) AS preferredDimensions LIMIT 1";
    // Define the named parameters array
    $params = array("fbid" => $fbid);

    // Sending the Cypher query and retrieving the result set
    $resultSet = neo4j_commitQuery($query, $params);

    $returnArr = neo4j_mkObj_uProfileFull($resultSet);

    return $returnArr;
}

//// ... for workouts
function neo4j_getWorkoutByID($workoutID){
    // Built the Cypher query with named parameters
    //// Find the workout by ID and return the preview
    $query = "MATCH (w:Workout {workout_id: {workout_id} }) ";
    $query .= "WITH w MATCH (w)<-[:CREATED]-(u:User) ";
    $query .= "RETURN w.name, w.workout_id, w.dimensions, w.difficulty, w.duration, w.roundCount, w.exCount, w.picPath, u.name, u.user_id, u.picPath, u.shortBio LIMIT 1";

    // Define the named parameters array
    $params = array("workout_id" => $workoutID);

    // Sending the Cypher query and retrieving the result set
    $resultSet = neo4j_commitQuery($query, $params);

    $returnArr = neo4j_mkObj_wPrev($resultSet);

    return $returnArr;
}

//// ... for exercises
function neo4j_getExerciseByID($exerciseID){
     // Built the Cypher query with named parameters
     //// Find the exercise by ID and return the preview
    $query = "MATCH (e:Exercise {exercise_id: {exercise_id} }) ";
    $query .= "RETURN e.name, e.exercise_id, e.alias, e.duration, e.picPath, e.shortDescr, e.execModi, e.dimensions, e.equipment, e.difficulty LIMIT 1";

    // Define the named parameters array
    $params = array("exercise_id" => $exerciseID);

    // Sending the Cypher query and retrieving the result set
    $resultSet = neo4j_commitQuery($query, $params);

    $returnArr = neo4j_mkObj_ePrev($resultSet);

    return $returnArr;
}

//// TAGS
/////// Get the tags with the most connections, maximum n tags are returned
    function neo4j_getRelevantTags($n){
        // Built the Cypher query
        //// Find all tags and their connections, return the tag names
        //// and order by the number of connections
        $query = "MATCH (t:Tag)<-[r:HAS_TAG]-()";
        $query .= "RETURN t.name, count(r) as connections ";
        $query .= "ORDER BY connections DESC LIMIT {maximum}";

        // Define the named parameters array
        $params = array("maximum" => $n);

        // Sending the Cypher query and retrieving the result set
        $queryResult = neo4j_commitQuery($query, $params);

        // Getting the name of each set out of the result set
        $resultArray = array();
        foreach($queryResult as $tag){
            $resultArray[] = $tag["t.name"];
        }

        return $resultArray;
    }

/////// Search for a tag, regular expressions are valid, maximum $n tags are returned
    function neo4j_searchTag($searchWord, $n){
        // Built regular expression for string
        $searchWord = "(?i).*(".$searchWord.").*?";

        // Built the Cypher query with named parameters
        //// Find a tag by his name/ oarts of his name, return more complete matches first
        $query = "MATCH (t:Tag)";
        $query .= "WHERE t.name =~ {searchWord}";
        $query .= "RETURN t.name ORDER BY t.name ASC LIMIT {maximum}";

        // Define the named parameters array
        $params = array("searchWord" => $searchWord, "maximum" => $n);

        // Sending the Cypher query and retrieving the result set
        $queryResult = neo4j_commitQuery($query, $params);

        // Getting the name of each set out of the result set
        $resultArray = array();
        foreach($queryResult as $tag){
            $resultArray[] = $tag["t.name"];
        }

        return $resultArray;
    }


//// WORKOUTS
/////// Return a set of $n random workouts, paginated by $skip
    function neo4j_getRandomWorkouts($n, $skip, $tagArray = NULL){
        // Built the Cypher query with named parameters
        //// Look at a random portion of all workouts and return their previews,
        //// eventually with a certain tag
        // Add another WHERE clause, if some tags are included
        if($tagArray != NULL){
            // Transform all tags in the array to lower case
            $tagArray = array_map('strtolower', $tagArray);
            $query = "MATCH (w)-[:HAS_TAG]->(t:Tag) WHERE lower(t.name) IN {tags}";
        } else {
            $query = "MATCH (w:Workout) ";
        }
        $query .= "WITH w, rand() as rand ORDER BY rand LIMIT 1000 ";

        $query .= "MATCH (w)<-[:CREATED]-(u:User) ";
        $query .= "RETURN w.name, w.workout_id, w.dimensions, w.duration, w.difficulty, w.roundCount, w.exCount, w.picPath, u.name, u.user_id, u.picPath, u.shortBio ";
        $query .= "SKIP {pagination} LIMIT {maximum}";

        // Define the named parameters array
        if($tagArray != NULL){
            $params = array("tags" => $tagArray, "pagination" => $skip, "maximum" => $n);
        } else {
            $params = array("pagination" => $skip, "maximum" => $n);
        }

        // Sending the Cypher query and retrieving the result set
        $resultSet = neo4j_commitQuery($query, $params);

        $returnArray = neo4j_mkObj_wPrev($resultSet);

        return $returnArray;
    }

/////// Return a set of $n workouts, ordered by likes, paginated by $skip
    function neo4j_getMostLikedWorkouts($n, $skip, $tagArray = NULL){
        // Built the Cypher query with named parameters
        //// Look at all workouts and their likes, return the workouts paginated and ordered by likes
        $query = "MATCH (w:Workout)<-[r:LIKED]-() ";
        // Add another WHERE clause, if some tags are included
        if($tagArray != NULL){
            // Transform all tags in the array to lower case
            $tagArray = array_map('strtolower', $tagArray);
            $query .= "WITH w MATCH (w)-[:HAS_TAG]->(t:Tag) WHERE lower(t.name) IN {tags} ";
        }
        $query .= "WITH w, count(r) as likes ORDER BY likes DESC SKIP {pagination} LIMIT {maximum} ";
        $query .= "MATCH (w)<-[:CREATED]-(u:User) ";
        $query .= "RETURN w.name, w.workout_id, w.dimensions, w.duration, w.difficulty, w.roundCount, w.exCount, w.picPath, u.name, u.user_id, u.picPath, u.shortBio ";
        $query .= "SKIP {pagination} LIMIT {maximum}";

        // Define the named parameters array
        if($tagArray != NULL){
            $params = array("tags" => $tagArray, "pagination" => $skip, "maximum" => $n);
        } else {
            $params = array("pagination" => $skip, "maximum" => $n);
        }

        // Sending the Cypher query and retrieving the result set
        $resultSet = neo4j_commitQuery($query, $params);

        $returnArray = neo4j_mkObj_wPrev($resultSet);

        return $returnArray;
    }

/////// Return a set of $n workouts, with one or more tags, ordered by count of matches, paginated by $skip
/////// $tagArray expects an COLLECTION like ["tag1", "tag2", "tag3"]

    function neo4j_getTaggedWorkouts($tagArray, $difficultyRange, $timeRange, $n, $skip){
        // Filter options
        $difficultyMin = ($difficultyRange[0]!=0 ? $difficultyRange[0] : 1.0);
        $difficultyMax = ($difficultyRange[1]!=0 ? $difficultyRange[1] : 5.0);
        $timeMin = ($timeRange[0]!=0 ? $timeRange[0] : 0);
        $timeMax = ($timeRange[1]!=0 ? $timeRange[1] : 1000000);

        // Built the Cypher query with named parameters
        if(count($tagArray)){
            // Transform all tags in the array to lower case
            $tagArray = array_map('strtolower', $tagArray);
            //// Find paths expressing that a workout has one or several tag(s)
            //// and return the workouts with the most matched tags first
            $query = "MATCH (t:Tag)<-[r:HAS_TAG]-(w:Workout) ";
            $query .= "WHERE lower(t.name) IN {tags} AND w.difficulty >= {difficultyMin} AND w.difficulty <= {difficultyMax} AND w.duration >= {timeMin} AND w.duration <= {timeMax} ";
            $query .= "WITH w, count(r) as tagMatches ORDER BY tagMatches DESC SKIP {pagination} LIMIT {maximum} ";
            $query .= "MATCH (w)<-[:CREATED]-(u:User) ";
            $query .= "RETURN tagMatches, w.name, w.workout_id, w.dimensions, w.duration, w.difficulty, w.roundCount, w.exCount, w.picPath, u.name, u.user_id, u.picPath, u.shortBio ";
            $query .= "ORDER BY tagMatches DESC SKIP {pagination} LIMIT {maximum}";
        } else {
            //// For the case no tags were passed just use the filter
            $query = "MATCH (w:Workout) ";
            $query .= "WHERE w.difficulty >= {difficultyMin} AND w.difficulty <= {difficultyMax} AND w.duration >= {timeMin} AND w.duration <= {timeMax} ";
            $query .= "WITH w MATCH (w)<-[:CREATED]-(u:User) ";
            $query .= "RETURN w.name, w.workout_id, w.dimensions, w.duration, w.difficulty, w.roundCount, w.exCount, w.picPath, u.name, u.user_id, u.picPath, u.shortBio ";
            $query .= "SKIP {pagination} LIMIT {maximum}";
        }

        // Define the named parameters array
        $params = array("tags" => $tagArray, "difficultyMin" => $difficultyMin, "difficultyMax" => $difficultyMax, "timeMin" => $timeMin, "timeMax" => $timeMax, "pagination" => $skip, "maximum" => $n);

        // Sending the Cypher query and retrieving the result set
        $resultSet = neo4j_commitQuery($query, $params);

        $returnArray = neo4j_mkObj_wPrev($resultSet);

        return $returnArray;
    }

//////// Return a set of $n workouts based on the preferences (associative array with the attributes "motives", "difficulty", "regularity", "dimensions")
///////// The attributes have the following structure:
///////// "motives" = ["Fun with friends" => true, "Healthy" =>true, "Versatile" => true, "Quick and dirty" => true, "Go further" => true, "Be free" => true ];
///////// "difficulty" = [1.0, 5.0];
///////// "dimensions" = [true, true, true, true];
    function neo4j_getCustomizedWorkouts($preferences, $n, $skip){
        // The cypher query depends on the preferences and needs to be built dynamically
        // First, built an array of the subquery collection identifiers to pass on subqueries' datasets
        $subqueryIdentifier = [];
        $subqueryID = 0;
        foreach($preferences["motives"] as $motiveField){
            if($motiveField){
                array_push($subqueryIdentifier, ["resultSet".$subqueryID, $subqueryID] );
            }
            $subqueryID++;
        }
        // Built the main query from subqueries
        $query = "";
        $totalResultIdentifier = "";
        $motiveOptions = array_keys($preferences["motives"]);
        for($i = 0; $i < count($subqueryIdentifier); $i++){
            // Prepare the total result identifier
            if($i == 0){
                $totalResultIdentifier .= $subqueryIdentifier[$i][0];
            } else {
                $totalResultIdentifier .= " + ".$subqueryIdentifier[$i][0];
            }
            // Built the past subquery result set carrier (sum up all the subquery identifiers until the current subquery)
            $pastQueryCarrier = "";
            for($c = 0; $c < $i; $c++){
                if($c == 0){
                    $pastQueryCarrier .= $subqueryIdentifier[$c][0];
                } else {
                    $pastQueryCarrier .= ", ".$subqueryIdentifier[$c][0];
                }
            }
            // Create the subquery
            $query .= buildPreferenceSubquery($subqueryIdentifier[$i][1], $subqueryIdentifier[$i][0], $pastQueryCarrier);
        }

        // Prepare the odering query part
        $orderQuery = "";
        for($i = 0; $i < count($preferences["dimensions"]); $i++){
            if($preferences["dimensions"][$i]){
                $orderQuery .= "CASE WHEN w.dimensions[".$i."] >= {dimMinMatch} THEN w.dimensions[".$i."] ELSE 0.0 END + ";
            }
        }
        $orderQuery = rtrim($orderQuery, "+ ");
        // Now attach the return, filter and order query part
        $returnAndFilter = " WITH  ".$totalResultIdentifier." AS all
                        UNWIND all AS w WITH DISTINCT w, (".$orderQuery.") AS dimMatch
                        ORDER BY dimMatch DESC SKIP {pagination} LIMIT {maximum}
                        MATCH (w)<-[:CREATED]-(u:User)
                        RETURN w.name, w.workout_id, w.dimensions, w.duration, w.difficulty, w.roundCount, w.exCount, w.picPath, u.name, u.user_id, u.picPath, u.shortBio";

        // Finally merge the main query and the result set
        $query .= $returnAndFilter;

        // Define the params
        $params = array("diffMin" => $preferences["difficulty"][0], "diffMax" => $preferences["difficulty"][1], "dimMinMatch" => 0.5, "pagination" => $skip, "maximum" => $n);
        // Sending the query and receiving the result set
        $resultSet = neo4j_commitQuery($query, $params);
        $returnArray = neo4j_mkObj_wPrev($resultSet);
        return $returnArray;
    }
// Helper function to built subqueries related to workout preferences
///// ATTENTION: Some parts of the subqueries are parameterized, so the return can't serve as independent query
function buildPreferenceSubquery($queryId, $queryIdentifier, $carrier){
    $subquery = "";
    $carrier = (strlen($carrier)!=0 ? ", ": "").$carrier;
    switch($queryId){
        case 0:
            $subquery .= " MATCH (t:Tag {name: \"Fun with Friends\"}) WITH t
                MATCH (t)<-[:HAS_TAG]-(w:Workout)
                WHERE w.difficulty >= {diffMin} AND w.difficulty <= {diffMax}
                WITH  COLLECT(w) AS ".$queryIdentifier.$carrier;
            break;
        case 1:
            $subquery .= " MATCH (t:Tag {name: \"Be Fit\"}) WITH t ".$carrier."
                MATCH (t)<-[:HAS_TAG]-(w:Workout)
                WHERE w.difficulty >= {diffMin} AND w.difficulty <= {diffMax}
                WITH COLLECT(w) AS ".$queryIdentifier.$carrier;
            break;
        case 2:
            $subquery .= " MATCH (t:Tag {name: \"Inspirational\"}) WITH t ".$carrier."
                MATCH (t)<-[:HAS_TAG]-(w1:Workout)
                WHERE w1.difficulty >= {diffMin} AND w1.difficulty <= {diffMax}
                WITH COLLECT(w1) as col1 ".$carrier."
                MATCH (w2:Workout)
                WHERE w2.exCount > 6 AND w2.difficulty >= 1.0 AND w2.difficulty <= 5.0
                WITH COLLECT(w2) + col1 AS all ".$carrier." UNWIND all AS w WITH DISTINCT w ".$carrier."
                WITH COLLECT(w) AS ".$queryIdentifier.$carrier;
            break;
        case 3:
            $subquery .= " MATCH (w1:Workout)-[r1:HAS_EXERCISE]->(:Exercise)
                WHERE w1.duration <= 600 AND w1.difficulty >= 3.0 AND w1.difficulty <= 5.0
                WITH w1, count(r1) AS totalExercises ".$carrier."
                MATCH (w1)-[r2:HAS_EXERCISE]->(e2:Exercise)
                WHERE e2.difficulty >= 4
                WITH w1, totalExercises, count(r2) AS diffExercises ".$carrier."
                WHERE TOFLOAT(diffExercises)/totalExercises >= 0.3
                WITH COLLECT(w1) AS col1 ".$carrier."
                MATCH (t1:Tag)<-[:HAS_TAG]-(w2:Workout)
                WHERE t1.name IN [\"Beast Mode\", \"EMOM\", \"Tabata\"] AND w2.duration <= 600 AND w2.difficulty >= 3.0 AND w2.difficulty <= 5.0
                WITH COLLECT(w2) + col1 AS all ".$carrier." UNWIND all AS w WITH DISTINCT w ".$carrier."
                WITH COLLECT(w) AS ".$queryIdentifier.$carrier;
            break;
        case 4:
            $subquery .= " MATCH (w1:Workout)-[r1:HAS_EXERCISE]->(:Exercise)
                WHERE w1.difficulty >= {diffMin} AND w1.difficulty <= {diffMax}
                WITH w1, count(r1) AS totalExercises ".$carrier."
                MATCH (w1)-[r2:HAS_EXERCISE]->(e2:Exercise)
                WHERE e2.difficulty >= 4
                WITH w1, totalExercises, count(r2) AS diffExercises ".$carrier."
                WHERE TOFLOAT(diffExercises)/totalExercises >= 0.5
                WITH COLLECT(w1) AS col1 ".$carrier."
                MATCH (t)<-[:HAS_TAG]-(w2:Workout)
                WHERE w2.duration >= 25 * 60 AND w2.difficulty >= 1.0 AND w2.difficulty <= 5.0
                WITH COLLECT(w2) AS col2, col1 ".$carrier."
                MATCH (t:Tag)<-[:HAS_TAG]-(w3:Workout)
                WHERE t.name = \"Beast Mode\" AND w3.difficulty >= 1.0 AND w3.difficulty <= 5.0
                WITH COLLECT(w3) + col1 + col2 AS all ".$carrier." UNWIND all AS w WITH DISTINCT w ".$carrier."
                WITH COLLECT(w) AS ".$queryIdentifier.$carrier;
            break;
        case 5:
            $subquery .= " MATCH (w1:Workout)-[:HAS_EXERCISE]->(e1:Exercise)
                WHERE e1.equipment = false AND w1.difficulty >= {diffMin} AND w1.difficulty <= {diffMax}
                WITH COLLECT(w1) AS col1 ".$carrier."
                OPTIONAL MATCH (t:Tag {name: \"Travel\"})<-[:HAS_TAG]-(w2:Workout)
                WHERE w2.difficulty >= {diffMin} AND w2.difficulty <= {diffMax}
                WITH COLLECT(w2) + col1 AS all ".$carrier." UNWIND all AS w WITH DISTINCT w ".$carrier."
                WITH COLLECT(w) AS ".$queryIdentifier.$carrier;
            break;
    }

    return $subquery;
}

///// MAIN PERSONALIZATION FUNCTION //////////////////////////////////////////////////
/////// Return a set of $n workouts most suitable for a users preferences paginated by $skip
    function neo4j_getPersonalizedWorkouts($userID, $n, $skip){
        // Built the Cypher query with named parameters
        //// Search for workouts that have similar tags to those the user already liked,
        //// returning only those workouts, the user didn't liked yet or created,
        //// ordered by the number of common tags
        $query = "MATCH (u:User {user_id: {user_id} })-[:LIKED]->(wu:Workout)-[r1:HAS_TAG]->(t:Tag) ";
        $query .= "WITH u, t, count(r1) as commonTags ";
        $query .= "MATCH (t)<-[:HAS_TAG]-(w:Workout)<-[r2]-(u) ";
        $query .= "WHERE r2 IS NULL ";
        $query .= "WITH w, commonTags MATCH (w)<-[:CREATED]-(u:User) ";
        $query .= "RETURN w.name, w.workout_id, w.dimensions, w.duration, w.difficulty, w.roundCount, w.exCount, w.picPath, u.name, u.user_id, u.picPath, u.shortBio ";
        $query .= "ORDER BY commonTags DESC SKIP {pagination} LIMIT {maximum}";

        // Define the named parameters array
        $params = array("user_id" => $userID, "pagination" => $skip, "maximum" => $n);

        // Sending the Cypher query and retrieving the result set
        $resultSet = neo4j_commitQuery($query, $params);

        $returnArray = neo4j_mkObj_wPrev($resultSet);

        return $returnArray;
    }

/////// Return a set of $n workouts, with similar tags of a given workout, paginated by $skip
    function neo4j_getNearWorkoutWorkouts($workoutID, $n, $skip){
        // Built the Cypher query with named parameters
        //// Find workouts with the same tag(s) the given workout has,
        //// ordered by the number of common tags
        $query = "MATCH (w1:Workout {workout_id: {workout_id} })-[:HAS_TAG]->(t:Tag)<-[:HAS_TAG]-(w:Workout) ";
        $query .= "WITH w, count(*) as commonTags MATCH (w)<-[:CREATED]-(u:User ) ";
        $query .= "RETURN w.name, w.workout_id, w.dimensions, w.duration, w.difficulty, w.roundCount, w.exCount, w.picPath, u.name, u.user_id, u.picPath, u.shortBio ";
        $query .= "ORDER BY commonTags SKIP {pagination} LIMIT {maximum}";

        // Define the named parameters array
        $params = array("workout_id" => $workoutID, "pagination" => $skip, "maximum" => $n);

        // Sending the Cypher query and retrieving the result set
        $resultSet = neo4j_commitQuery($query, $params);

        $returnArray = neo4j_mkObj_wPrev($resultSet);

        return $returnArray;
    }

/////// Return a set of $n workouts, with tag(s) ordered by property, paginated by $skip
    function neo4j_getOrderedTaggedWorkouts($tagArray, $property, $n, $skip){
        // Built the Cypher query with named parameters
        // Transform all tags in the array to lower case
        $tagArray = array_map('strtolower', $tagArray);
        //// Find those workouts which have one or more given tag(s)
        //// and return them ordered by a given property e.g. duration
        $query = "MATCH (w:Workout)-[:HAS_TAG]->(t:Tag) ";
        $query .= "WHERE lower(t.name) IN {tags} ";
        $query .= "WITH w MATCH (w)<-[:CREATED]-(u:User) ";
        $query .= "RETURN w.name, w.workout_id, w.dimensions, w.duration, w.picPath, w.{propName} as orderProp, w.difficulty, w.roundCount, w.exCount, w.picPath, u.name, u.user_id, u.picPath, u.shortBio ";
        $query .= "ORDER BY orderProp DESC SKIP {pagination} LIMIT {maximum}";

        // Define the named parameters array
        $params = array("tags" => $tagArray, "propName" => $property, "pagination" => $skip, "maximum" => $n);

        // Sending the Cypher query and retrieving the result set
        $resultSet = neo4j_commitQuery($query, $params);

        $returnArray = neo4j_mkObj_wPrev($resultSet);

        return $returnArray;
    }

/////// Get user's liked workouts
        function neo4j_getUserFavs($userID, $n, $skip){
            // Built the Cypher query with named parameters
            //// Search for a workout by its name or the name of the connected tags
            $query = "MATCH (u2:User {user_id: {user_id} })-[:LIKED]->(w:Workout)<-[:CREATED]-(u:User) ";
            $query .= "RETURN w.name, w.workout_id, w.dimensions, w.duration, w.difficulty, w.roundCount, w.exCount, w.picPath, u.name, u.user_id, u.picPath, u.shortBio ";
            $query .= "SKIP {skip} LIMIT {maximum}";

            // Define the named parameters array
            $params = array("user_id" => $userID, "skip" => $skip, "maximum" => $n);

            // Sending the Cypher query and retrieving the result set
            $resultSet = neo4j_commitQuery($query, $params);

            $returnArray = neo4j_mkObj_wPrev($resultSet);

            return $returnArray;
        }

/////// Get user's liked workouts
        function neo4j_getUserCreatedWorkouts($userID, $n, $skip){
            // Built the Cypher query with named parameters
            //// Search for a workout by its name or the name of the connected tags
            $query = "MATCH (u:User {user_id: {user_id} })-[:CREATED]->(w:Workout) ";
            $query .= "RETURN w.name, w.workout_id, w.dimensions, w.duration, w.difficulty, w.roundCount, w.exCount, w.picPath, u.name, u.user_id, u.picPath, u.shortBio ";
            $query .= "SKIP {skip} LIMIT {maximum}";

            // Define the named parameters array
            $params = array("user_id" => $userID, "skip" => $skip, "maximum" => $n);

            // Sending the Cypher query and retrieving the result set
            $resultSet = neo4j_commitQuery($query, $params);

            $returnArray = neo4j_mkObj_wPrev($resultSet);

            return $returnArray;
        }

/////// Search for a workout, regular expressions are valid, maximum $n tags are returned
    function neo4j_searchWorkout($searchWord, $difficultyRange, $timeRange, $n, $skip){
        // Built regular expression for string
        $searchWordRegex = "(?i).*(".$searchWord.").*?";
        // Filter options
        $difficultyMin = ($difficultyRange[0]!=0 ? $difficultyRange[0]: 1.0);
        $difficultyMax = ($difficultyRange[1]!=0 ? $difficultyRange[1] : 5.0);
        $timeMin = ($timeRange[0]!=0 ? $timeRange[0] : 0);
        $timeMax = ($timeRange[1]!=0 ? $timeRange[1] : 1000000);

        // Built the Cypher query with named parameters
        //// Search for a workout by its name or the name of the connected tags
        $query = "MATCH (w:Workout) ";
        $query .= "WHERE w.name =~ {searchWordRegex} AND w.difficulty >= {difficultyMin} AND w.difficulty <= {difficultyMax} AND w.duration >= {timeMin} AND w.duration <= {timeMax} ";
        $query .= "WITH w MATCH (w)<-[:CREATED]-(u:User) ";
        $query .= "RETURN w.name, ABS( LENGTH(w.name) - LENGTH({searchWord}) ) AS nameDiff, w.workout_id, w.dimensions, w.duration, w.difficulty, w.roundCount, w.exCount, w.picPath, u.name, u.user_id, u.picPath, u.shortBio ";
        $query .= "ORDER BY nameDiff, w.name ASC SKIP {skip} LIMIT {maximum} ";
        $query .= "UNION ";
        $query .= "MATCH (u:User)-[:CREATED]->(w:Workout)-[r:HAS_TAG]->(t:Tag) ";
        $query .= "WHERE t.name =~ {searchWordRegex} AND w.difficulty >= {difficultyMin} AND w.difficulty <= {difficultyMax} AND w.duration >= {timeMin} AND w.duration <= {timeMax} ";
        $query .= "WITH w, u, count(r) AS tagMatches ORDER BY tagMatches DESC ";
        $query .= "RETURN w.name, ABS( LENGTH(w.name) - LENGTH({searchWord}) ) AS nameDiff, w.workout_id, w.dimensions, w.duration, w.difficulty, w.roundCount, w.exCount, w.picPath, u.name, u.user_id, u.picPath, u.shortBio ";
        $query .= "ORDER BY nameDiff, w.name ASC SKIP {skip} LIMIT {maximum} ";
        $query .= "UNION ";
        $query .= "MATCH (u:User)-[:CREATED]->(w:Workout)-[:HAS_EXERCISE]->(e:Exercise)-[r:HAS_TAG]->(t:Tag) ";
        $query .= "WHERE t.name =~ {searchWordRegex} AND w.difficulty >= {difficultyMin} AND w.difficulty <= {difficultyMax} AND w.duration >= {timeMin} AND w.duration <= {timeMax} ";
        $query .= "WITH w, u, count(r) AS tagMatches ORDER BY tagMatches DESC ";
        $query .= "RETURN w.name, ABS( LENGTH(w.name) - LENGTH({searchWord}) ) AS nameDiff, w.workout_id, w.dimensions, w.duration, w.difficulty, w.roundCount, w.exCount, w.picPath, u.name, u.user_id, u.picPath, u.shortBio ";
        $query .= "ORDER BY nameDiff, w.name ASC SKIP {skip} LIMIT {maximum} ";

        // Define the named parameters array
        $params = array("searchWordRegex" => $searchWordRegex, "searchWord" => $searchWord, "difficultyMin" => $difficultyMin, "difficultyMax" => $difficultyMax, "timeMin" => $timeMin, "timeMax" => $timeMax, "skip" => $skip, "maximum" => $n);

        // Sending the Cypher query and retrieving the result set
        $resultSet = neo4j_commitQuery($query, $params);

        $returnArray = neo4j_mkObj_wPrev($resultSet);

        return $returnArray;
    }

// Get an array of all exercises contained in a workout and their neo4j data
function neo4j_getWorkoutExercises($workoutID){
    // Built the Cypher query with named parameters
    //// Find the workout by ID and return the preview
    $query = "MATCH (w:Workout {workout_id: {workout_id} }) ";
    $query .= "WITH w MATCH (w)-[r:HAS_EXERCISE]->(e:Exercise) ";
    $query .= "RETURN e.exercise_id, e.name, e.picPath, e.alias, e.equipment, e.execModi, e.dimensions, e.difficulty";

    // Define the named parameters array
    $params = array("workout_id" => $workoutID);

    // Sending the Cypher query and retrieving the result set
    $resultSet = neo4j_commitQuery($query, $params);

    $returnArr = neo4j_mkObj_ePrev($resultSet);

    return $returnArr;
}

function neo4j_getWorkoutTags($workoutID){
    // Built the Cypher query with named parameters
    //// Find the workout by ID and return its tags
    $query = "MATCH (w:Workout {workout_id: {workout_id} }) ";
    $query .= "WITH w MATCH (w)-[r:HAS_TAG]->(t:Tag) ";
    $query .= "RETURN t.name";

    // Define the named parameters array
    $params = array("workout_id" => $workoutID);

    // Sending the Cypher query and retrieving the result set
    $resultSet = neo4j_commitQuery($query, $params);
    $resultArray = array();

    // Loop through every element of the resultSet
    for($i = 0; $i < count($resultSet); $i++){
        // Write the data in the row into the object
        $resultArray[$i] = $resultSet[$i]["t.name"];
    }
    return $resultArray;
}



//// EXERCISES
/////// Random $n exercises, optional with one or more tags
    function neo4j_getRandomExercises($skip, $n, $tagArray = NULL){
        // Built the Cypher query with named parameters
        //// Look at a random portion of all exercises, eventually with a certain tag
        // Add another WHERE clause, if some tags are included
        if($tagArray != NULL){
          // Transform all tags in the array to lower case
            $tagArray = array_map('strtolower', $tagArray);
            $query = "MATCH (e)-[:HAS_TAG]->(t:Tag) WHERE lower(t.name) IN {tags} ";
        } else {
            $query = "MATCH (e:Exercise) ";
        }
        $query .= "WITH e, rand() as rand ORDER BY rand LIMIT 1000 ";
        $query .= "RETURN e.name, e.exercise_id, e.duration, e.alias, e.picPath, e.shortDescr, e.execModi, e.dimensions, e.equipment, e.difficulty ";
        $query .= "SKIP {pagination} LIMIT {maximum}";

        // Define the named parameters array
        if($tagArray != NULL){
            $params = array("tags" => $tagArray, "pagination" => $skip, "maximum" => $n);
        } else {
            $params = array("pagination" => $skip, "maximum" => $n);
        }

        // Sending the Cypher query and retrieving the result set
        $resultSet = neo4j_commitQuery($query, $params);

        $returnArr = neo4j_mkObj_ePrev($resultSet);

        return $returnArr;
    }

/////// Return $n exercises similar to a given exercise ordered by uses in workouts
    function neo4j_getSimilarExercises($exerciseID, $n){
        // Built the Cypher query with named parameters
        //// Find exercises connected via :SIMILAR and corresponging workouts,
        //// return the exercise information and order by the number of workouts using the exercise
        $query = "MATCH (e1:Exercise {exercise_id: {exercise_id} })-[:SIMILAR]-(e:Exercise) ";
        $query .= "WITH e ";
        $query .= "MATCH (w:Workout)-[r:HAS_EXERCISE]->(e) ";
        $query .= "RETURN e.name, e.exercise_id, e.duration, e.alias, e.picPath, e.shortDescr, e.execModi, e.dimensions, e.equipment, e.difficulty, count(r) as useCases ";
        $query .= "ORDER BY useCases LIMIT {maximum}";

        // Define the named parameters array
        $params = array("exercise_id" => $exerciseID, "maximum" => $n);

        // Sending the Cypher query and retrieving the result set
        $resultSet = neo4j_commitQuery($query, $params);

        $returnArr = neo4j_mkObj_ePrev($resultSet);

        return $returnArr;
    }

/////// Search for an exercise and get $n results
    function neo4j_searchExercise($searchWord, $n, $skip){
        // Built regular expression for string
        $searchWordRegex = "(?i).*(".$searchWord.").*?";

        // Built the Cypher query with named parameters
        $query = "MATCH (e:Exercise) ";
        $query .= "WHERE e.name =~ {searchWordRegex} ";
        $query .= "RETURN e.name, ABS( LENGTH(e.name) - LENGTH({searchWord}) ) AS nameDiff, e.exercise_id, e.duration, e.alias, e.picPath, e.shortDescr, e.execModi, e.dimensions, e.equipment, e.difficulty ";
        $query .= "ORDER BY nameDiff, e.name ASC SKIP {skip} LIMIT {maximum} ";
        $query .= "UNION ";
        $query .= "MATCH (e:Exercise)-[r:HAS_TAG]->(t) ";
        $query .= "WHERE t.name =~ {searchWordRegex} ";
        $query .= "WITH e, count(r) AS tagMatches ORDER BY tagMatches DESC ";
        $query .= "RETURN e.name, ABS( LENGTH(e.name) - LENGTH({searchWord}) ) AS nameDiff, e.exercise_id, e.duration, e.alias, e.picPath, e.shortDescr, e.execModi, e.dimensions, e.equipment, e.difficulty ";
        $query .= "ORDER BY nameDiff, e.name ASC SKIP {skip} LIMIT {maximum}";

        // Define the named parameters array
        $params = array("searchWordRegex" => $searchWordRegex, "searchWord" => $searchWord, "maximum" => $n, "skip" => $skip);

        // Sending the Cypher query and retrieving the result set
        $resultSet = neo4j_commitQuery($query, $params);

        $returnArr = neo4j_mkObj_ePrev($resultSet);

        return $returnArr;
    }

//// USER
/////// Search users by name
    function neo4j_searchUserByName($searchWord, $n, $skip){
        // Built regular expression for string
        $searchWordRegex = "(?i).*(".$searchWord.").*?";

        // Built the Cypher query with named parameters
        $query = "MATCH (u:User) ";
        $query .= "WHERE u.name =~ {searchWordRegex} ";
        $query .= "RETURN u.name, u.user_id, u.confirmed, u.contact, u.visible, u.picPath, u.shortBio, u.gender ";
        $query .= "ORDER BY u.name ASC SKIP {skip} LIMIT {maximum} ";
        // Define the named parameters array
        $params = array("searchWordRegex" => $searchWordRegex, "maximum" => $n, "skip" => $skip);

        // Sending the Cypher query and retrieving the result set
        $resultSet = neo4j_commitQuery($query, $params);

        $returnArr = neo4j_mkObj_uProfile($resultSet);

        return $returnArr;
    }

/////// Get user followed by OR following a given user ordered by common likes, pagination by $skip
    function neo4j_getFollowers($userID, $skip, $n, $direction = ""){
        // Built the Cypher query with named parameters
        //// Differentiate, if people following the user should be matched or otherwise arounf
        if($direction == "followed_by_user"){
            // Create a matching clause for people followed by the user
            $query = "MATCH (u1:User {user_id: {user_id}} )-[:FOLLOWS]->(u:User) ";
        } else {
            $query = "MATCH (u1:User {user_id: {user_id}} )<-[:FOLLOWS]-(u:User) ";
        }
        $query .= "WITH u1, u ";
        $query .= "OPTIONAL MATCH (u1)-[:LIKED]->(w:Workout)<-[:LIKED]-(u) ";
        $query .= "RETURN u.name, u.user_id, u.confirmed, u.contact, u.visible, u.picPath, u.shortBio, u.gender, count(w) as commonLikes ";
        $query .= "ORDER BY commonLikes SKIP {pagination} LIMIT {maximum}";

        // Define the named parameters array
        $params = array("user_id" => $userID, "pagination" => $skip, "maximum" => $n);

        // Sending the Cypher query and retrieving the result set
        $resultSet = neo4j_commitQuery($query, $params);

        $returnArr = neo4j_mkObj_uProfile($resultSet);

        return $returnArr;
    }

////// Check if user followed another user
    function neo4j_userFollowedUser($userID, $followedUser){
        // Built the Cypher query with named parameters
        $query = "MATCH (u:User {user_id: {user_id} })-[:FOLLOWS]->(u2:User {user_id: {followed_id} }) ";
        $query .= "RETURN count(*) <> 0 AS count";

        // Define the named parameters array
        $params = array("user_id" => $userID, "followed_id" => $followedUser);

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params)[0]["count"];

        return $result;
    }

////// Check if user liked a certain workout
    function neo4j_userLikedWorkout($userID, $workoutID){
        // Built the Cypher query with named parameters
        $query = "MATCH (u:User {user_id: {user_id} })-[:LIKED]->(w:Workout {workout_id: {workout_id} }) ";
        $query .= "RETURN count(*) <> 0 AS count";

        // Define the named parameters array
        $params = array("user_id" => $userID, "workout_id" => $workoutID);

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params)[0]["count"];

        return $result;
    }

    function neo4j_getPWResetToken($userID){
        // Built the Cypher query with named parameters
        $query = "MATCH (u:User {user_id: {user_id} }) ";
        $query .= "RETURN u.pwResetToken";

        // Define the named parameters array
        $params = array("user_id" => $userID);

        // Sending the Cypher query and retrieving the result
        $result = neo4j_commitQuery($query, $params)[0]["u.pwResetToken"];

        return $result;
    }

// WRITING

//// TAG-RELATED
/////// Create a new tag if non-existant, else return matched tag
    function neo4j_createTag($tagNameInput){
        // Built the Cypher query with named parameters
        $query = "MERGE (t:Tag {name: {tagNameInput} }) ";
        $query .= "RETURN t.name";

        // Define the named parameters array
        $params = array("tagNameInput" => $tagNameInput);

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params);

        return $result;
    }

/////// Connect a workout with one or more tags (HAS_TAG)
    function neo4j_workoutHasTag($workoutID, $tagsArray){
        // First make sure the tags all exist or create new one if not
        foreach($tagsArray as $tag){
            $query = "MERGE (t:Tag {name: {tagname} })";
            $params = array("tagname" => $tag);
            // No return needed
            neo4j_commitQuery($query, $params);
        }

        // Built the Cypher query with named parameters
        $query = "MATCH (w:Workout) ";
        $query .= "WHERE w.workout_id = {workout_id} ";
        $query .= "WITH w MATCH (t:Tag) ";
        $query .= "WHERE t.name IN {tagsArray} ";
        $query .= "WITH w, t MERGE (w)-[:HAS_TAG]->(t)";

        // Define the named parameters array
        $params = array("workout_id" => $workoutID, "tagsArray" => $tagsArray);

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params);

        return $result;
    }

/////// Remove some or all connections to tags of a workout (remove HAS_TAG)
    function neo4j_removeWorkoutHasTag($workoutID, $tagArray = NULL){
        // Built the Cypher query with named parameters
        $query = "MATCH (w:Workout {workout_id: {workout_id} })-[r:HAS_TAG]->(t:Tag) ";

        // Differentiate whether only some or all tags should be removed
        // i.e. if there is an array with tag names to removed passed to the
        // function, don't remove all tags
        if($tagArray != NULL){
            // Transform all tags in the array to lower case
            $tagArray = array_map('strtolower', $tagArray);
            $query .= "WHERE lower(t.name) IN {tags} ";
        }
        // Finish preparing the query
        $query .= "DELETE r";

        // Define the named parameters array
        if($tagArray != NULL){
            $params = array("workout_id" => $workoutID, "tags" => $tagArray);
        } else {
            $params = array("workout_id" => $workoutID);
        }

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params);

        return $result;
    }

/////// Connect an exercise with one or more tag (HAS_TAG)
    function neo4j_exerciseHasTag($exerciseID, $tagsArray){
        // Built the Cypher query with named parameters
        $query = "MATCH (e:Exercise)";
        $query .= "WHERE e.exercise_id = {exercise_id} ";
        $query .= "WITH e MATCH (t:Tag) ";
        $query .= "WHERE t.name IN {tagsArray}";
        $query .= "WITH e, t MERGE (e)-[:HAS_TAG]->(t) ";

        // Define the named parameters array
        $params = array("exercise_id" => $exerciseID, "tagsArray" => $tagsArray);

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params);

        return $result;
    }

/////// Remove some or all connections to tags of an exercise (remove HAS_TAG)
    function neo4j_removeExerciseHasTag($exerciseID, $tagArray = NULL){
        // Built the Cypher query with named parameters
        $query = "MATCH (e:Exercise {exercise_id: {exercise_id} })-[r:HAS_TAG]->(t:Tag) ";

        // Differentiate whether only some or all tags should be removed
        // i.e. if there is an array with tag names to removed passed to the
        // function, don't remove all tags
        if($tagArray != NULL){
            // Transform all tags in the array to lower case
            $tagArray = array_map('strtolower', $tagArray);
            $query .= "WHERE lower(t.name) IN {tags} ";
        }
        // Finish preparing the query
        $query .= "DELETE r";

        // Define the named parameters array
        if($tagArray != NULL){
            $params = array("exercise_id" => $exerciseID, "tags" => $tagArray);
        } else {
            $params = array("exercise_id" => $exerciseID);
        }

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params);

        return $result;
    }

//// WORKOUT-RELATED
/////// Create a new workout and return the new object
/////// $neo4jdataObj expects an object
    function neo4j_createWorkout($userID, $workoutID, $neo4jdataObj){
        // Attach the workout id to the workout object as it's dynamically generated by MySQL
        $neo4jdataObj->workout_id = $workoutID;
        // Create a timestamp of current time
        $neo4jdataObj->created_on = time();

        // Built the Cypher query with named parameters
        //// Look, if workout_id already exists and create new node
        //// with all defined properties if not, also connecting it to its creator
        $query = "MATCH (u:User {user_id: {user_id} }) WITH u MERGE (w:Workout {workout_id: {workout_id} })<-[:CREATED { created_on: TIMESTAMP() } ]-(u) ";
        $query .= "ON CREATE SET w = {props}";

        // Define the named parameters array
        $params = array("user_id" => $userID, "workout_id" => $workoutID, "props" => $neo4jdataObj);

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params);

        return $result;
    }

/////// Connect a workout with one or more exercise (HAS_EXERCISE)
    function neo4j_workoutHasExercise($workoutID, $exerciseIdArray){
        // Built the Cypher query with named parameters
        $query = "MATCH (w:Workout {workout_id: {workout_id} }) ";
        $query .= "WITH w MATCH (e:Exercise) WHERE e.exercise_id IN {exercise_idArray} ";
        $query .= "WITH w, e ";
        $query .= "MERGE (w)-[:HAS_EXERCISE]->(e)";

        // Define the named parameters array
        $params = array("workout_id" => $workoutID, "exercise_idArray" => $exerciseIdArray);

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params);

        return $result;
    }

/////// Remove some or all connections to exercises of a workout (remove HAS_EXERCISE)
    function neo4j_removeWorkoutHasExercises($workoutID, $exerciseIdArray = NULL){
        // Built the Cypher query with named parameters
        $query = "MATCH (w:Workout {workout_id: {workout_id} })-[r:HAS_EXERCISE]->(e:Exercise) ";

        // Differentiate whether only some or all tags should be removed
        // i.e. if there is an array with tag names to removed passed to the
        // function, don't remove all tags
        if($exerciseIdArray != NULL){
            $query .= "WHERE e.exercise_id IN {exercise_ids} ";
        }
        // Finish preparing the query
        $query .= "DELETE r";

        // Define the named parameters array
        if($exerciseIdArray != NULL){
            $params = array("workout_id" => $workoutID, "exercise_ids" => $exerciseIdArray);
        } else {
            $params = array("workout_id" => $workoutID);
        }

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params);

        return $result;
    }


/////// Update an existing workout and return the updated object
    function neo4j_updateWorkout($neo4jdataObj){
        // Create a timestamp of current time
        $neo4jdataObj->updated_on = time();

        // Built the Cypher query with named parameters
        //// Find a workout by its ID, update defined properties and return all workout info
        $query = "MATCH (w:Workout {workout_id: {workout_id} }) ";
        $query .= "SET w += {props} ";
        $query .= "WITH w MATCH (w)<-[:CREATED]-(u:User) ";
        $query .= "RETURN w.name, w.workout_id, w.dimensions, w.duration, w.roundCount, w.exCount, w.picPath, u.name, u.user_id, u.picPath, u.shortBio ";

        // Define the named parameters array
        $params = array("workout_id" => $neo4jdataObj->workout_id, "props" => $neo4jdataObj);

        // Sending the Cypher query and retrieving the result set
        $resultSet = neo4j_commitQuery($query, $params);

        $returnArr = neo4j_mkObj_wPrev($resultSet);

        return $returnArr;
    }

/////// Delete workout
    function neo4j_removeWorkout($workoutID){
        // Built the Cypher query with named parameters
        // Find the workout by ID, remove all relationships and then the workout
        $query = "MATCH (w:Workout {workout_id: {workout_id} })-[r]-() ";
        $query .= "DELETE r, w";

        // Define the named parameters array
        $params = array("workout_id" => $workoutID);

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params);

        return $result;
    }


/////// Like/ dislike workout
    function neo4j_likeDislikeWorkout($userID, $workoutID){
        // Built the Cypher query with named parameters
        //// Find both user and workout by ID, check if there is a LIKED relationship,
        //// create one if not, delete if it exists
        $query = "MATCH (u:User {user_id: {user_id} }), (w:Workout {workout_id: {workout_id} }) ";
        $query .= "WITH u, w CREATE (u)-[:LIKED { created_on: TIMESTAMP() } ]->(w) ";
        $query .= "WITH u, w MATCH (u)-[r:LIKED]->(w), (u)-[:LIKED]->(w) ";
        $query .= "DELETE r WITH u, w MATCH (u)-[:LIKED]->(w) ";
        $query .= "RETURN count(*) = 0 AS count";

        // Define the named parameters array
        $params = array("user_id" => $userID, "workout_id" => $workoutID);

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params)[0]["count"];

        return $result;
    }

//// USER-RELATED
/////// Create a new user if non-existant
    function neo4j_createUser($neo4jdataObj){
        // Create a timestamp of current time
        $neo4jdataObj->created_on = time();
        // Extract the preferences from the object and detach the members as they can't be stored in Neo4j properly
        $preferences = array_merge($neo4jdataObj->preferences["motives"], $neo4jdataObj->preferences["dimensions"]);
        $neo4jdataObj->trainingFrequeny = $neo4jdataObj->preferences["frequency"];
        $neo4jdataObj->preferredDifficulty = $neo4jdataObj->preferences["difficulty"];
        unset($neo4jdataObj->preferences);
        // Built the Cypher query with named parameters
        //// Look for an existing user by email and create a new one with given properties if not
        $query = "MERGE (u:User {email: {email}}) ";
        $query .= "ON CREATE SET u = {props} ";
        $query .= "WITH u MATCH (p) WHERE p.name IN {preferences} WITH u, p  MERGE (u)-[:PREFERS]->(p) ";
        $query .= "RETURN u.name, u.user_id";
        // Define the named parameters array
        $params = array("email" => $neo4jdataObj->email, "props" => $neo4jdataObj, "preferences" => $preferences);
        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params);

        return $result;
    }

/////// Check user database for unconfirmed users older than three days and get their info
    function neo4j_get3doUser(){
        // Get the timestamp equivalent for three days ago
        $timeEdge = time() - 3 * 24 * 60 * 60;
        // Search for users
        $query = "MATCH (u:User) WHERE u.confirmed = false AND u.rememberStatus IS NULL AND u.created_on < {timeEdge} ";
        $query .= "RETURN u.name AS name, u.user_id AS user_id, u.email AS email, u.locale AS locale, u.confirmationCode AS confirmationCode";

        $params = array("timeEdge" => $timeEdge);

        $result = neo4j_commitQuery($query, $params);
        // Return users
        return $result;
    }

    function neo4j_markRememberedUser($userID, $rememberStatus){
        // Mark given users that they have been remembered
        $query = "MATCH (u:User {u.user_id = {userID} }) ";
        $query .= "SET u.rememberStatus = {rememberStatus} ";
        $query .= "RETURN count(*) = 1 AS count ";
        // Define the named parameters array
        $params = array("userID" => $userID, "rememberStatus" => $rememberStatus);
        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params)[0]["count"];

        return $result;
    }

/////// User confirmed email address so remove confirmed = false flag and the confirmation code
    function neo4j_confirmUserMail($confirmationCode){
        // Built the Cypher query with named parameters
        //// Check whether the user is already confirmed and do so otherwise
        $query = "MATCH (u:User {confirmationCode: {code}}) ";
        $query .= "SET u.confirmed = true, u.confirmed_on = TIMESTAMP() ";
        $query .= "REMOVE u.confirmationCode ";
        $query .= "RETURN count(*) = 1 AS count, u.name AS name, u.email AS email, u.locale AS locale ";

        // Define the named parameters array
        $params = array("code" => $confirmationCode);

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params)[0];

        return $result;
    }

/////// Connect one user with another one (FOLLOWS)
    function neo4j_followUnfollow($userID_1, $userID_2){
        // Built the Cypher query with named parameters
        $query = "MATCH (u1:User {user_id: {user_id_1} }), (u2:User {user_id: {user_id_2} }) ";
        $query .= "WITH u1, u2 CREATE (u1)-[:FOLLOWS { created_on: TIMESTAMP() } ]->(u2) ";
        $query .= "WITH u1, u2 MATCH (u1)-[r:FOLLOWS]->(u2), (u1)-[:FOLLOWS]->(u2) ";
        $query .= "DELETE r WITH u1, u2 MATCH (u1)-[:FOLLOWS]->(u2) ";
        $query .= "RETURN count(*) = 0 AS count";

        // Define the named parameters array
        $params = array("user_id_1" => $userID_1, "user_id_2" => $userID_2);

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params)[0]["count"];

        return $result;
    }

/////// Update existing user, returning the updated profile info
    function neo4j_updateUserProfile($neo4jdataObj){
        // Create a timestamp of current time
        $neo4jdataObj->updated_on = time();
        // Extract the preferences from the object and detach the members as they can't be stored in Neo4j properly
        $preferences = array_merge($neo4jdataObj->preferences["motives"], $neo4jdataObj->preferences["dimensions"]);
        $neo4jdataObj->trainingFrequency = $neo4jdataObj->preferences["frequency"];
        $neo4jdataObj->preferredDifficulty = $neo4jdataObj->preferences["difficulty"];
        unset($neo4jdataObj->preferences);
        // Built the Cypher query with named parameters
        //// Find user by ID and update a given set of properties.
        //// Return the whole (updated) profile afterwards
        $query = "MATCH (u:User {user_id: {user_id} }) ";
        $query .= "OPTIONAL MATCH (u)-[r:PREFERS]->() ";
        $query .= "DELETE r ";
        $query .= "SET u += {props} ";
        $query .= "WITH u OPTIONAL MATCH (p) WHERE p.name IN {preferences} WITH u, p MERGE (u)-[:PREFERS]->(p) ";
        $query .= "WITH u OPTIONAL MATCH (d:Dimension)<-[:PREFERS]-(u)-[:PREFERS]->(m:Motive) ";
        $query .= "RETURN u.name, u.user_id, u.email, u.contact, u.visible, u.shortBio, u.locale, u.picPath,
                    u.gender, u.preferredDifficulty, u.trainingFrequency, COLLECT(DISTINCT m.name) AS motives, COLLECT(DISTINCT d.name) AS preferredDimensions ";

        // Define the named parameters array
        $params = array("user_id" => $neo4jdataObj->user_id, "props" => $neo4jdataObj, "preferences" => $preferences);
        // Sending the Cypher query and retrieving the result set
        $resultSet = neo4j_commitQuery($query, $params);
        $returnArr = neo4j_mkObj_uProfileFull($resultSet);

        return $returnArr;
    }

/////// Attach the password reset token to the given user
    function neo4j_setPWResetToken($userID, $token){
        // Built the Cypher query with named parameters
        $query = "MATCH (u:User {user_id: {user_id} }) ";
        $query .= "SET u.pwResetToken = {token} ";
        $query .= "RETURN count(*) <> 0 AS success";

        // Define the named parameters array
        $params = array("user_id" => $userID, "token" => $token);

        // Sending the Cypher query and retrieving the result
        $result = neo4j_commitQuery($query, $params)[0]["success"];

        return $result;
    }

/////// Overwrite given users password hash - NO FURTHER TESTS ARE MADE, SO CHECK FIRST!
    function neo4j_setUserPassword($userID, $newPasswordHash){
        // Built the Cypher query with named parameters
        $query = "MATCH (u:User {user_id: {user_id} }) ";
        $query .= "SET u.password = {newPassword} ";
        $query .= "REMOVE u.pwResetToken ";
        $query .= "RETURN count(*) <> 0 AS success";

        // Define the named parameters array
        $params = array("user_id" => $userID, "newPassword" => $newPasswordHash);

        // Sending the Cypher query and retrieving the result
        $result = neo4j_commitQuery($query, $params)[0]["success"];

        return $result;
    }

/////// Delete a user and replace his LIKED and CREATED connections
/////// with the UserDummy USER INDEX 0 (to keep analytics and relations intact)
    function neo4j_removeUser($userID){
        // Built the Cypher query with named parameters
        //// Match a user by ID and check out all his/her connections to workouts and other users.
        //// The connections to the recieved workouts are copied to a dummy user (so numbers
        //// remain the same) and the connections of the user as well as the user him/herself
        //// are deleted.
        $query = "MATCH (u1:User {user_id: {user_id} })";
        $query .= "WITH u1 ";
        $query .= "MATCH (w:Workout)<-[r1:CREATED|:LIKED]-(u1)-[r2:FOLLOWS]-(u2:User) ";
        $query .= "WITH w, r1, u1, u2 ";
        $query .= "MERGE (w)<-[rNew]-(u3:User {user_id: 0 }) ";
        $query .= "SET rNew = r1 ";
        $query .= "WITH w, r1, u1, u2 ";
        $query .= "DETACH DELETE u1";

        // Define the named parameters array
        $params = array("user_id" => $userID);

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params);

        return $result;
    }

//// EXERCISE-RELATED
//// Although not included in the current frontend, these functions
//// may be used to manage the exercises

/////// Create a new exercise
    function neo4j_createExercise($exerciseID, $neo4jdataObj){
        // Attach the exercise id to the exercise object as it's dynamically generated by MySQL
        $neo4jdataObj->exercise_id = $exerciseID;

        // Built the Cypher query with named parameters
        //// Look, if exercise_id already exists and create new node
        //// with all defined properties if not.
        $query = "MERGE (e:Exercise {exercise_id: {exercise_id} }) ";
        $query .= "ON CREATE SET e = {props}";

        // Define the named parameters array
        $params = array("exercise_id" => $neo4jdataObj->exercise_id, "props" => $neo4jdataObj);

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params);

        return $result;
    }

/////// Connect an exercise with one or more others (SIMILAR)
    function neo4j_exerciseSimilar($exerciseID, $similarExercisesIdArray){
        // Built the Cypher query with named parameters
        $query = "MATCH (e1:Exercise), (e2:Exercise) ";
        $query .= "WHERE e1.exercise_id = {exercise_id} AND e2.exercise_id IN {exerciseIdArray}";
        $query .= "WITH e1, e2 ";
        $query .= "MERGE (e1)-[:HAS_TAG]->(e2)";

        // Define the named parameters array
        $params = array("exercise_id" => $exerciseID, "exerciseIdArray" => $similarExercisesIdArray);

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params);

        return $result;
    }

/////// Remove some or all connections to other exercises of an exercise (remove SIMILAR)
    function neo4j_removeExerciseSimilar($exerciseID, $similarExercisesIdArray = NULL){
        // Built the Cypher query with named parameters
        $query = "MATCH (e1:Exercise {exercise_id: {exercise_id} })-[r:HAS_TAG]->(e2:Exercise) ";

        // Differentiate whether only some or all tags should be removed
        // i.e. if there is an array with tag names to removed passed to the
        // function, don't remove all tags
        if($similarExercisesIdArray != NULL){
            $query .= "WHERE e2.exercise_id IN {exerciseIdArray} ";
        }
        // Finish preparing the query
        $query .= "DELETE r";

        // Define the named parameters array
        if($similarExercisesIdArray != NULL){
            $params = array("exercise_id" => $exerciseID, "exerciseIdArray" => $similarExercisesIdArray);
        } else {
            $params = array("exercise_id" => $exerciseID);
        }

        // Sending the Cypher query and retrieving the result set
        $result = neo4j_commitQuery($query, $params);

        return $result;
    }

/////// Update an existing exercise
    function neo4j_updateExercise($neo4jdataObj){
        // Built the Cypher query with named parameters
        //// Find a exercises by its ID, update defined properties and return all workout info
        $query = "MATCH (e:Exercise {exercise_id: {exercise_id} }) ";
        $query .= "SET e += {props} ";
        $query .= "RETURN e.name, e.exercise_id, e.duration, e.alias, e.picPath, e.shortDescr, e.execModi, e.dimensions, e.equipment, e.difficulty";

        // Define the named parameters array
        $params = array("exercise_id" => $neo4jdataObj->exercise_id, "props" => $neo4jdataObj);

        // Sending the Cypher query and retrieving the result set
        $resultSet = neo4j_commitQuery($query, $params);

        $returnArr = neo4j_mkObj_ePrev($resultSet);

        return $returnArr;
    }


// METRICS SECTION ////////////////////////////////////////////////////////////////////////////

//// Return the basic kpis like users (activated, total), workouts, workouts per user, likes per user, workout with max likes, most active creator
function neo4j_basicMetrics(){
    // Prepare the batch query
    $query = "MATCH (u0:User {confirmed: true}) WITH count(u0) AS activeUsers ";
    $query .= "MATCH (u1:User) WITH activeUsers, count(u1) AS totalUsers ";
    $query .= "MATCH (w0:Workout) WITH activeUsers, totalUsers, count(w0) AS totalWorkouts ";
    $query .= "MATCH (u2:User)-[r0:LIKED]->() WITH activeUsers, totalUsers, totalWorkouts, count(r0) AS totalLikes ";
    $query .= "MATCH (u3:User)-[r1:CREATED]->() WITH activeUsers, totalUsers, totalWorkouts, totalLikes, u3.name AS mostActiveCname, u3.email AS mostActiveCemail, count(r1) AS mostActiveCworkouts ORDER BY mostActiveCworkouts DESC LIMIT 1 ";
    $query .= "MATCH (u4:User)-[:CREATED]->(w1:Workout)<-[r2:LIKED]-() RETURN activeUsers, totalUsers, totalWorkouts, totalLikes, mostActiveCname, mostActiveCemail, mostActiveCworkouts, w1.name AS mostLikedWname, u4.name AS mostLikedWcname, u4.email AS mostLikedWcemail, count(r2) AS mostLikedWLikes ORDER BY mostLikedWLikes DESC LIMIT 1 ";
    $resultSet = neo4j_commitQuery($query);
    // Create the return array
    $metrics = [
        "users" => [
            "total" => $resultSet[0]["totalUsers"],
            "confirmed" => $resultSet[0]["activeUsers"]
        ],
        "workouts" => [
            "total" => $resultSet[0]["totalWorkouts"]
        ],
        "likes" => [
            "total" => $resultSet[0]["totalLikes"]
        ],
        "leaders" => [
            "mostActiveCreator" => [
                "name" => $resultSet[0]["mostActiveCname"],
                "email" => $resultSet[0]["mostActiveCemail"],
                "workouts" => $resultSet[0]["mostActiveCworkouts"]
            ],
            "mostLikedWorkout" => [
                "name" => $resultSet[0]["mostLikedWname"],
                "creatorName" => $resultSet[0]["mostLikedWcname"],
                "creatorEmail" => $resultSet[0]["mostLikedWcemail"],
                "likes" => $resultSet[0]["mostLikedWLikes"]
            ]
        ]
    ];
    // Return the metrics
    return $metrics;
}
// Return the user registration data (date, aggregated number)
function neo4j_registrationData(){
    // Prepare the query
    $query = "MATCH (u:User) RETURN u.created_on AS date, count(u) AS cnt";
    // Get the results
    $resultSet = neo4j_commitQuery($query);
    // Sort the result set
    for($i = 0; $i < count($resultSet); $i++){
        $result[$i]["date"] = $resultSet[$i]["date"];
        $result[$i]["cnt"] = $resultSet[$i]["cnt"];
    }
    usort($result, function($a, $b) {
        return $a["date"] - $b["date"];
    });
    // Prepare the data array
    $data = [];
    $index = 0;
    for($i = 0; $i < count($result); $i++){
        $inArray = false;
        // Concenate same dates
        for($j = 0; $j < count($data); $j++){
            if($data[$j]["date"] == date("Ymd", $result[$i]["date"])){
                $inArray = true;
                $data[$j]["count"] += $result[$i]["cnt"];
                break;
            }
        }
        if(!$inArray){
            $data[$index]["date"] = date("Ymd", $result[$i]["date"]);
            $data[$index]["count"] = $result[$i]["cnt"];
            $index++;
        }
    }
    // Calculate aggregated count
    for($i = 1; $i < count($data); $i++){
        $data[$i]["count"] += $data[$i-1]["count"];
    }

    return $data;
}

?>
