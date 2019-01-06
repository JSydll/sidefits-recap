// CREATOR
angular.module('workoutBox').controller('workoutCreatorCtrl',['$scope', '$state', '$stateParams', '$rootScope', '$auth', 'exerciseFact', 'tagFact', 'workoutFact', 'dataFact', '$timeout', '$translate', 'toastr', function($scope, $state, $stateParams, $rootScope, $auth, exerciseFact, tagFact, workoutFact, dataFact, $timeout, $translate, toastr) {
    // Check if creator is in edit mode
    $scope.isEdit = $rootScope.isEdit;  
    // Check if there had been passed an optional strucure parameter                                                         TO DO
    // $scope.structure = $stateParams.strcuture;
    // DEFAULT VALUES
    // If true, get the workout data into the model
    if($scope.isEdit && (typeof($rootScope.workout) !== 'undefined')){
        $scope.name = $rootScope.workout.name;
        $scope.workout_id = $rootScope.workout.workout_id;
        $scope.estTime = $rootScope.workout.estTime;
        $scope.roundCount = $rootScope.workout.roundCount;
        $scope.exCount = $rootScope.workout.exCount;
        $scope.dimensions = $rootScope.workout.dimensions;
        $scope.estDifficulty = $rootScope.workout.difficulty;
        $scope.exerciseList = $rootScope.workout.planData;
        $scope.description = $rootScope.workout.annotations;
        $scope.picPath = $rootScope.workout.picPath;  
        // Get the selected tags and some more sample tags
        $scope.tagCloudList = [];
        for(var i = 0; i < $rootScope.workout.tags.length; i++){
            $scope.tagCloudList.push({
                tagname: $rootScope.workout.tags[i],
                selected: true
            });    
        }
        tagFact.sample().then(function(response){
            var sampleTags = response.data;
            // Loop through new elements and add them to the cloud
            for(var i = 0; i < sampleTags.length; i++){
                if($rootScope.workout.tags.indexOf(sampleTags[i]) === -1){
                    $scope.tagCloudList.push({
                        tagname: sampleTags[i],
                        selected: false
                    });    
                }    
            }
        });            
    } else {
        // Get a random name as preset for the workout name
        workoutFact.randomName().then(function(response){
            $scope.name = "The" + response.data.replace(/"/g, " ") + "Workout";
        });
        // Get some translation data
        $scope.translations = {};
        $translate("ROUND").then(function(translation){
            $scope.translations = { round: translation }; 
            $scope.estTime = 0;
            $scope.roundCount = 1;
            $scope.exCount = 0;
            $scope.dimensions = [0, 0, 0, 0];
            $scope.estDifficulty = 3;
            // There is one round inserted by default
            $scope.exerciseList = [{
              id: 1,
              title: $scope.translations.round,
              exercises: [],
              count: 1,
              duration: 0
            }];
            $scope.description = "";
            $scope.picPath = "";
            $scope.tagCloudList = [];   
        });
        
    }
    
    // Info pane data
    $scope.Math = window.Math;

    // Plan data
    // Array to store the exercise_id, each round duration, total duration, difficulty and dimensions
    $scope.uniqueExercises = [];

    // Refresh the workout real time data
    $scope.refreshData = function(){
        var workoutPlan = $scope.exerciseList;
        // Reset the unique exercises to prevent building up a stack on repeating changes in data model
        $scope.uniqueExercises = [];  
        var uniqueExercises = $scope.uniqueExercises;        
        // Variables for round and total duration as well as the round count
        var workoutDuration = 0; 
        var totalRoundCount = 0;            
        // Calculate each rounds duration and for the whole workout
        for(var i = 0; i < workoutPlan.length; i++){                                                                                   
            var roundDuration = 0;
            var currRound = workoutPlan[i];
            // Get the sum of durations of each exercise
            for(var j = 0; j < currRound.exercises.length; j++){                                                                  
                var currExercise = currRound.exercises[j];
                var currExerciseDuration = 0;
                // Determine, which execution modus is selected and calculate durations
                if(currExercise.modus == "time"){
                    // For time, simply add that time to duration
                    currExerciseDuration = currExercise.count;
                    roundDuration = roundDuration + currExerciseDuration;
                } else {
                    // For reps selected multiply reps with time per rep // Distance is interpolated the same way
                    currExerciseDuration = currExercise.count * currExercise.duration;
                    roundDuration = roundDuration + currExerciseDuration;
                }                                                                                                                      
                // Check if exercise is already in unique exercise array and store to this array, if not
                if(currExercise.title != "Pause"){
                    // Loop through the unique exercise array and test for duplicates
                    var isUnique = true;
                    var uniqueIndex = 0;
                    for(var k = 0; k < uniqueExercises.length; k++) {
                       if(uniqueExercises[k].exercise_id == currExercise.exercise_id) {
                         isUnique = false;
                         uniqueIndex = k;
                         break;
                       }
                    }
                    // If exercise is new to workout, push it's calculation relevant data
                    // If not, add up the current duration to the whole duration
                    if(isUnique){
                        uniqueExercises.push({
                            exercise_id: currExercise.exercise_id,
                            setDurations: [ currExerciseDuration ],
                            totalDuration: currExerciseDuration,
                            difficulty: currExercise.difficulty,
                            dimensions: currExercise.dimensions
                        });
                    } else {
                        // Add a new "per set" value to the durations array and recalculate the total duration
                        uniqueExercises[uniqueIndex].setDurations.push(currExerciseDuration);
                        var newTotalDuration = 0;
                        uniqueExercises[uniqueIndex].setDurations.forEach(function(dur){
                            newTotalDuration += dur;
                        });
                        // Store the total Duration in the uniqueExercises array
                        uniqueExercises[uniqueIndex].totalDuration = newTotalDuration;
                    }
                }                                                                                                                      
            }                                                                                                                         
            // FOR EXERCISE DURATION
            currRound.duration = roundDuration;
            workoutDuration = workoutDuration + ( roundDuration * currRound.count );
            // FOR ROUND COUNT
            totalRoundCount += currRound.count;
        } 
        // Add 30 sec switch time per 5 min of workout
        workoutDuration = workoutDuration + Math.floor(workoutDuration / (5 * 60)) * 30;                                                                                                                        
        $scope.estTime = workoutDuration;
        $scope.roundCount = totalRoundCount;
        $scope.exCount = uniqueExercises.length;               
        
        // FOR WORKOUT DIMENSIONS
        if(uniqueExercises.length){
            var netTotalTime = 0;
            var unweightedDifficulty = 0;
            var totalDimTime = 0;
            var timePerDimension = [0, 0, 0, 0];
            var timeSharePerDimension = [0, 0, 0, 0];
            // Calculate overall workout difficulty and using the same loop
            // The time per dimension and the total dimension time // Dimensions [FLEX, MSTRENGTH, MENDUR, CARDIO] !!!
            for(var i = 0; i < uniqueExercises.length; i++){
                // Building the sums for difficulty calculation
                netTotalTime = netTotalTime + uniqueExercises[i].totalDuration;
                unweightedDifficulty = unweightedDifficulty + uniqueExercises[i].difficulty * uniqueExercises[i].totalDuration;
                // Building the sums for time share per dimension calculation
                if(uniqueExercises[i].dimensions[0]){// Exercises pays to flexibility dimension
                    timePerDimension[0] = timePerDimension[0] + uniqueExercises[i].totalDuration;
                }
                if(uniqueExercises[i].dimensions[1]){// Exercises pays to M.strength dimension
                    timePerDimension[1] = timePerDimension[1] + uniqueExercises[i].totalDuration;
                }
                if(uniqueExercises[i].dimensions[2]){// Exercises pays to M.endurance dimension
                    timePerDimension[2] = timePerDimension[2] + uniqueExercises[i].totalDuration;
                }
                if(uniqueExercises[i].dimensions[3]){// Exercises pays to cardio dimension
                    timePerDimension[3] = timePerDimension[3] + uniqueExercises[i].totalDuration;
                }
            }
            totalDimTime = timePerDimension[0] + timePerDimension[1] + timePerDimension[2] + timePerDimension[3];
            // Calculate the time share per dimension
            if(totalDimTime !== 0){
                timeSharePerDimension[0] = timePerDimension[0] / totalDimTime;
                timeSharePerDimension[1] = timePerDimension[1] / totalDimTime;
                timeSharePerDimension[2] = timePerDimension[2] / totalDimTime;
                timeSharePerDimension[3] = timePerDimension[3] / totalDimTime;    
            }
            // CALCULATE OVERALL DIFFICULTY TO ONE DIGIT and store the results
            $scope.estDifficulty = Math.round(unweightedDifficulty / netTotalTime * 10) / 10;
            $scope.dimensions = timeSharePerDimension;  
        }               
    };

    // Watch out for changes in exerciseList so real time data can be refreshed
    $scope.$watch('exerciseList', function(){
        $scope.refreshData();               
    }, true); 

    // Search for an exercise
    // Infinite loading globals
    $scope.exerciseSearchLimit = 5;
    $scope.exerciseSearchCurrent = 0;
    $scope.exerciseSearchEnabled = true;
    
    $scope.exerciseSearch = function(scope, more){
        if(scope.searchkey != ""){
            if(more){
                $scope.exerciseSearchCurrent += $scope.exerciseSearchLimit;    
            } else {
                $scope.exerciseSearchCurrent = 0;
            }
            exerciseFact.search(scope.searchkey, $scope.exerciseSearchLimit, $scope.exerciseSearchCurrent).then(function(response){
                var foundResults = response.data;
                if(foundResults.length == 0){
                    $scope.exerciseSearchEnabled = false;
                } else {
                    if(more){
                        // If there are additional elements received, push them to a collection of all
                        var newResults = scope.searchresults;
                        for(var i = 0; i < foundResults.length; i++){
                            newResults.push( foundResults[i] );    
                        }                      
                        scope.searchresults = newResults;       
                    } else {
                        scope.searchresults = foundResults;     
                    }                   
                }                
            });
            scope.randomexercises = "";
        } else {
            scope.searchresults = "";
            $scope.exerciseSearchCurrent = 0;
        }
    };

    // Get a random exercise
    $scope.randomExercise = function(scope){
        exerciseFact.random().then(function(response){
            scope.randomexercises = response.data;
        });

        scope.searchkey = "";
        scope.searchresults = "";
    }

        // Limitation of dropping elements according to their current level
    // (A round can just changed in order with other rounds, same for exercises,
    // which might be dropped in another round though)
    $scope.workoutPlan = {
        accept: function(sourceNodeScope, destNodesScope, destIndex) {
            var sourceClass = sourceNodeScope.$element.attr('class').split(' ')[0];
            var destClass = destNodesScope.$element.attr('class').split(' ')[0];
            var acceptable = false;

            if(sourceClass == destClass){
                acceptable = true;
            }
            return acceptable;
        }
    };

    $scope.remove = function(scope) {
      scope.remove();
    };

    $scope.toggle = function(scope) {
      scope.toggle();
    };

    // Toggle the visibility of the data entry pane for new exercise
    $scope.newExerciseData = false;
    $scope.newExerciseToggle = function(scope){
        if(scope.newExerciseData == false){
            scope.newExerciseData = true;
        } else {
            scope.newExerciseData = false;
        }
        scope.searchkey = "";
        scope.searchresults = "";
        scope.randomexercises = "";
    }

    // Creates a new exercise in the current round
    $scope.newExerciseCreate = function(scope, resultData) {
        var nodeData = scope.$modelValue;

        nodeData.exercises.push({
            id: nodeData.id * 1000 + nodeData.exercises.length + 1,
            title: resultData.name,
            exercise_id: resultData.exercise_id,
            picPath: resultData.picPath,
            exercises: [],
            count: 10,
            modus: resultData.execModi[0],
            execModi: resultData.execModi,
            duration: resultData.duration,
            dimensions: resultData.dimensions,
            shortDescr: resultData.shortDescr,
            equipment: resultData.equipment,
            difficulty: resultData.difficulty,
            status: {
                open: true
            }
        });
        // Reset the search
        $scope.newExerciseToggle(scope.$parent.$parent.$parent);  
    };

    // Creates a pause
    $scope.addPause = function(scope) {
        var nodeData = scope.$modelValue;

        nodeData.exercises.push({
            id: nodeData.id * 10 + nodeData.exercises.length + 1,
            title: "Pause",
            exercises: [],
            count: 30,
            modus: "time",
            execModi: ["time"],
            duration: 30 // Default pause is 30 sec
        });     
    }
    
    $scope.replacableScope = {};
    $scope.replacableModel = {};
    // Set/ unset a certain exercise to be replaced
    $scope.setReplacable = function(scope){
        if($scope.replacableScope != scope){
            $scope.replacableScope = scope;
            $scope.replacableModel = scope.$modelValue;
        } else {
            $scope.replacableScope = {};
            $scope.replacableModel = {};
        }
        $scope.newExerciseToggle(scope.$parent.$parent);        
    };
    
    // Replace given exercise
    $scope.replaceExercise = function(newScope){
        if($scope.replacableModel.id !== 'undefined'){
            // Replace old items data (except the model id)
            $scope.replacableModel.title = newScope.name;
            $scope.replacableModel.exercise_id = newScope.exercise_id;
            $scope.replacableModel.picPath = newScope.picPath;
            $scope.replacableModel.execModi = newScope.execModi;
            $scope.replacableModel.duration = newScope.duration;
            $scope.replacableModel.dimensions = newScope.dimensions;
            $scope.replacableModel.shortDescr = newScope.shortDescr;
            $scope.replacableModel.equipment = newScope.equipment;
            $scope.replacableModel.difficulty = newScope.difficulty;
    
            // If the old items modus is not supported by new item set default values
            if(newScope.execModi.indexOf($scope.replacableModel.modus) == -1){
                $scope.replacableModel.count = 10;
                $scope.replacableModel.modus = newScope.execModi[0];
            } // else simply the old items values will remain  
            $scope.replacableScope = {};
            $scope.replacableModel = {};
            
            $scope.newExerciseToggle(scope.$parent.$parent); 
        } else {
            $translate("ERROR_REPLACE_EXERCISE").then(function(translation){
                toastr.error(translation);
            });
        }                                                     
            
    };

    // Duplicates the current element
    $scope.duplicate = function(scope){
        var nodeData = scope.$modelValue;
        var planData = scope.exerciseList;

        // Loop through the data model and find out, where the duplicated
        // element is located (top or second data level)
        var toplevel = true;
        // If an exercise is duplicated, the corresponding round element in
        // the data set needs to be stored
        var roundIdentifier = 0; // default first round
        for(var i = 0; i < planData.length; i++){
            for(var j = 0; j < planData[i].exercises.length; j++){
                // If the element is found on second data level, its an exercise
                // so simply push it at the same array
                if(planData[i].exercises[j].id == nodeData.id){
                    toplevel = false;
                    roundIdentifier = i;
                    break;
                }
            }
        }

        // Now inject a new element at the top level or inside the selected round
        if(toplevel){
            // Create an array of the contained exercises and assign new id
            var exercisesArray = [];

            for(var i = 0; i < nodeData.exercises.length; i++){
                exercisesArray.push({
                    id: (planData.length + 1) * 1000 + exercisesArray.length + 1,
                    title: nodeData.exercises[i].title,
                    exercise_id: nodeData.exercises[i].exercise_id,
                    picPath: nodeData.exercises[i].picPath,
                    exercises: [],
                    count: nodeData.exercises[i].count,
                    modus: nodeData.exercises[i].modus,
                    exclude: nodeData.exercises[i].exclude,
                    shortDescr: nodeData.exercises[i].shortDescr,
                    duration: nodeData.exercises[i].duration,
                    equipment: nodeData.exercises[i].equipment,
                    difficulty: nodeData.exercises[i].difficulty
                });
            }
            // Push the copied item with the new array to the plan
            planData.push({
                id: planData.length + 1,
                title: nodeData.title,
                exercises: exercisesArray,
                count: 1,
                duration: nodeData.duration
            });
            
            $translate("ROUND_DUPLICATED").then(function(translation){
                toastr.success(translation);
            });        
        } else {
            planData[roundIdentifier].exercises.push({
                id: planData[roundIdentifier].exercises.length + 1,
                title: nodeData.title,
                exercise_id: nodeData.exercise_id,
                picPath: nodeData.picPath,
                exercises: [],
                count: nodeData.count,
                modus: nodeData.modus,
                exclude: nodeData.exclude,
                shortDescr: nodeData.shortDescr,
                duration: nodeData.duration,
                equipment: nodeData.equipment,
                difficulty: nodeData.difficulty
            });
                
            $translate("EXERCISE_DUPLICATED").then(function(translation){
                toastr.success(translation);
            });          
        }
    };

    // Returns false if more than one child category already inserted
    $scope.checkDepth = function(scope) {
        var checkOk = true;
        if(scope.depth() > 1){
            checkOk = false;
        }
        return checkOk;
    };

    // Inserts a new round into the workout plan
    $scope.newRound = function(scope) {
        scope.exerciseList.push({
            id: scope.exerciseList.length + 1,
            title: $scope.translations.round,
            exercises: [],
            count: 1,
            duration: 0
        });
    };
    
    // ADDITIONAL INFO FUNCTIONS

    // Function to get a list of relevant tags from DB and copy the elements to the tag cloud
    $scope.getSampleTags = function(){
        tagFact.sample().then(function(response){
            var sampleTags = response.data;
             // Empty old items
            $scope.tagCloudList = [];

            // Loop through new elements and add them to the cloud
            for(var i = 0; i < sampleTags.length; i++){
                // Built new items
                $scope.tagCloudList.push({
                    tagname: sampleTags[i],
                    selected: false
                });
            }
        });
    };

    // Load relevant tags on initialization
    if(!$scope.isEdit){
        $scope.getSampleTags();
    }
    

    // Function to check whether a given tag is already in the tag cloud
    $scope.isInCloud = function(tag){
        var inCloud = false;
        // Loop through all existing elements in the tag cloud and set inCloud to true on match
        for(var j = 0; j < $scope.tagCloudList.length; j++){
            if(tag == $scope.tagCloudList[j].tagname){
                inCloud = true;
                break;
            }
        }

        return inCloud;
    };

    // Search for other tags
    $scope.searchAllTags = function(scope){
        scope.tagSearchResults = [];

        // If there is a keyword start searching
        if(scope.tagSearchKey != ""){
            tagFact.search(scope.tagSearchKey).then(function(response){
                var tagArray = response.data;
                var newResults = [];

                // Check if tag already in tag cloud, add to search results otherwise
                for(var i = 0; i < tagArray.length; i++){
                    if(!$scope.isInCloud(tagArray[i])){
                        newResults.push(tagArray[i]);
                    }
                }

                // Write not existing results in the search results
                scope.tagSearchResults = newResults;
            });
        } else {
            scope.tagSearchResults = [];
        }
    };

    // Clear search
    $scope.clearSearch = function(scope){
        scope.tagSearchKey = "";
        scope.tagSearchResults = [];
    };

    // Add a tag to the cloud and mark it as selected
    $scope.addTagToCloud = function(scope, tag){
        // Add item the cloud
        $scope.tagCloudList.push({
            tagname: tag,
            selected: true
        });

        var resultScope = scope.$parent;
        // Remove from search results
        for(var i = 0; i < resultScope.tagSearchResults.length; i++){
            if(resultScope.tagSearchResults[i] == tag){
                resultScope.tagSearchResults.splice(i, 1);
            }
        }

    };

    // Confirm whether the current searchkey is already in tag cloud
    $scope.keyIsInCloud = function(scope){
        return $scope.isInCloud(scope.tagSearchKey);
    }

    // Add the search word as new tag to cloud
    $scope.addAsNewTag = function(scope){
        $scope.tagCloudList.push({
            tagname: scope.tagSearchKey,
            selected: true
        });
    };
    
    // Function returning selected tags and exercise ids
    $scope.getSelectedTags = function(){
        var selectedTags = [];
        for(var i = 0; i < $scope.tagCloudList.length; i++){
            if($scope.tagCloudList[i].selected == true){
                selectedTags.push($scope.tagCloudList[i].tagname);
            }
        } 
        return selectedTags;   
    };
    $scope.getExerciseIDs = function(){
        // Prepare an array of all exercise IDs
        var exerciseIDsArray = [];
        for(var i = 0; i < $scope.uniqueExercises.length; i++){
            exerciseIDsArray.push($scope.uniqueExercises[i].exercise_id);
        }
        return exerciseIDsArray;        
    };
    
    $scope.savingInProgress = false;
    // Initiiate saving the workout
    $scope.sendSaveRequests = function(scope){
            // Prepare the arrays of all exercise IDs and selected tags
            var exerciseIDsArray = $scope.getExerciseIDs();
            var selectedTags = $scope.getSelectedTags();

            // Now create the workout data string
            var data = {
                name: scope.name,
                dimensions: scope.dimensions,
                exerciseMap: scope.exerciseList,
                duration: scope.estTime,
                difficulty: scope.estDifficulty,
                roundCount: scope.roundCount,
                exCount: scope.exCount,
                annotations: scope.description,
                tags: selectedTags,
                picPath: scope.picPath,
                exerciseIDs: exerciseIDsArray
            }

            $scope.savingInProgress = true;
            // Send the data to the service
            workoutFact.create(data).then(function(response){
                $scope.savingInProgress = false;
                $state.go('content.workout', { wid: response.data });
            }).catch(function(response){
                if(~response.data.indexOf('Unconfirmed.')){
                    $translate('CONFIRM_TO_PROCEED').then(function(message){
                        toastr.error(message);
                    });
                } else if(~response.data.indexOf('Something crashed.')){
                    $translate('ERROR_STH_CRASHED').then(function(message){
                        toastr.error(message);
                    });
                }
            });    
    };
    // Initiiate updating the workout
    $scope.sendUpdateRequests = function(scope){
        // Prepare the arrays of all exercise IDs and selected tags
        var exerciseIDsArray = $scope.getExerciseIDs();
        var selectedTags = $scope.getSelectedTags();

        // Now create the workout data string
        var data = {
            name: scope.name,
            workout_id: scope.workout_id,
            dimensions: scope.dimensions,
            exerciseMap: scope.exerciseList,
            duration: scope.estTime,
            difficulty: scope.estDifficulty,
            roundCount: scope.roundCount,
            exCount: scope.exCount,
            annotations: scope.description,
            tags: selectedTags,
            picPath: scope.picPath,
            pdfPath: scope.pdfPath,
            exerciseIDs: exerciseIDsArray
        }

        $scope.savingInProgress = true;
        // Send the data to the service
        workoutFact.update(data).then(function(response){
            $scope.savingInProgress = false;
            // Remove RootScope data
            $rootScope.isEdit = false;
            $rootScope.workout = {};
            $state.go('content.workout', { wid: response.data });
        }).catch(function(response){
            if(~response.data.indexOf('Unconfirmed.')){
                $translate('CONFIRM_TO_PROCEED').then(function(message){
                    toastr.error(message);
                });
            } else if(~response.data.indexOf('Something crashed.')){
                $translate('ERROR_STH_CRASHED').then(function(message){
                    toastr.error(message);
                });
            }
        });   
    };
    
    // STORE DATA ACTIONS                                                                                              
    $scope.saveWorkout = function(scope){
        // Check if user is logged in
        if(!$auth.isAuthenticated()){
            $translate("LOGIN_TO_PROCEED").then(function(translation){
                toastr.error(translation);   
            });          
        } else {
            // Determine whether to create a new workouts or to update an existing one
            // Upload the preview image
            if($scope.prevPicFile){
                dataFact.storeWorkoutPic($scope.prevPicFile, $scope.name).then(function(response){
                    $scope.picPath = response.data.name;
                    if(!$scope.isEdit){
                        $scope.sendSaveRequests(scope);    
                    } else {
                        $scope.sendUpdateRequests(scope);    
                    }  
                });
            } else {
                // Create/ update workout without image
                if(!$scope.isEdit){
                    $scope.sendSaveRequests(scope);
                } else {
                    $scope.sendUpdateRequests(scope);
                }
            }       
        }        
    };
}]);