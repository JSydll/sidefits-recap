angular.module('workoutBox').controller('ConfirmCtrl', ['$scope', '$rootScope', 'userFact', '$uibModalStack', '$state', '$stateParams', '$translate', 'toastr', function($scope, $rootScope, userFact, $uibModalStack, $state, $stateParams, $translate, toastr) {
    // Send code to API
    userFact.confirmMail({confirmationCode: $stateParams.confirmationCode}).then(function(response){
        // If there is a token in response, overwrite existing to complete login
        if(~response.data.indexOf('Confirmed and logged in.')){
            // Replace old token with new one
            if(typeof(Storage) !== "undefined") {
                localStorage.setItem("satellizer_token", response.token);
                $translate('CONFIRMATION_SUCCESSFULL').then(function(message){
                    toastr.success(message, {timeOut: 3000});
                });
                $scope.close();
                $rootScope.loginStatus = true;
                $state.go('content.home', {timeOut: 3000});
            } else {
                $translate('CONFIRMATION_SUCCESSFULL_LOGIN').then(function(message){
                    toastr.success(message, {timeOut: 3000});
                    $state.go('modal.login');
                });                    
            }        
        } else { // If not, redirect to login
            $translate('CONFIRMATION_SUCCESSFULL_LOGIN').then(function(message){
                toastr.success(message, {timeOut: 3000});
                $state.go('modal.login'); 
            });                
        }             
    }).catch(function(response){
        if(~response.data.indexOf('Code invalid or already confirmed.')){
            $translate('ERROR_CONFIRMATION_REFUSED').then(function(message){
                toastr.error(message, {timeOut: 2000});
                $state.go('modal.login'); 
            }); 
        } else if(~response.data.indexOf('No code supplied.')){
            $translate('ERROR_CONFIRMATION_NOCODE').then(function(message){
                toastr.error(message);
                $scope.close();
                $state.go('content.home'); 
            });            
        } else {
            $translate('ERROR_STH_CRASHED').then(function(message){
                toastr.error(message);
                $scope.close(); 
                $state.go('content.home'); 
            });
        }   
    });
}]);