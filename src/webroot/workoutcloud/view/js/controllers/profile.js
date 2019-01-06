angular.module('workoutBox')
  .controller('ProfileCtrl', ['$scope', '$rootScope', '$auth', '$translate', 'toastr', 'Account', 'dataFact', function($scope, $rootScope, $auth, $translate, toastr, Account, dataFact) {
    $scope.user = {};
    
    $scope.getProfile = function() {
        Account.getProfile().then(function(response) {
            $scope.user = response.data;
            $scope.loadUserPreferences();
        }).catch(function(response) {
            toastr.error(response.data.message, response.status);
        });
    };
    $scope.setGender= function(gender){
        $scope.user.gender = gender;    
    };
    
    // Prepare the preferences section
    // Motives
    $scope.preferencesMotives = [
        { name: "Fun with friends", motiveImg: { de_DE: "FunWithFriends.jpg", en_EN: "FunWithFriends.jpg" }, selected: false },
        { name: "Healthy", motiveImg: { de_DE: "Healthy.jpg", en_EN: "Healthy.jpg" }, selected: false },
        { name: "Versatile", motiveImg: { de_DE: "Versatile.jpg", en_EN: "Versatile.jpg" }, selected: false },
        { name: "Quick and dirty", motiveImg: { de_DE: "QuickAndDirty.jpg", en_EN: "QuickAndDirty.jpg" }, selected: false },
        { name: "Go further", motiveImg: { de_DE: "GoFurther.jpg", en_EN: "GoFurther.jpg" }, selected: false },
        { name: "Be free", motiveImg: { de_DE: "BeFree.jpg", en_EN: "BeFree.jpg" }, selected: false }
    ];   
    $scope.preferencesToggleTile = function(tile){
        tile.selected = !tile.selected;
    };
    // Difficulty
    $scope.preferencesDifficulty = {
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
    $scope.preferencesFrequency = {
        val: 3,
        options: { 
            floor: 1, 
            ceil: 7, 
            precision: 0, 
            hideLimitLabels: true, 
            translate: function(value, sliderId){
                // Color fix for all sliders on this page
                $('.rz-bubble').css('color', '#4d4d4d');
                return value + ' ' + $scope.daysPerWeek;
            }
        }
    }
    // Dimensions
    $scope.dimensions = [
        { name: "Flexibility", dimImg: { normal: "Flex_empty.png", selected: "Flex_full.png"}, selected: false },
        { name: "Muscular Strength", dimImg: { normal: "Mendurance_empty.png", selected: "Mendurance_full.png"}, selected: false },
        { name: "Muscular Endurance", dimImg: { normal: "Mstrength_empty.png", selected: "Mstrength_full.png"}, selected: false },
        { name: "Cardio", dimImg: { normal: "Cardio_empty.png", selected: "Cardio_full.png"}, selected: false },
    ];  
    $scope.preferencesToggleDimension = function(dim){
        dim.selected = !dim.selected;
    };
    // Load the user specific selection
    $scope.loadUserPreferences = function(){
        if($scope.user.preferences != undefined){
            // Motives
            for(var um = 0; um < $scope.user.preferences.motives.length; um++){
                for(var pm = 0; pm < $scope.preferencesMotives.length; pm++){
                    if($scope.user.preferences.motives[um] == $scope.preferencesMotives[pm].name){
                        $scope.preferencesMotives[pm].selected = true;
                    }
                }
            }
            // Dimensions
            for(var ud = 0; ud < $scope.user.preferences.dimensions.length; ud++){
                for(var pd = 0; pd < $scope.dimensions.length; pd++){
                    if($scope.user.preferences.dimensions[ud] == $scope.dimensions[pd].name){
                        $scope.dimensions[pd].selected = true;
                    }
                }
            }
            // Frequency and difficulty
            $scope.preferencesFrequency.val = $scope.user.preferences.frequency;
            $scope.preferencesDifficulty.min = $scope.user.preferences.difficulty[0];
            $scope.preferencesDifficulty.max = $scope.user.preferences.difficulty[1];
        }    
    };
    
    
    
    $scope.sendUpdateRequests = function(){
        Account.updateProfile($scope.user).then(function() {
            $rootScope.loginStatus = false;
            $rootScope.loginStatus = true;
            $translate("PROFILE_UPDATED").then(function(message){
                toastr.success(message);
            });
        }).catch(function(response) {
            toastr.error(response.data.message, response.status);
        });    
    };
    $scope.updateProfile = function() {
        // Check for changes in the preferences and attach them to the user object
        // Store the selected motives to variable
        var selectedMotives = [];
        for(var r = 0; r < $scope.preferencesMotives.length; r++){
            if($scope.preferencesMotives[r].selected){
                selectedMotives.push($scope.preferencesMotives[r].name);
            }
        }
        // Store the selected dimensions to variable
        var selectedDimensions = [];
        for(var f = 0; f < $scope.dimensions.length; f++){
            if($scope.dimensions[f].selected){
                selectedDimensions.push($scope.dimensions[f].name);
            }
        }
        // Now attach the current values to the user object
        $scope.user.preferences = {
                        motives: selectedMotives,
                        difficulty: [$scope.preferencesDifficulty.min, $scope.preferencesDifficulty.max],
                        frequency: $scope.preferencesFrequency.val,
                        dimensions: selectedDimensions,
                    };
        // Upload the preview image
        if($scope.profilePicFile){
            dataFact.storeProfilePic($scope.profilePicFile, $scope.user.name).then(function(response){
                $scope.user.picPath = response.data.name;
                $scope.sendUpdateRequests();
            });
        } else {        
            // Update profile without new image
            $scope.sendUpdateRequests(); 
        }
        
    };
    
    $scope.setNewPassword = function(data){
        var newPW = data.newPassword;
        if(newPW.length != 0){
            Account.setPassword(newPW).then(function(){
                $translate("PROFILE_SET_PW_SUCCESS").then(function(message){
                    $('#managePassword').dropdown('toggle');
                    toastr.success(message);
                });                             
            }).catch(function() {
                $translate("PROFILE_SET_PW_FAILURE").then(function(message){
                    toastr.error(message);
                });
            });  
        }
    }

    $scope.getProfile();
  }]);
