var apiHook = ".php";
var workoutBox = angular.module('workoutBox',['ui.tree', 'ui.router', 'ct.ui.router.extras', 'updateMeta', 'angulartics', 'angulartics.google.analytics', 'pascalprecht.translate', 'ui.bootstrap', 'rzModule', 'toggle-switch', 'multiStepForm', 'ngFileUpload', 'angular-loading-bar', '720kb.socialshare', 'angularNumberPicker', 'ngResource', 'ngMessages', 'ngAnimate', 'toastr', 'satellizer', 'ngSanitize']);

// ROUTING
workoutBox.config(function($stateProvider, $stickyStateProvider, $urlRouterProvider, $authProvider, $windowProvider, $locationProvider) {
    // Get an instance of $window service
    var $window = $windowProvider.$get();
    // For any unmatched url, redirect to /state1
    $urlRouterProvider.otherwise("/");
    //
    // Now set up the states
    $stateProvider
    // The two main states are the content (sticky) and the modal (not sticky)
    // The main state 'content' includes all full site templates
    .state('content', {
        url: '',
        views: {
            'content': {
                templateUrl: 'templates/content.html'
            }
          },
          deepStateRedirect: { default: "content.home" },
          sticky: true
    })
    .state('content.home', {
        url: '/home',
        templateUrl: 'templates/home.html',
        controller: 'homeCtrl',
        onEnter: function(){
            $('.collapse').collapse('hide');
            $window.scrollTo(0,0);
        }
    })
    .state('content.search', {
        url: '/search/:q?tagged',
        templateUrl: 'templates/search.html',
        controller: 'searchCtrl',
        onEnter: function(){
            $('.collapse').collapse('hide');
            $window.scrollTo(0,0);
        }
    })
    .state('content.creator', {
        url: "/creator",
        templateUrl: "templates/creator.html",
        controller: 'workoutCreatorCtrl',
        onEnter: function(){
            $('.collapse').collapse('hide');
            $window.scrollTo(0,0);
        }
    })
    .state('content.workout', {
        url: "/workout/:wid",
        templateUrl: "templates/workout-full.html",
        controller: 'fullWorkoutCtrl',
        onEnter: function(){
            $('.collapse').collapse('hide');
            $window.scrollTo(0,0);
        }
    })
    .state('content.favorites', {
        url: "/favorites",
        templateUrl: "templates/favorites.html",
        controller: 'favoritesCtrl',
        onEnter: function(){
            $('.collapse').collapse('hide');
            $window.scrollTo(0,0);
        },
        resolve: {
            loginRequired: loginRequired
        }
    })
    .state('content.followers', {
        url: "/followers",
        templateUrl: "templates/followers.html",
        controller: 'followersCtrl',
        onEnter: function(){
            $('.collapse').collapse('hide');
            $window.scrollTo(0,0);
        },
        resolve: {
             loginRequired: loginRequired
        }
    })
    .state('content.user', {
        url: '/user/:uid',
        templateUrl: 'templates/user-full.html',
        controller: 'fullUserCtrl',
        onEnter: function(){
            $('.collapse').collapse('hide');
            $window.scrollTo(0,0);
        }
    })
    .state('content.profile', {
        url: '/profile',
        templateUrl: 'templates/profile.html',
        controller: 'ProfileCtrl',
        onEnter: function(){
            $('.collapse').collapse('hide');
            $window.scrollTo(0,0);
        },
        resolve: {
            loginRequired: loginRequired
        }
    })
    .state('content.partners', {
        url: '/partners',
        templateUrl: 'templates/partners.html',
        controller: 'partnersCtrl',
        onEnter: function(){
            $('.collapse').collapse('hide');
            $window.scrollTo(0,0);
        }
    })
    .state('content.forgotPassword', {
        url: '/forgotPassword',
        templateUrl: 'templates/forgotPassword.html',
        controller: 'forgotPasswordCtrl',
        onEnter: function(){
            $('.collapse').collapse('hide');
            $window.scrollTo(0,0);
        }
    })
    .state('content.resetPassword', {
        url: '/resetPassword?m&t',
        templateUrl: 'templates/resetPassword.html',
        controller: 'resetPasswordCtrl',
        onEnter: function(){
            $('.collapse').collapse('hide');
            $window.scrollTo(0,0);
        }
    })
    // The main state 'modal' includes all popup templates
    .state('modal', {
        url: '',
        template: '<div ui-view=\"modal\"></div>',
        onEnter: showModal
    })
    .state('modal.login', {
        url: '/login',
        views: {
            'modal': {
                templateUrl: 'templates/login.html',
                controller: 'LoginCtrl'
            }
        },
        resolve: {
            skipIfLoggedIn: skipIfLoggedIn
        }
    })
    .state('modal.signup', {
        url: '/signup',
        views: {
            'modal': {
                templateUrl: 'templates/signup.html',
                controller: 'SignupCtrl'
            }
        },
        resolve: {
            skipIfLoggedIn: skipIfLoggedIn
        }
    })
    .state('modal.confirm', {
        url: '/confirm/:confirmationCode',
        views: {
            'modal': {
                templateUrl: null,
                controller: 'ConfirmCtrl'
            }
        }
    })
    .state('modal.logout', {
        url: '/logout',
        views: {
            'modal': {
                templateUrl: null,
                controller: 'LogoutCtrl'
            }
        }
    })
    .state('modal.sendMail', {
        url: '/sendPerMail/:workoutName/:workoutURL',
        views: {
            'modal': {
                templateUrl: 'templates/send-email.html',
                controller: 'SendMailCtrl'
            }
        }
    })
    .state('modal.proposeExercise', {
        views: {
            'modal': {
                templateUrl: 'templates/proposeExercise.html',
                controller: 'ProposeExerciseCtrl'
            }
        }
    })
    .state('modal.contact', {
        url: '/support',
        views: {
            'modal': {
                templateUrl: 'templates/contact.html',
                controller: 'ProposeExerciseCtrl' // No typo, simply leveraging the same controller
            }
        }
    })
    .state('modal.invite', {
        views: {
            'modal': {
                templateUrl: 'templates/inviteFriends.html',
                controller: 'InviteFriendsCtrl'
            }
        }
    })
    .state('modal.unleash', {
        views: {
            'modal': {
                templateUrl: 'templates/unleash.html',
                controller: 'SignupCtrl'     // No typo, simply leveraging the same controller
            }
        }
    })
    .state('modal.feedback', {
        views: {
            'modal': {
                templateUrl: 'templates/feedback.html',
                controller: 'ProposeExerciseCtrl' // No typo, simply leveraging the same controller
            }
        }
    })
    .state('modal.sportsscientist', {
        views: {
            'modal': {
                templateUrl: 'templates/sportsscientist.html'
            }
        }
    })
    .state('modal.faq', {
        url: '/faq',
        views: {
            'modal': {
                templateUrl: 'templates/faq.html'
            }
        }
    })
    .state('modal.explain', {
        url: '/explain',
        views: {
            'modal': {
                templateUrl: 'templates/explainer.html'
            }
        }
    })
    .state('modal.terms', {
        url: '/terms',
        views: {
            'modal': {
                templateUrl: 'templates/terms.html'
            }
        }
    })
    .state('modal.privacy', {
        url: '/privacy',
        views: {
            'modal': {
                templateUrl: 'templates/privacy.html'
            }
        }
    })
    .state('modal.slackapp', {
        url: '/slackapp',
        views: {
            'modal': {
                templateUrl: 'templates/slackapp.html'
            }
        }
    });

    // Setting for SEO optimization
    $locationProvider.hashPrefix('!');
    $locationProvider.html5Mode(false);

    function showModal($uibModal, $previousState) {
      $previousState.memo("modalInvoker"); // remember the previous state with memoName "modalInvoker"

      $uibModal.open({
        templateUrl: 'templates/modal.html',
        backdrop: 'static',
        controller: function($uibModalInstance, $scope) {
          var isopen = true;
          $uibModalInstance.result.finally(function() {
            isopen = false;
          });
          $scope.close = function () {
            $uibModalInstance.dismiss('close');
            $previousState.go("modalInvoker"); // return to previous state
          };
          $scope.$on("$stateChangeStart", function(evt, toState) {
            if (!toState.$$state().includes['modal']) {
              $uibModalInstance.dismiss('close');
            }
          });
        }
      })
    }
    // Here comes the authorization config
    $authProvider.authHeader = 'SF-Authorization';
    $authProvider.signupUrl = '/api/user' + apiHook + '/register';
    $authProvider.loginUrl = '/api/user' + apiHook + '/login';
    $authProvider.facebook({
        url: '/api/user' + apiHook + '/fbsignin',
        clientId: '177005462647097',
        redirectUri: 'https://workoutcloud.net/'
    });

    function skipIfLoggedIn($q, $auth) {
        var deferred = $q.defer();
        if ($auth.isAuthenticated()) {
            deferred.reject();
        } else {
            deferred.resolve();
        }
        return deferred.promise;
    }

    function loginRequired($q, $state, $auth) {
        var deferred = $q.defer();
        if ($auth.isAuthenticated()) {
            deferred.resolve();
        } else {
            $state.go('login');
        }
        return deferred.promise;
    }
});

