// HOME
angular.module('workoutBox').controller('favoritesCtrl', ['$scope', 'workoutFact', function($scope, workoutFact){
    // WORKOUT SECTION
    $scope.userId = 4;

    $scope.workoutList = {
        favs: [],
        created: []
    };
    $scope.Math = window.Math;
    // Infinite loading globals
    $scope.loadingLimit = {"favs" : 15, "created": 15};
    $scope.loadingCurrent = {"favs" : 0, "created": 0};
    $scope.loadingEnabled = {"favs" : true, "created": true};

    function pushWorkoutList(targetArray, targetList){
        if(targetList == "favs"){
            // Loop through new elements and add them to the list
            if(targetArray.length != 0){
                for(var i = 0; i < targetArray.length; i++){
                    // Built new items
                    $scope.workoutList.favs.push({
                        name: targetArray[i].name,
                        workout_id: targetArray[i].workout_id,
                        tags: targetArray[i].tags,
                        picPath: targetArray[i].picPath,
                        dimensions: targetArray[i].dimensions,
                        difficulty: targetArray[i].difficulty,
                        duration: targetArray[i].duration,
                        exCount: targetArray[i].exCount,
                        exerciseNames: targetArray[i].exerciseNames,
                        creator_name: targetArray[i].creator_name,
                        creator_id: targetArray[i].creator_id,
                        creator_picPath: targetArray[i].creator_picPath,
                        isLiked: targetArray[i].isLiked
                    });
                }
            }       
        } else {
            // Loop through new elements and add them to the list
            if(targetArray.length != 0){
                for(var i = 0; i < targetArray.length; i++){
                    // Built new items
                    $scope.workoutList.created.push({
                        name: targetArray[i].name,
                        workout_id: targetArray[i].workout_id,
                        tags: targetArray[i].tags,
                        picPath: targetArray[i].picPath,
                        dimensions: targetArray[i].dimensions,
                        difficulty: targetArray[i].difficulty,
                        duration: targetArray[i].duration,
                        exCount: targetArray[i].exCount,
                        exerciseNames: targetArray[i].exerciseNames,
                        creator_name: targetArray[i].creator_name,
                        creator_id: targetArray[i].creator_id,
                        creator_picPath: targetArray[i].creator_picPath,
                        isLiked: targetArray[i].isLiked
                    });
                }
            }            
        }
        
        
    }

    // Function to get favorite workouts for the preview
    $scope.getFavorites = function(){
        workoutFact.favorites($scope.loadingLimit.favs, $scope.loadingCurrent.favs).then(function(response){
            var favorites = response.data;
            pushWorkoutList(favorites, "favs");
            $scope.loadingCurrent.favs += $scope.loadingLimit.favs;
            // Hide load more button if there are less new results than limit
            if(favorites.length < $scope.loadingLimit.favs){
                $scope.loadingEnabled.favs = false;
            }
        });
    };
    
    // Function to get created workouts for the preview
    $scope.getCreated = function(){
        workoutFact.createdBy($scope.loadingLimit.created, $scope.loadingCurrent.created).then(function(response){
            var created = response.data;
            pushWorkoutList(created, "created");
            $scope.loadingCurrent.created += $scope.loadingLimit.created;
            // Hide load more button if there are less new results than limit
            if(created.length < $scope.loadingLimit.created){
                $scope.loadingEnabled.created = false;
            }
        });
    }

    // Initiate the workoutList with random or most liked workouts
    $scope.initWorkoutList = function(){
        $scope.getFavorites();
        $scope.getCreated();
    }
    $scope.initWorkoutList();

    // Function to create workout list filtered by tag
    $scope.filterWorkouts = function(){
        // Check which tags are currently selected and create a temporary array for them
        var tagCloudTags = $scope.tagCloudList;
        var selectedTags = [];

        for(var i = 0; i < tagCloudTags.length; i++){
            if(tagCloudTags[i].selected == true){
                selectedTags.push(tagCloudTags[i].tagname);
            }
        }

        // If there are tags selected, push them to the API and get the results
        if(selectedTags.length != 0){
            // Tags zu einem URL fähigen String konvertieren
            var tagsString = selectedTags[0];
            for(var i = 1; i < selectedTags.length; i++){
                tagsString = tagsString + "+" + selectedTags[i];
            }

             workoutFact.tagged(tagsString).then(function(response){
                var taggedWorkouts = response.data;
                pushWorkoutList(taggedWorkouts);
            });
        } else {
            $scope.initWorkoutList();
        }
    };
    
    // Like/dislike a workout
    $scope.likeDislike = function(scope){
        workoutFact.likeDislike(scope.workout_id, $scope.userId).then(function(response){
            scope.isLiked = response.data;        
        });            
    };
}]);