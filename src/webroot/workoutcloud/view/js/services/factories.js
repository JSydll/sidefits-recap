// DATA HANDLING IN SERVICES /////////////////////////////////////////////////////////////////////////////////////
var apiPath = '/workoutcloud/api';
var apiHook = ".php";
var workoutBox = angular.module('workoutBox');

workoutBox.factory('tagFact', ['$http', function($http){
    return {
        relevant: function(limit){
            return $http.get(apiPath + '/tag' + apiHook + '/' + limit);
        },
        sample: function(){
            return $http.get(apiPath + '/tag' + apiHook + '/5');
        },
        search: function(keywords){
            return $http.get(apiPath + '/tag' + apiHook + '/search/' + keywords);
        }
    }
}]);

workoutBox.factory('workoutFact', ['$http', function($http){
    return {
        full: function(wid){
            return $http.get(apiPath + '/workout' + apiHook + '/' + wid + '/full');
        },
        getTags: function(wid){
            return $http.get(apiPath + '/workout' + apiHook + '/' + wid + '/tags');
        },
        getExercises: function(wid){
            return $http.get(apiPath + '/workout' + apiHook + '/' + wid + '/exercises');
        },
        random: function(limit, skip){
            return $http.get(apiPath + '/workout' + apiHook + '/random/' + limit + '/' + skip);
        },
        randomName: function(){
            return $http.get(apiPath + '/workout' + apiHook + '/randomName/');
        },
        search: function(keywords, limit, skip){
            return $http.post(apiPath + '/workout' + apiHook + '/search/' + keywords +'/' + limit + '/' + skip);
        },
        liked: function(){
            return $http.get(apiPath + '/workout' + apiHook + '/mostliked/');
        },
        tagged: function(data, limit, skip){
            return $http.post(apiPath + '/workout' + apiHook + '/tagged/' + limit + '/' + skip, data);
        },
        customized: function(data, limit, skip){
            return $http.post(apiPath + '/workout' + apiHook + '/customized/' + limit + '/' + skip, data);
        },
        personalized: function(limit, skip){
            return $http.get(apiPath + '/workout' + apiHook + '/user/personalized/' + limit + '/' + skip);
        },
        favorites: function(limit, skip){
            return $http.get(apiPath + '/workout' + apiHook + '/user/favorites/' + limit + '/' + skip);
        },
        createdBy: function(limit, skip){
            return $http.get(apiPath + '/workout' + apiHook + '/user/created/' + limit + '/' + skip);
        },
        create: function(data){
            return $http.put(apiPath + '/workout' + apiHook + '/user/create', data);
        },
        update: function(data){
            return $http.put(apiPath + '/workout' + apiHook + '/user/update', data);
        },
        likeDislike: function(wid){
            return $http.post(apiPath + '/workout' + apiHook + '/user/' + wid + '/like');
        }
    }
}]);

workoutBox.factory('exerciseFact', ['$http', function($http){
    return {
        search: function(keywords, limit, skip){
            return $http.get(apiPath + '/exercise' + apiHook + '/search/' + keywords + '/' + limit + '/' + skip );
        },
        random: function(){
            return $http.get(apiPath + '/exercise' + apiHook + '/random');
        }
    }
}]);

workoutBox.factory('userFact', ['$http', function($http){
    return {
        search: function(keys, limit, skip){
            return $http.get(apiPath + '/user' + apiHook + '/search/' + keys + '/' + limit + '/' + skip );
        },
        getPublicProfile: function(uid){
            return $http.get(apiPath + '/user' + apiHook + '/public/' + uid );
        },
        followUnfollow: function(passiveUid){
            return $http.post(apiPath + '/user' + apiHook + '/follow/' + passiveUid);
        },
        getFollows: function(limit, skip){
            return $http.get(apiPath + '/user' + apiHook + '/follows/' + limit + '/' + skip);
        },
        getFollowed: function(limit, skip){
            return $http.get(apiPath + '/user' + apiHook + '/followed/' + limit + '/' + skip);
        },
        confirmMail: function(data){
            return $http.post(apiPath + '/user' + apiHook + '/confirm', data);
        },
        startPasswordReset: function(resetEmail) {
            return $http.post(apiPath + '/user' + apiHook + '/passwordRecovery', {resetEmail: resetEmail});
        },
        validResetToken: function(resetEmail, resetToken) {
            return $http.post(apiPath + '/user' + apiHook + '/passwordRecovery', {resetEmail: resetEmail, resetToken: resetToken});
        },
        performPasswordReset: function(resetEmail, resetToken, newPassword){
            return $http.post(apiPath + '/user' + apiHook + '/passwordRecovery', {resetEmail: resetEmail, resetToken: resetToken, newPassword: newPassword});
        }
    }
}]);

workoutBox.factory('messages', ['$http', function($http){
    return {
        sendPDFperMail: function(data){
            return $http.post(apiPath + '/messages' + apiHook + '/workout/PDFperMail', data);
        },
        proposeExercise: function(data){
            return $http.post(apiPath + '/messages' + apiHook + '/exercisePropose', data);
        },
        inviteFriends: function(data){
            return $http.post(apiPath + '/messages' + apiHook + '/user/invite', data);
        }
    }
}]);

workoutBox.factory('dataFact', ['$http', 'Upload', function($http, Upload){
    return {
        storeWorkoutPic: function(ngfFile, wname){
            return Upload.upload({
                url: apiPath + '/data' + apiHook + '/upload/workoutPic',
                method: 'POST',
                data: {file: ngfFile, 'wname': wname }
            });
        },
        storeProfilePic: function(ngfFile, uname){
            return Upload.upload({
                url: apiPath + '/data' + apiHook + '/upload/profilePic',
                method: 'POST',
                data: {file: ngfFile, 'uname': uname }
            });
        },
    }
}]);
