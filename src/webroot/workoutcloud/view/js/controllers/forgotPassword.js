angular.module('workoutBox')
  .controller('forgotPasswordCtrl', ['$scope', 'userFact', '$translate', 'toastr', function($scope, userFact, $translate, toastr) {
    $scope.forgotPassword = function() {
      userFact.startPasswordReset($scope.email)
        .then(function() {
            $translate("PASSWORD_RESET_MAIL_SENT").then(function(message){
                toastr.success(message);
            });
        })
        .catch(function() {
            $translate("ERROR_PASSWORD_RESET_MAIL").then(function(message){
                toastr.error(message);
            });
        });
    };
  }]);