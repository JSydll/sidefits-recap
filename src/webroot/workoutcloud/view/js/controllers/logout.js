angular.module('workoutBox')
  .controller('LogoutCtrl', ['$scope', '$rootScope', '$state', '$auth', '$translate', 'toastr', function($scope, $rootScope, $state, $auth, $translate, toastr) {
    if (!$auth.isAuthenticated()) { return; }
    $auth.logout()
      .then(function() {
        $translate('LOGOUT_SUCCESSFUL').then(function (message) {
            toastr.info(message);
            $rootScope.loginStatus = false;
            $scope.close();
            $state.go('content.home');
        });
      });
  }]);