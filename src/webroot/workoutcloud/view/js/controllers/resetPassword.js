angular.module('workoutBox').controller('resetPasswordCtrl', ['$scope', '$stateParams', '$state', 'userFact', '$translate', 'toastr', function($scope, $stateParams, $state, userFact, $translate, toastr) {
    // Get the reset token data from URI (may be null!)
    $scope.resetToken = $stateParams.t;
    $scope.resetEmail = $stateParams.m;
    
    // Evaluation variables
    $scope.tokenPassed = ($scope.resetToken != undefined)&&($scope.resetEmail != undefined);
    $scope.tokenValid = false;
    // Check funtion, if token and email are valid
    $scope.checkToken = function(){
            if($scope.tokenPassed){
                userFact.validResetToken($scope.resetEmail, $scope.resetToken).then(function(data){
                    $scope.tokenValid = data;
                });
            }
        };
    $scope.checkToken();
    
    $scope.resetPassword = function(formData){
      userFact.performPasswordReset($scope.resetEmail, $scope.resetToken, formData.newPassword)
        .then(function() {
            $translate("PASSWORD_RESET_SUCCESSFULL").then(function(message){
                toastr.success(message);
                $state.go('content.home');
                
            });
        })
        .catch(function() {
            $translate("ERROR_PASSWORD_RESET_FAIL").then(function(message){
                toastr.error(message);
            });
        });
    };
  }]);