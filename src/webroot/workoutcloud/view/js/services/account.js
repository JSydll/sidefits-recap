var apiPath = '../api';
var apiHook = ".php";

angular.module('workoutBox')
  .factory('Account', function($http) {
    return {
      getProfile: function() {
        return $http.get(apiPath + '/user' + apiHook + '/me');
      },
      updateProfile: function(profileData) {
        return $http.put(apiPath + '/user' + apiHook + '/me', profileData);
      },
      setPassword: function(newPassword) {
        return $http.put(apiPath + '/user' + apiHook + '/me/setPassword', {newPassword: newPassword});
      }
    };
  });
