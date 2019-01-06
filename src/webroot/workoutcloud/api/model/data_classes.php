<?php

// CLASSES FOR THE DATA MODEL

// HIGH-LEVEL CLASSES (focused on actual data in the application)

//// WORKOUTS
/////// Preview data (populated by Neo4j)
    class data_workoutPreview {
        public $name = "Workout Name";
        public $workout_id = 0;
        public $dimensions = "";
        public $duration = 0;
        public $difficulty = 3;
        public $exCount = 1;
        public $roundCount = 1;
        public $picPath = "default.png";
        // Creator related data
        public $creator_name = "A Sidefit";
        public $creator_id;
        public $creator_picPath = ""; 
        public $creator_shortBio = "";    
    }

/////// Full data (preview combined with MySQL data)
    class data_workoutFull extends data_workoutPreview { 
        public $annotations = "";
        public $exerciseMap = [];
        public $pdfPath = ""; 
        public $exerciseDescriptions = [];
        public $tags = [];       
    }

//// EXERCISES
/////// Preview data (poulated by Neo4j)
    class data_exercisePreview {
        public $name = "Exercise Name";
        public $exercise_id = 0;
        public $alias = [];
        public $picPath = ["default"];
        public $shortDescr = "";
        public $dimensions = [];
        public $duration = 1;
        public $execModi = ["reps", "time", "distance"];
        public $equipment = false;
        public $difficulty = 1;
    }

////// Full data (preview combined with MySQL data)
    class data_exerciseFull extends data_exercisePreview {
        public $fullDescr = "";
    }    

//// USER

/////// Public profile (in Neo4j)
    class data_userProfile {
        public $name = "A Sidefits";
        public $user_id;
        public $picPath = "default.jpg";
        public $contact = "";
        public $visible = false;
        public $shortBio = ""; 
        public $locale = "en_EN"; 
        public $gender = "male";
        public $confirmed;  
    }
    
////// Full data profile
    class data_userProfileFull extends data_userProfile {
        public $password = "";
        public $email = "";
        public $fbid = "";
        public $preferences = [
                    "difficulty" => [2.0, 4.0],
                    "dimensions" => [],
                    "motives" => ["Healthy"],
                    "frequency" => 3
                    ];
    } 
    
    
// LOW LEVEL CLASSES (focused on data in databases)
//// Only workouts and exercises need these classes as they store data 
//// in both databases

//// Neo4j
///////// Data of nodes labeled with Workout
    class data_neo4j_workoutProps{
        public $name = "Workout Name";
        public $dimensions = [];
        public $duration = 0;
        public $roundCount = 1;
        public $exCount = 0;
        public $picPath = "default.png";   
    }
    
///////// Data of nodes labeled with Exercise has the same elements 
///////// as defined in the data_exercisePreview class
    

//// MySQL
//////// Data of columns in sfwb_workouts
    class data_mysql_workoutData{
        public $annotations = "";
        public $exerciseMap = "";
        public $pdfPath = "";
        public $exerciseDescriptions = "";    
    }   
    
//////// Data of columns in sfwb_exercises
    class data_mysql_exerciseData{
        public $fullDescr = "";    
    }
    

    
    

?>