// LOADING BAR
workoutBox.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
}]);

// TRANSLATION
workoutBox.config(['$translateProvider',function($translateProvider) {
    // Escaping of text
    $translateProvider.useSanitizeValueStrategy('escaped');

    // Configure language file loader
    $translateProvider.useStaticFilesLoader({
        prefix: 'js/translations/',
        suffix: '.json'
    });

    // Preferred language
    var clientLang = window.navigator.userLanguage || window.navigator.language;
    if(clientLang == 'de'){
        $translateProvider.preferredLanguage('de_DE');
    } else {
        $translateProvider.preferredLanguage('en_EN');
    }

}]);

// Toastr global config
workoutBox.config(function(toastrConfig) {
    angular.extend(toastrConfig, {
        allowHtml: true,
        closeButton: true,
        closeHtml: '<button>&times;</button>',
        onHidden: function(){
            $('.modal-backdrop').remove();
        },
        extendedTimeOut: 500,
        timeOut: 1500,
    });
});

// Analytics
workoutBox.config(function ($analyticsProvider) {
    $analyticsProvider.firstPageview(true);
    $analyticsProvider.withAutoBase(true);
});

workoutBox.run(function ($rootScope, $state, $window, $timeout, $previousState) {
    $rootScope.$state = $state;

    // This code applies a default background state for the modal
    $rootScope.$on("$stateChangeStart", function(evt, toState, toParams, fromState) {
      // Is initial transition and is going to modal1.*?
      if (fromState.name === '' && /modal.*/.exec(toState.name)) {
        evt.preventDefault(); // cancel initial transition

        // go to home, then go to modal.whatever
        $state.go("content.home", null, { location: false }).then(function() {
          $state.go(toState, toParams); }
        );
      }
    });
  });
