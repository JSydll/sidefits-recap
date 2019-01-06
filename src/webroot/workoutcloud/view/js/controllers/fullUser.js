angular.module('workoutBox')
  .controller('fullUserCtrl', ['$scope', '$stateParams', '$translate', 'toastr', 'Account', 'userFact', '$sce', function($scope, $stateParams, $translate, toastr, Account, userFact, $sce) {
    $scope.user = {};
    $scope.user.user_id = $stateParams.uid;
    
    // Get the user data
    userFact.getPublicProfile($scope.user.user_id).then(function(response){
        var profile = response.data;
        // Set returned data in scope user
        $scope.user = {
            name: profile.name,
            user_id: profile.user_id,
            contact: profile.contact,
            visible: profile.visible,
            picPath: profile.picPath,
            shortBio: profile.shortBio,
            sampleWorkouts: profile.sampleWorkouts,
            isFollowed: profile.isFollowed    
        };    
        // Determine, what contact type the user has (email or link)
        // And change it to html tags       
        if($scope.user.contact.indexOf('@') > -1){
            $scope.user.contact = $sce.trustAsHtml("<a href='mailto:" + $scope.user.contact + "'>" + $scope.user.contact + "</a>");
        } else if($scope.user.contact.indexOf("http") > -1 || $scope.user.contact.indexOf("www") > -1){
            $scope.user.contact = $sce.trustAsHtml("<a href='" + $scope.user.contact + "'>" + $scope.user.contact + "</a>");    
        }
    }).catch(function(response){
        if(~response.data.indexOf('Unknown user.')){
            $translate('ERROR_USER_NOT_FOUND').then(function(message){
                toastr.error(message);
            });
        } else {
            $translate('ERROR_STH_CRASHED').then(function(message){
                toastr.error(message);
            });
        }  
    });

    // Check if this is my own profile viewed
    $scope.isMe = false;
    // There needs to be a short delay in checking whether the creator of the workout
    // is the same as the logged in user in order to get all the data loaded properly.
    setTimeout(function(){
        Account.getProfile().then(function(response) {
            $scope.isMe = ($scope.user.user_id == response.data.user_id);
        });
    }, 1000);
    
    // Follow/ unfollow
    $scope.followUnfollow = function(scope){
        userFact.followUnfollow(scope.user.user_id).then(function(response){
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
