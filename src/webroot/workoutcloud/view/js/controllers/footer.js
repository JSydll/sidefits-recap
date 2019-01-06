angular.module('workoutBox').controller('footerCtrl', ['$scope', '$timeout', '$translate', 'toastr', function($scope, $timeout, $translate, toastr){
    $scope.changeLanguage = function (key) {
        $translate.use(key);
        $timeout(function(){
            $translate('LANGUAGE_SWITCHED').then(function(message){
                toastr.success(message);
            });    
        }, 1000);    
    };  
}]);