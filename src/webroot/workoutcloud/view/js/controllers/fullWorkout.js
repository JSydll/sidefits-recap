angular.module('workoutBox').controller('fullWorkoutCtrl', ['$scope', '$stateParams', '$state', '$rootScope', 'workoutFact', '$auth', 'Account', 'userFact', '$translate', 'toastr', function($scope, $stateParams, $state, $rootScope, workoutFact, $auth, Account,  userFact, $translate, toastr){
    $scope.workout_id = $stateParams.wid;
    // Enable Math functions in page
    $scope.Math = window.Math;
    
    $scope.name = "";
    $scope.picPath = "";
    $scope.duration = 0;
    $scope.roundCount = 1;
    $scope.exCount = 0;
    $scope.roundCount = 0;
    $scope.difficulty = 3;
    $scope.annotations = "";
    $scope.pdfPath = "";
    $scope.tags = [];
    $scope.planData = [];
    $scope.exerciseDescriptions = [];
    $scope.creator = [];
    $scope.sharingText = "";
    $scope.translations = {};
    
    // Get some translations, mainly for the facebook sharing
    $translate(['ROUND', 'ROUNDS', 'DIFFICULTY', 'MORE_SM']).then(function(trans){
        $scope.translations = {
                round : trans.ROUND,
                rounds : trans.ROUNDS,
                difficulty : trans.DIFFICULTY,
                more : trans.MORE_SM
            };    
    });
   
    // Load full workout data from API                                                                       
    $scope.getData = function(){
        // Get the workout data  
        workoutFact.full($scope.workout_id).then(function(response){
            var workout = response.data;            
            $scope.name = workout.name;
            $scope.workout_id = workout.workout_id;
            $scope.picPath = workout.picPath;
            $scope.duration = workout.duration;
            $scope.dimensions = workout.dimensions;
            $scope.difficulty = workout.difficulty;
            $scope.roundCount = workout.roundCount;
            $scope.exCount = workout.exCount;
            $scope.annotations = workout.annotations;
            $scope.pdfPath = workout.pdfPath;
            $scope.tags = workout.tags;
            $scope.planData = workout.exerciseMap;
            $scope.exerciseDescriptions = workout.exerciseDescriptions;
            $scope.creator.name = workout.creator_name;
            $scope.creator.user_id = workout.creator_id;
            $scope.creator.picPath = workout.creator_picPath;
            $scope.creator.shortBio = workout.creator_shortBio;
            $scope.creator.isFollowed = workout.creator_isFollowed; 
            $scope.isLiked = workout.isLiked;
            
            // Build a custom sharing text for facebook
            // Get the round count (WORKAROUND: only for workouts IDs > 73)
            if($scope.workout_id > 73){
                $scope.sharingText += $scope.roundCount;
                if($scope.roundCount > 1){
                    $scope.sharingText += " " + $scope.translations.rounds + " | ";
                } else {
                    $scope.sharingText += " " + $scope.translations.round + " | ";
                }    
            }
            // Get the difficulty
            $scope.sharingText += $scope.translations.difficulty + " " + (Math.round( $scope.difficulty * 10 ) / 10).toFixed(1) + " | ";
            // Get the exercises
            $scope.sharingText += $scope.exerciseDescriptions[0].name; 
            for(var i = 1; i < ($scope.exerciseDescriptions.length > 3 ? 3 : $scope.exerciseDescriptions.length); i++){
                $scope.sharingText += " - " + $scope.exerciseDescriptions[i].name;
            }
            if($scope.exerciseDescriptions.length > 3){
                $scope.sharingText += " + " + ($scope.exerciseDescriptions.length - 3) + " " + $scope.translations.more + "...";
            }
        });
    }        
    $scope.getData();
    
    // Check if user is author of the workout
    $scope.isCreator = false;
    $scope.checkCreator = function(){
        // There needs to be a short delay in checking whether the creator of the workout 
        // is the same as the logged in user in order to get all the data loaded properly. 
        setTimeout(function(){
            Account.getProfile().then(function(response) {
                $scope.isCreator = ($scope.creator.user_id == response.data.user_id);
            });    
        }, 1000); 
    };    
    $scope.checkCreator();     
    
    // Function to store data into the rootScope and change to the edit mode of the creator
    $scope.editWorkout = function(){
        // Store workout data to the rootScope
        $rootScope.isEdit = true;
        $rootScope.workout = {
            name: $scope.name,
            workout_id: $scope.workout_id,
            picPath: $scope.picPath,
            duration: $scope.duration,
            dimensions: $scope.dimensions,
            difficulty: $scope.difficulty,
            roundCount: $scope.roundCount,
            exCount: $scope.exCount,
            annotations: $scope.annotations,
            pdfPath: $scope.pdfPath,
            tags: $scope.tags,
            planData: $scope.planData
        };
        // Now go to the creator in edit mode
        $state.go('content.creator');   
    }
    
    // Like/ unlike workout
    $scope.likeDislike = function(){
        workoutFact.likeDislike($scope.workout_id).then(function(response){
            $scope.isLiked = response.data;
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
    
    // Follow/ unfollow
    $scope.followUnfollow = function(scope){
        userFact.followUnfollow(scope.creator.user_id).then(function(response){
            scope.creator.isFollowed = response.data;
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