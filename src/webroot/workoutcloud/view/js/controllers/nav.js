angular.module('workoutBox').controller('navCtrl', ['$scope', '$rootScope', '$state', '$auth', 'Account', '$translate', 'toastr', function($scope, $rootScope, $state, $auth, Account, $translate, toastr){
    // Determine whether a user is logged in
    $scope.isAuthenticated = function() {
      return $auth.isAuthenticated();
    };
    
    // Prepare the scope.me var containing all user data visible
    $scope.me = {};
    
    // Load the users profile
    $scope.getProfile = function(){
        if($scope.isAuthenticated()){
            Account.getProfile().then(function(response) {
                $scope.me = response.data;
            }).catch(function() {
                $translate("SOMETHING_WENT_WRONG").then(function(message){
                    toastr.error(message);    
                });                
            });
        } else {
            $scope.me = {};
        }  
    };
    $scope.$watch(function() { 
        return $rootScope.loginStatus },
        function(loginStatus) { 
            $scope.getProfile();
            $translate.refresh(); 
        }
    ); 
    
    // GLOBAL SEARCH OPTIONS
    $scope.globalSearch = "";
    $scope.startGlobalSearch = function(scope){
        // Prepare a URL secure string
        var search = scope.globalSearch.replace(" ", "+");
        $state.go("content.search", {
            q: search    
        });       
    };
}]);