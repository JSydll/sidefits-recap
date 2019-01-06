angular.module('workoutBox')
  .controller('SignupCtrl', ['$scope', '$rootScope', '$auth', '$uibModalStack', '$translate', 'toastr', function($scope, $rootScope, $auth, $uibModalStack, $translate, toastr) {
    // Add currently selected language to user data model so that it can be stored for future requests
    $scope.user = {};
    $scope.user.locale = $translate.proposedLanguage() || $translate.use();    
    // Get the customizer data and attach it to the user object
    $scope.userPreferencesDefined = function(){
        return ($rootScope.userPreferences != undefined);
    };
    $scope.user.preferences = ($scope.userPreferencesDefined() ? $rootScope.userPreferences.preferences : {} );    
    $scope.user.gender = ($scope.userPreferencesDefined() ? $rootScope.userPreferences.gender : "male" );
      
    $scope.signup = function() {
      $auth.signup($scope.user)
        .then(function(response) {
          $auth.setToken(response);
          $rootScope.loginStatus = true;
          $translate('CREATE_ACCOUNT_LOGIN').then(function (message) {
            toastr.info(message, {timeOut: 3000});
          });
          $scope.close();
          
        })
        .catch(function(response) {
           if(~response.data.indexOf('User duplicate.')){
                $translate('ERROR_USR_DUPLICATE').then(function(message){
                    toastr.error(message);
                });
            } else if(~response.data.indexOf('Confirmation email not sent.')){
                $translate('ERROR_CONFIRMATION_MAIL').then(function(message){
                    toastr.error(message);
                }); 
            } else {
                $translate('ERROR_STH_CRASHED').then(function(message){
                    toastr.error(message);
                });
            }
            $scope.close();
        });
    };
    $scope.authenticate = function() {
      $auth.authenticate('facebook', $scope.user)
        .then(function(response) {
            if(~response.data.data.indexOf('Account created and logged in.')){
                $translate('LOGIN_PROVIDER_SUCCESSFULL').then(function(message) {
                    toastr.success(message + 'Facebook');
                });
            } else if(~response.data.data.indexOf('Merged accounts and logged in.')){
                $translate('LOGIN_PROVIDER_SUCCESSFULL').then(function(message) {
                    toastr.success(message + 'Facebook');
                });
            } else {
                $translate('LOGIN_PROVIDER_SUCCESSFULL').then(function(message) {
                    toastr.success(message + 'Facebook');
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