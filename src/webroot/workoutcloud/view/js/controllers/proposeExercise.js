angular.module('workoutBox')
  .controller('ProposeExerciseCtrl', ['$scope', '$auth', '$translate', 'Account', '$uibModalStack', 'messages', 'toastr', function($scope, $auth, $translate, Account, $uibModalStack, messages, toastr) {
    $scope.mail = {};
    // If user is logged in, store profile info
    if($auth.isAuthenticated()){
        Account.getProfile().then(function(response) {
            $scope.mail.email = response.data.email;
            $scope.mail.name = response.data.name;
        });
    } else {
        $scope.mail.email = "";
        $scope.mail.name = "";    
    }
    
    $scope.sendMail = function() { 
        // Build data object
        var data = {
            "email": $scope.mail.email.toString(),
            "name": $scope.mail.name.toString(),
            "subject": $scope.mail.subject.toString(),
            "message": $scope.mail.message.toString() 
        };
        
        messages.proposeExercise(data).then(function(response){
            $translate('EMAIL_SENT').then(function(message){
                toastr.success(message);
                $scope.close();
            });    
        }).catch(function(response) {
            $translate('ERROR_MESSAGE_NOT_SENT').then(function(message){
                toastr.error(message);
            });
            $scope.close();
        });
    };
  }]);