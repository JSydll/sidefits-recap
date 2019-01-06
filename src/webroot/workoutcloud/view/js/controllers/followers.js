// HOME
angular.module('workoutBox').controller('followersCtrl', ['$scope', 'userFact', '$sce', function($scope, userFact, $sce){
    $scope.followerList = [{
        "byMe": [],
        "toMe": []
    }];
    
    // Infinite loading globals
    $scope.loadingLimit = {"byMe" : 7, "toMe": 7};
    $scope.loadingCurrent = {"byMe" : 0, "toMe": 0};
    $scope.loadingEnabled = {"byMe" : true, "toMe": true};

    function pushFollowerList(targetArray, targetList){
        if(targetList == "byMe"){
            // Empty old items
            $scope.followerList.byMe = [];
    
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
                    // Built new items
                    $scope.followerList.byMe.push({
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
        } else {
            // Empty old items
            $scope.followerList.toMe = [];

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
                    // Built new items
                    $scope.followerList.toMe.push({
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
        
        
    }

    // Function to get favorite workouts for the preview
    $scope.getFollows = function(){
        userFact.getFollows($scope.loadingLimit.byMe, $scope.loadingCurrent.byMe).then(function(response){
            var follows = response.data;
            pushFollowerList(follows, "byMe");
            $scope.loadingCurrent.byMe += $scope.loadingLimit.byMe;
            // Hide load more button if there are less new results than limit
            if(follows.length < $scope.loadingLimit.byMe){
                $scope.loadingEnabled.byMe = false;
            }
        });
    };
    
    // Function to get created workouts for the preview
    $scope.getFollowed = function(){
        userFact.getFollowed($scope.loadingLimit.toMe, $scope.loadingCurrent.toMe).then(function(response){
            var followed = response.data;
            pushFollowerList(followed, "toMe");
            $scope.loadingCurrent.toMe += $scope.loadingLimit.toMe;
            // Hide load more button if there are less new results than limit
            if(followed.length < $scope.loadingLimit.toMe){
                $scope.loadingEnabled.toMe = false;
            }
        });
    }

    // Initiate the workoutList with random or most liked workouts
    $scope.initFollowerList = function(){
        $scope.getFollows();
        $scope.getFollowed();
    }
    
    $scope.initFollowerList();
    
    // Follow/ unfollow
    $scope.followUnfollow = function(scope){
        userFact.followUnfollow(scope.user_id).then(function(response){
            scope.user.isFollowed = response.data;
        }).catch(function(response){
            if(~response.data.indexOf('Not logged in.')){
                $translate('LOGIN_TO_FOLLOW').then(function(message){
                    toastr.error(message);
                });
            } else if(response.status == 401){
                $translate('LOGIN_TO_FOLLOW').then(function(message){
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