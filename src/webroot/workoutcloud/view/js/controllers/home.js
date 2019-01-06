// HOME
angular.module('workoutBox').controller('homeCtrl', ['$scope', 'tagFact', 'workoutFact', '$auth', '$rootScope', '$location', '$anchorScroll', '$translate', '$timeout', '$state', 'toastr', 'toastrConfig', function($scope, tagFact, workoutFact, $auth, $rootScope, $location, $anchorScroll, $translate, $timeout, $state, toastr, toastrConfig){
    // Prepare the math function
    $scope.Math = window.Math;
    
    // Currently selected language key
    $scope.currLang = $translate.proposedLanguage() || $translate.use();
    
    $scope.scrollToTop = function(){
        $anchorScroll('landing-top');  
    };   
    
    $scope.isAuthenticated = function() {
      return $auth.isAuthenticated();
    };
    
    // Function to check whether user is logged in and has workout liked
    $scope.loginLikeStatus = function(){
        var status = false;
        if($auth.isAuthenticated()){
            status = true;
            /* workoutFact.favorites().then(function(response){
               status = (response.data.length != 0);
            }); */
        }
        return status;   
    };
    // Watch out for login status change and eventually reload workouts
    $scope.$watch('$rootScope.loginStatus', function(){
        if($rootScope.loginStatus && $scope.loginLikeStatus()){
            $scope.workoutList = [];
            $scope.loadWorkoutList(false);
        }
    });
    
    // Infinite loading globals
    // If the user is not logged in, there should only be a few workouts displayed
    $scope.loadingLimit = 5;
    $scope.loadingCurrent = 0;
    $scope.loadingEnabled = true;
    $scope.loadingActive = true;

    $scope.workoutList = [];
    $scope.workoutHeadline = "POPULAR_WORKOUTS";

    function pushWorkoutList(targetArray){
        // Loop through new elements and add them to the list
        if(targetArray.length != 0){
            for(var i = 0; i < targetArray.length; i++){
                // Check if workout already in list
                var notDisplayedYet = true;
                for(var j = 0; j < $scope.workoutList.length; j++){
                    if($scope.workoutList[j].workout_id == targetArray[i].workout_id){
                        notDisplayedYet = false;
                        break;
                    }
                }
                // Built new items if not existant yet
                if(notDisplayedYet){
                    $scope.workoutList.push({
                        name: targetArray[i].name,
                        workout_id: targetArray[i].workout_id,
                        tags: targetArray[i].tags,
                        picPath: targetArray[i].picPath,
                        dimensions: targetArray[i].dimensions,
                        difficulty: targetArray[i].difficulty,
                        duration: targetArray[i].duration,
                        exCount: targetArray[i].exCount,
                        exerciseNames: targetArray[i].exerciseNames,
                        creator_name: targetArray[i].creator_name,
                        creator_id: targetArray[i].creator_id,
                        creator_picPath: targetArray[i].creator_picPath,
                        isLiked: targetArray[i].isLiked
                    });    
                }          
            }
        }
    }

    // Function to get user relevant workouts for the preview
    $scope.getUserWorkouts = function(filter){                                                                                 
        $scope.loadingActive = true;
        // The backend call will return personalized workouts first, then WO based on logged-in user's preferences, finally featured WO
        workoutFact.personalized($scope.loadingLimit, $scope.loadingCurrent).then(function(response){                                                                          // TO DO
            var personalizedWorkouts = response.data; 
            pushWorkoutList(personalizedWorkouts);
            $scope.loadingCurrent += $scope.loadingLimit;
            $scope.loadingActive = false;
            // Hide load more button if there are less new results than limit
            if(personalizedWorkouts.length < $scope.loadingLimit){
                $scope.loadingEnabled = false;
            } else {
                $scope.loadingEnabled  = true;
            }
        });
    };

    // Get random workouts for the preview
    $scope.getFeaturedWorkouts = function(filter){
        $scope.loadingActive = true;
        workoutFact.random($scope.loadingLimit, $scope.loadingCurrent).then(function(response){
            var randWorkouts = response.data;
            pushWorkoutList(randWorkouts);
            $scope.loadingCurrent += $scope.loadingLimit;
            $scope.loadingActive = false;
            // Hide load more button if there are less new results than limit
            if(randWorkouts.length < $scope.loadingLimit){
                $scope.loadingEnabled = false;
            } else {
                $scope.loadingEnabled  = true;
            }
        });
    };
    
    // REGULAR TILES SECTION
    $scope.currentMood = { };
    $scope.showMusicIntegration = false;
    $scope.musicIntegrationLink = "";
    $scope.musicIntegrationImg = "";
    $scope.tiles = [
        {   
            name: "Early Bird", filter: { tags: ["Early Bird"] }, tileImg: { de_DE: "Morgensport.jpg", en_EN: "Early_Bird.jpg" }, selected: false, 
            musicIntegration: { img: "8tracks_integration_early_bird.png", url: "http://8tracks.com/the-botens/morning-workout#smart_id=tags:workout+morning:safe&play=1" }
        },
        { 
            name: "Lose Weight", filter: { tags: ["Lose Weight"] }, tileImg: { de_DE: "Abnehmen.jpg", en_EN: "Lose_weight.jpg" }, selected: false, 
            musicIntegration: { img: "8tracks_integration_weight_loss.png", url: "http://8tracks.com/amndanaomi/work-out-that-body#smart_id=tags:running+workout:safe&play=1" } 
        },                         
        {
            name: "Travel", filter: { tags: ["Travel"] }, tileImg: { de_DE: "Reisen.jpg", en_EN: "Travel.jpg" }, selected: false, 
            musicIntegration: { img: "8tracks_travel.png", url: "http://8tracks.com/laiamane/let-s-go#smart_id=tags:workout+travel:safe&play=1" }
        },          
        {
            name: "Anti Stress", filter: { tags: ["Anti Stress"] }, tileImg: { de_DE: "Anti_stress.jpg", en_EN: "Anti_stress.jpg" }, selected: false, 
            musicIntegration: { img: "8tracks_anti_stress.png", url: "http://8tracks.com/hwhit_knee/namaste-bitches#smart_id=tags:calm+workout:safe&play=1" }
        },
        {
            name: "Fun with friends", filter: { tags: ["Fun with Friends", "Group"] }, tileImg: { de_DE: "Fun_with_friends.jpg", en_EN: "Fun_with_friends.jpg" }, selected: false, 
            musicIntegration: { img: "8tracks_funwfriends.png", url: "http://8tracks.com/the-botens/go-be-happy#smart_id=tags:workout+fun+friends:safe&play=1" }
        },
        {
            name: "Be Fit", filter: { tags: ["Be Fit"] }, tileImg: { de_DE: "Be_Fit.jpg", en_EN: "Be_Fit.jpg" }, selected: false, 
            musicIntegration: { img: "8tracks_befit.png", url: "http://8tracks.com/underarmour/rule-yourself#smart_id=tags:workout:safe&play=1" }
        },
        {
            name: "Beast Mode", filter: { tags: ["Beast Mode"] }, tileImg: { de_DE: "Beast_mode.jpg", en_EN: "Beast_mode.jpg" }, selected: false, 
            musicIntegration: { img: "8tracks_beastmode.png", url: "http://8tracks.com/thesourceabe/kill-those-drops-or-i-ll-kill-you#smart_id=tags:beast_mode:safe&play=1" }
        },
        {
            name: "Inspirational", filter: { tags: ["Inspirational"] }, tileImg: { de_DE: "Inspirierend.jpg", en_EN: "Inspirational.jpg" }, selected: false, 
            musicIntegration: { img: "8tracks_inspirational.png", url: "http://8tracks.com/angelica-horsman/majestic-casual#smart_id=tags:beast_mode:safe&play=1" }
        },
        {
            name: "Office break", filter: { tags: ["Travel"], time: [0, 600], difficulty: [1.0, 3.0] }, tileImg: { de_DE: "Officebreak.jpg", en_EN: "Officebreak.jpg" }, selected: false,
            musicIntegration: { img: "8tracks_officebreak.png", url: "http://8tracks.com/angelica-horsman/majestic-casual#smart_id=tags:beast_mode:safe&play=1" }
        },
        {
            name: "Start right", filter: { tags: [], difficulty: [1.0, 2.9] }, tileImg: { de_DE: "Startright.jpg", en_EN: "Startright.jpg" }, selected: false,
            musicIntegration: { img: "8tracks_startright.png", url: "http://8tracks.com/angelica-horsman/majestic-casual#smart_id=tags:beast_mode:safe&play=1" }
        }        
    ];
    $scope.moodToggleTile = function(tile){
        // Function sets current mood to selected, all others to not selected, and stores mood to global variable
        $scope.clearMoods();
        tile.selected = true;
        // Show music integration
        $scope.musicIntegrationLink = tile.musicIntegration.url;
        $scope.musicIntegrationImg = tile.musicIntegration.img;
        $scope.showMusicIntegration = true;
        // Built filtering data
        $scope.currentMood = tile;  
        // And fire the loadWorkouts function
        $scope.loadWorkoutList(false);  
    };
    $scope.clearMoods = function(){
        // Remove all selection marks                                                                            
        for(var c = 0; c < $scope.tiles.length; c++){
            $scope.tiles[c].selected = false;
        }   
    };
    
    // Get workouts for a body region or emotion
    $scope.getTileWorkouts = function(filter){
        // Get the workouts
        $scope.loadingActive = true;
        workoutFact.tagged($scope.currentMood.filter, $scope.loadingLimit, $scope.loadingCurrent).then(function(response){
            var taggedWorkouts = response.data;
            pushWorkoutList(taggedWorkouts);
            $scope.loadingCurrent += $scope.loadingLimit;
            $scope.loadingActive = false;
            // Hide load more button if there are less new results than limit
            if(taggedWorkouts.length < $scope.loadingLimit){
                $scope.loadingEnabled = false;
            } else {
                $scope.loadingEnabled  = true;
            }
            // Scroll to the first workout element
            $anchorScroll('recom-workouts-container');
        });   
    };
    
    //// CUSTOMIZER
    $scope.customizerSteps = [
        {
        templateUrl: 'templates/home-customizer-step1.html'
        },
        {
        templateUrl: 'templates/home-customizer-step2.html'
        },
        {
        templateUrl: 'templates/home-customizer-step3.html'
        }
    ];
    // Motives
    $scope.customizerMotives = [
        { name: "Fun with friends", motiveImg: { de_DE: "FunWithFriends.jpg", en_EN: "FunWithFriends.jpg" }, selected: false },
        { name: "Healthy", motiveImg: { de_DE: "Healthy.jpg", en_EN: "Healthy.jpg" }, selected: false },
        { name: "Versatile", motiveImg: { de_DE: "Versatile.jpg", en_EN: "Versatile.jpg" }, selected: false },
        { name: "Quick and dirty", motiveImg: { de_DE: "QuickAndDirty.jpg", en_EN: "QuickAndDirty.jpg" }, selected: false },
        { name: "Go further", motiveImg: { de_DE: "GoFurther.jpg", en_EN: "GoFurther.jpg" }, selected: false },        
        { name: "Be free", motiveImg: { de_DE: "BeFree.jpg", en_EN: "BeFree.jpg" }, selected: false }        
    ];

    $scope.customizerToggleTile = function(tile){
        tile.selected = !tile.selected;
        $('.carousel-control.right span').addClass('blink');
    };
    $scope.noMotiveSelected = function(){
        var noMotiveSelected = true;
        for(var p = 0; p < $scope.customizerMotives.length; p++){
            if($scope.customizerMotives[p].selected){
                noMotiveSelected = false;
                break;
            }
        }
        return noMotiveSelected;
    };
    $scope.removeBlink = function(){ $('.carousel-control.right span').removeClass('blink'); };
    
    // Gender
    $scope.customizerGender = "";
    $scope.setCustomizerGender = function(gender){
        $scope.customizerGender = gender;    
    };
    // Difficulty
    $scope.customizerDifficulty = {
        min: 2.0,
        max: 4.0,
        options: {
            floor: 1,
            ceil: 5,
            minRange: 1,
            showTicks: true,
            precision: 1
        }
    };
    // Frequency
    $scope.daysPerWeek = "days/week";
    $translate('DAYS_PER_WEEK').then(function(trans){
        $scope.daysPerWeek = trans;
    });
    $scope.customizerFrequency = {
        val: 3,
        options: {
            floor: 1,
            ceil: 7,
            precision: 0,
            hideLimitLabels: true,
            translate: function(value, sliderId){
                return value + ' ' + $scope.daysPerWeek;    
            }
        }
    }
    
    // Dimensions
    $scope.dimensions = [
        { name: "Flexibility", dimImg: { normal: "Flex_empty.png", selected: "Flex_full.png"}, selected: false },
        { name: "Muscular Strength", dimImg: { normal: "Mendurance_empty.png", selected: "Mendurance_full.png"}, selected: false },
        { name: "Muscular Endurance", dimImg: { normal: "Mstrength_empty.png", selected: "Mstrength_full.png"}, selected: false },
        { name: "Cardio", dimImg: { normal: "Cardio_empty.png", selected: "Cardio_full.png"}, selected: false }
    ];
    $scope.customizerToggleDimension = function(dim){
        dim.selected = !dim.selected;
        $('.carousel-control.right span').addClass('blink');
    };
    $scope.customizerProfile = {};
    $scope.getCustomizedWorkouts = function(filter){
        // Make sure, at least one motive has been selected
        if(!$scope.noMotiveSelected()){
            // Now get the workouts
            $scope.loadingActive = true;
            workoutFact.customized($scope.customizerProfile, $scope.loadingLimit, $scope.loadingCurrent).then(function(response){
                var customWorkouts = response.data;
                pushWorkoutList(customWorkouts);
                $scope.loadingCurrent += $scope.loadingLimit;
                $scope.loadingActive = false;
                // Hide load more button if there are less new results than limit
                if(customWorkouts.length < $scope.loadingLimit){
                    $scope.loadingEnabled = false;
                } else {
                    $scope.loadingEnabled  = true;
                }
                // Scroll to the first workout element
                $anchorScroll('recom-workouts-container');
            });    
        }
    };
    $scope.customizerFinalize = function(){
        // Store the selected motives to variable
        var selectedMotives = [];
        for(var r = 0; r < $scope.customizerMotives.length; r++){
            if($scope.customizerMotives[r].selected){
                selectedMotives.push($scope.customizerMotives[r].name);
            }
        }
        // Store the selected dimensions to variable
        var selectedDimensions = [];
        for(var f = 0; f < $scope.dimensions.length; f++){
            if($scope.dimensions[f].selected){
                selectedDimensions.push($scope.dimensions[f].name);    
            }                       
        }
        // Build the customizer profile 
        $scope.customizerProfile = { 
            preferences: {motives: selectedMotives,
                        difficulty: [$scope.customizerDifficulty.min, $scope.customizerDifficulty.max],
                        frequency: $scope.customizerFrequency.val,
                        dimensions: selectedDimensions
                    },
            gender: $scope.customizerGender  
        };
        // Get the workouts 
        $scope.loadWorkoutList(false);
        // Open up the signup dialog and attach the profile info to the rootScope
        $rootScope.userPreferences = $scope.customizerProfile;
        $state.go('modal.signup');    
    };
    
    // Load the workoutList
    // There are 4 cases:
    // - User not logged in:
    // --- Customizer not finalized: SHOW FEATURED WO
    // --- Customizer finalized: SHOW CUSTOMIZED WO
    // - User logged in:
    // --- No mood selected: SHOW USER WO (includes customized)
    // --- Mood selected: SHOW MOOD WO
    $scope.loadWorkoutList = function(more){
        var filter = {};
        // Check if totally new or only additional workouts should be pulled
        if(!more){
            $scope.workoutList = [];
            $scope.loadingCurrent = 0;
        }
        // Now pull the right workouts
        if(!$scope.loginLikeStatus()){
            if($scope.noMotiveSelected()){
                $scope.loadingLimit = 5;
                $scope.clearMoods();
                $scope.workoutHeadline = "POPULAR_WORKOUTS";
                $scope.getFeaturedWorkouts(filter);
            } else {
                $scope.loadingLimit = 15;
                $scope.clearMoods();
                $scope.workoutHeadline = "YOUR_CUSTOMIZED_WORKOUTS";
                $scope.getCustomizedWorkouts(filter);
            }
        } else {
            if($.isEmptyObject($scope.currentMood)){
                $scope.loadingLimit = 15;
                $scope.clearMoods();
                $scope.workoutHeadline = "YOUR_PERSONALIZED_WORKOUTS";
                $scope.getUserWorkouts(filter);
            } else {
                $scope.loadingLimit = 15;
                $scope.getTileWorkouts(filter);
            }
        }
    }
    $scope.loadWorkoutList(false);
    
    // Like/dislike a workout
    $scope.likeDislike = function(scope){
        workoutFact.likeDislike(scope.workout_id, $scope.userId).then(function(response){
            scope.isLiked = response.data;        
        }).catch(function(response){
            if(~response.data.indexOf('Not logged in.')){
                $translate('LOGIN_TO_LIKE').then(function(message){
                    toastr.error(message);
                });
            } else if(response.status == 401){
                $translate('LOGIN_TO_LIKE').then(function(message){
                    toastr.error(message);
                });    
            } else if(~response.data.indexOf('Unconfirmed.')){
                $translate('CONFIRM_TO_PROCEED').then(function(message){
                    toastr.error(message);
                });   
            } else {
                $translate('ERROR_STH_CRASHED').then(function(message){
                    toastr.error(message);
                });    
            }
        });            
    };
    
    // FEATURED IN section
    $scope.features = [
        {img: "laborx.png",
        name: "LaborX Hamburg",
        link: "https://laborx-hamburg.de/"},
        {img: "startupdock.png",
        name: "StartupDock HH",
        link: "https://www.facebook.com/tuhh.entrepreneurship/photos/a.430525700387197.1073741825.241216735984762/820703764702720/?type=3"},
        {img: "hamburgstartups.png",
        name: "Hamburg Startups",
        link: "http://www.hamburg-startups.net/sidefits-launcht-die-workoutcloud/"}, 
        {img: "deutschestartups.png",
        name: "Deutsche Startups",
        link: "http://www.deutsche-startups.de/tag/sidefits/"},
        {img: "fitfox.png",
        name: "FitFox - Vertragsfrei. Flexibel. Fit.",
        link: "https://www.fitfox.de/kooperationen/"},
        {img: "WuV.png",
        name: "Werben und Verkaufen - Aktuelle Nachrichten aus Marketing, Werbung, Media und Medien",
        link: "http://www.wuv.de/"}];
}]);