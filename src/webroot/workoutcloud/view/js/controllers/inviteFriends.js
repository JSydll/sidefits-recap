angular.module('workoutBox')
  .controller('InviteFriendsCtrl', ['$scope', '$auth', '$translate', 'Account', '$uibModalStack', 'messages', 'toastr', function($scope, $auth, $translate, Account, $uibModalStack, messages, toastr) {
    $scope.mail = {};
    // Add currently selected language to user data model so that it can be stored for future requests
    $scope.user = {};
    $scope.user.locale = $translate.proposedLanguage() || $translate.use();
    
    // If user is logged in, store profile info
    if($auth.isAuthenticated()){
        Account.getProfile().then(function(response) {
            $scope.mail.initiatorName = response.data.email;
            $scope.mail.initiatorEmail = response.data.name;
        });
    } else {
        $scope.mail.initiatorName = "";
        $scope.mail.initiatorEmail = "";    
    }
    
    $scope.sendMail = function() { 
        var recipients = [];
        var listString = $scope.mail.emailList.replace(/ /g, '');
        $scope.mail.emailList = listString.split(',');
        // Build data object
        var data = {
            "emailList": $scope.mail.emailList,
            "initiatorName": $scope.mail.initiatorName,
            "initiatorEmail": $scope.mail.initiatorEmail,
            "locale": $scope.user.locale
        };
        
        messages.inviteFriends(data).then(function(response){
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