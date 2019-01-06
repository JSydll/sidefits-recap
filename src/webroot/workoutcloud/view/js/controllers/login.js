angular.module('workoutBox')
  .controller('LoginCtrl', ['$scope', '$rootScope', '$uibModalStack', '$auth', '$translate', 'toastr', function($scope, $rootScope, $uibModalStack, $auth, $translate, toastr) {
    $scope.login = function() {
      $auth.login($scope.user)
        .then(function() {
          $translate('LOGIN_SUCCESSFULL').then(function(message) {
                toastr.success(message);
          });
          $rootScope.loginStatus = true;
          $scope.close();
        })
        .catch(function(response) {
            if(~response.data.indexOf('Wrong password.')){
                $translate('ERROR_WRONG_PASSWD').then(function(message){
                    toastr.error(message);
                });

            } else if(~response.data.indexOf('User not found.')){
                $translate('ERROR_USR_NOT_FOUND').then(function(message){
                    toastr.error(message);
                });

            } else if(~response.data.indexOf('Unconfirmed.')){
                $translate('CONFIRM_TO_PROCEED').then(function(message){
                    toastr.error(message);
                });
            } else if(~response.data.indexOf('Something crashed.')){
                $translate('ERROR_STH_CRASHED').then(function(message){
                    toastr.error(message);
                });
            }
            $scope.close();
        });
    };
    $scope.authenticate = function(provider) {
      $auth.authenticate(provider)
        .then(function(response) {
            if(~response.data.data.indexOf('Account created and logged in.')){
                $translate('LOGIN_PROVIDER_SUCCESSFULL').then(function(message) {
                    toastr.success(message + provider);
                });
            } else if(~response.data.data.indexOf('Merged accounts and logged in.')){
                $translate('LOGIN_PROVIDER_SUCCESSFULL').then(function(message) {
                    toastr.success(message + provider);
                });
            } else {
                $translate('LOGIN_PROVIDER_SUCCESSFULL').then(function(message) {
                    toastr.success(message + provider);
                });
            }
          $rootScope.loginStatus = true;
          $scope.close();
        })
        .catch(function(response) {
            if(~response.data.indexOf('Something crashed.')){
                $translate('ERROR_STH_CRASHED').then(function(message){
                    toastr.error(message);
                });
            } else if(~response.data.indexOf('Not authenticated with facebook.')){
                $translate('ERROR_FBAUTH_FAILED').then(function(message){
                    toastr.error(message);
                });
            }
            $scope.close();
        });
    };
  }]);
