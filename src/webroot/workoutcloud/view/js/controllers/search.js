angular.module('workoutBox').controller('searchCtrl', ['$scope', '$state', '$stateParams', 'workoutFact', 'userFact', 'tagFact', '$translate', 'toastr', '$sce', function($scope, $state, $stateParams, workoutFact, userFact, tagFact, $translate, toastr, $sce){
    // Make math functions available on the page
    $scope.Math = window.Math;
    // Get the query params (reverse the URL encoding of the search string)
    $scope.searchKey = $stateParams.q.replace("+", " ");
    $scope.onlyTags = ($stateParams.tagged != undefined ? true : false);
    // Built an array of the words in the search key
    $scope.searchArray = $scope.searchKey.split(" ");
    // Do another search
    $scope.search = function(scope){
        // Prepare a URL secure string
        var search = scope.searchKey.replace(" ", "+");
        $state.go("content.search", {
            q: search
        });   
    };
    
    
    // Search results for workouts                                                              
    $scope.workoutList = [];
    $scope.workoutLoadingLimit = ($scope.onlyTags ? 6 : 3);              // Attention: As the search also returns workouts that have that key in one of their tags, there will be more results than this limit.
    $scope.workoutLoadingCurrent = 0;
    $scope.workoutLoadingEnabled = true;
    $scope.workoutLoadingActive = true;
    
    // Scope function to get workouts
    $scope.getWorkouts = function(){
        if($scope.searchKey.length){
            workoutFact.search($scope.searchKey, $scope.workoutLoadingLimit, $scope.workoutLoadingCurrent).then(function(response){
                var matchedWorkouts = response.data;
                if(matchedWorkouts.length != 0) {
                    pushWorkoutList(matchedWorkouts);
                    $scope.workoutLoadingCurrent += $scope.workoutLoadingLimit;     
                } 
                if(matchedWorkouts.length < $scope.workoutLoadingLimit){
                    $scope.workoutLoadingEnabled = false;
                }
                $scope.workoutLoadingActive = false;
            });
        }    
    };
    // Initiate the workout list on page load
    $scope.getWorkouts();
    
    // Helper function to append new elements to the workoutList
    function pushWorkoutList(targetArray){
        // Loop through new elements and add them to the list
        if(targetArray.length != 0){
            for(var i = 0; i < targetArray.length; i++){
                // Check if workout already in list
                var notDisplayedYet = true;
                for(var j = 0; j < $scope.workoutList.length; j++){
                    if($scope.workoutList[j].workout_id == targetArray[i].workout_id){
                        notDisplayedYet = false;
                        break;
                    }
                }
                // Built new items if not existant yet
                if(notDisplayedYet){
                    $scope.workoutList.push({
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
    
    // Search results for people
    $scope.peopleList = [];
    $scope.peopleLoadingLimit = 5;
    $scope.peopleLoadingCurrent = 0;
    $scope.peopleLoadingEnabled = true;
    $scope.peopleLoadingActive = true;
    
    $scope.getPeople = function(){
        if($scope.searchKey.length){
            userFact.search($scope.searchKey, $scope.peopleLoadingLimit, $scope.peopleLoadingCurrent).then(function(response){
                var matchedPeople = response.data;
                if(matchedPeople.length != 0) {
                    pushPeopleList(matchedPeople);
                    $scope.peopleLoadingCurrent += $scope.peopleLoadingLimit;
                }
                if(matchedPeople.length < $scope.peopleLoadingLimit){
                    $scope.peopleLoadingEnabled = false;
                } 
                $scope.peopleLoadingActive = false;    
            });
        }    
    };
    
    $scope.getPeople();
    
    // Helper function to append new elements to the workoutList
    function pushPeopleList(targetArray){
        // Loop through new elements and add them to the list
        if(targetArray.length != 0){
            for(var i = 0; i < targetArray.length; i++){               
                // Determine, what contact type the user has (email or link)
                // And change it to html tags
                if(targetArray[i].contact.indexOf('@') > -1){
                    targetArray[i].contact = $sce.trustAsHtml("<a href='mailto:" + targetArray[i].contact + "'>" + targetArray[i].contact + "</a>");
                } else if(targetArray[i].contact.indexOf("http") > -1 || targetArray[i].contact.indexOf("www") > -1){
                    targetArray[i].contact = $sce.trustAsHtml("<a href='" + targetArray[i].contact + "'>" + targetArray[i].contact + "</a>");
                }
                
                $scope.peopleList.push({
                    name: targetArray[i].name,
                    user_id: targetArray[i].user_id,
                    contact: targetArray[i].contact,
                    visible: targetArray[i].visible,
                    picPath: targetArray[i].picPath,
                    shortBio: targetArray[i].shortBio,
                    sampleWorkouts: targetArray[i].sampleWorkouts,
                    isFollowed: targetArray[i].isFollowed
                });
            }
        }
    }
    
    // Search results for tags
    $scope.tagList = [];
    $scope.tagDisplayLimit = 10;
    $scope.tagLoadingActive = true;
    
    $scope.getTags = function(){
        if($scope.searchKey.length){
            for(var t = 0; t < $scope.searchArray.length; t++){
                tagFact.search($scope.searchArray[t]).then(function(response){
                    var tagArray = response.data;
    
                    // Check if tag allready in tag cloud, add to search results otherwise
                    for(var z = 0; z < tagArray.length; z++){
                        if(!$scope.isInCloud(tagArray[z]) && $scope.tagList.length < $scope.tagDisplayLimit + 1){
                             // Check if tag is part of the query
                             if($scope.isInQuery(tagArray[z])){
                                $scope.tagList.push({ name: tagArray[z], selected: true });    
                             } else {
                                $scope.tagList.push({ name: tagArray[z], selected: false });   
                             }
                             
                        }
                    }
                    
                    $scope.tagLoadingActive = false;
                });    
            }
            
        }
    };
    // Initialization on page load
    $scope.getTags();
    
     // Function to check whether a given tag is already in the tag cloud
    $scope.isInCloud = function(tag){
        var inCloud = false;
        // Loop through all existing elements in the tag cloud and set inCloud to true on match
        for(var j = 0; j < $scope.tagList.length; j++){
            if(tag == $scope.tagList[j].name){
                inCloud = true;
                break;
            }
        }
        return inCloud;
    }; 
    $scope.isInQuery = function(tag){
        var inQuery = false;
        for(var t = 0; t < $scope.searchArray.length; t++){ 
            var compareString = "";
            for(var s = 0; s < $scope.searchArray.length - t; s++){
                if(!s){
                    compareString += $scope.searchArray[t];
                } else {
                    compareString += " " + $scope.searchArray[t + s]    
                } 
                if(tag.toLowerCase() == compareString.toLowerCase()){
                    inQuery = true;
                    break;
                }                  
            }                             
        }
        return inQuery;
    } 
    
    // Get tagged workouts
    $scope.getTaggedWorkouts = function(){
        // Check which tags are currently selected and create a temporary array for them
        var selectedTagsString = "";
        for(var i = 0; i < $scope.tagList.length; i++){
            if($scope.tagList[i].selected == true){
                if(!i){
                    selectedTagsString += $scope.tagList[i].name;
                } else {
                    selectedTagsString += " " + $scope.tagList[i].name;                
                }
            }
        }     
        // Remove duplicate words
        selectedTagsString = selectedTagsString.split(" ").filter(function(value,index,self){return self.indexOf(value)===index }).join('+');    
        // Defer to the tagged workout page
        $state.go('content.search', {
            q: selectedTagsString,
            tagged: true      
        });  
    };
    
    // Like/dislike a workout
    $scope.likeDislike = function(scope){
        workoutFact.likeDislike(scope.workout_id, $scope.userId).then(function(response){
            scope.isLiked = response.data;
        }).catch(function(response){
            if(~response.data.indexOf('Not logged in.')){
                $translate('LOGIN_TO_LIKE').then(function(message){
                    toastr.error(message);
                });
            } else if(response.status == 401){
                $translate('LOGIN_TO_LIKE').then(function(message){
                    toastr.error(message);
                });
            } else if(~response.data.indexOf('Unconfirmed.')){
                $translate('CONFIRM_TO_PROCEED').then(function(message){
                    toastr.error(message);
                });
            } else {
                $translate('ERROR_STH_CRASHED').then(function(message){
                    toastr.error(message);
                });
            }
        });
    };
}]);