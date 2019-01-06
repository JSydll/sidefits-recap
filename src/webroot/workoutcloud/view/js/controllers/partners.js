angular.module('workoutBox')
  .controller('partnersCtrl', ['$scope', '$translate', 'toastr', function($scope, $translate, toastr) {
    $scope.partners = [{
        name: "FitFox",
        slogan: "Vertragsfrei. Flexibel. Fit.",
        logo: "fitfox.png",
        href: "https://www.fitfox.de/",
        translatePrefix: "FITFOX",
        links: [{
            text: "Website",
            href: "https://www.fitfox.de/",
            iconClass: "fa fa-globe icon-xl text-muted"    
        },
        {
            text: "Get a ticket",
            href: "https://www.fitfox.de/fitness-studios/",
            iconClass: "fa fa-ticket icon-xl text-muted"   
        }]
    }];  
  }]);
