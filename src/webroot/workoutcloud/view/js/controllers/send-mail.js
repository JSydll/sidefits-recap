angular.module('workoutBox')
  .controller('SendMailCtrl', ['$scope', '$auth', '$stateParams', '$translate', 'Account', '$uibModalStack', 'messages', 'toastr', function($scope, $auth, $stateParams, $translate, Account, $uibModalStack, messages, toastr) {
    $scope.mail = {};
    // Get the pdf path from state param
    $scope.mail.workoutName = $stateParams.workoutName;
    $scope.mail.workoutURL = $stateParams.workoutURL; 
    $scope.mail.subject = $stateParams.workoutName;   
    $scope.mail.locale = $translate.proposedLanguage() || $translate.use();

    // If user is logged in, store profile info
    if($auth.isAuthenticated()){
        Account.getProfile().then(function(response) {
            $scope.mail.initiatorEmail = response.data.email;
            $scope.mail.initiatorName = response.data.name;
        });
    } else {
        $scope.mail.initiatorEmail = "";
        $scope.mail.initiatorName = "";    
    }
    
    $scope.sendMail = function() {
        // Collect the data to be sent
        var recipients = [];
        var listString = $scope.mail.emailList.replace(/ /g, '');
        $scope.mail.emailList = listString.split(','); 
        // Build data object
        var data = {
            "emailList": $scope.mail.emailList,
            "initiatorName": $scope.mail.initiatorName,
            "initiatorEmail": $scope.mail.initiatorEmail,
            "workoutName": $scope.mail.workoutName,
            "workoutURL": $scope.mail.workoutURL,
            "subject": $scope.mail.subject,
            "message": $scope.mail.message,
            "locale": $scope.mail.locale  
        };
    
        messages.sendPDFperMail(data).then(function(response){
            $translate('EMAIL_SENT').then(function(message){
                toastr.success(message);
            });
            $scope.close();    
        }).catch(function(response) {
            $translate('ERROR_EMAIL_NOT_SENT').then(function(message){
                toastr.error(message);
            });
            $scope.close();
        });
    };
  }]);