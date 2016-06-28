(function() {
  'use strict';
  window.ncApp.factory('RequestHandler', [
    '$rootScope', '$http', function($rs, $http) {
      var fac;
      fac = {};
      fac.teacher = function(id) {
        return $http.get($rs.baseUrl + 'user/teacher/' + id);
      };
      fac.teacherAll = function() {
        return $http.get($rs.baseUrl + 'user/teacher/all');
      };
      fac.teacherUpdate = function(id, data) {
        return $http.put($rs.baseUrl + 'user/teacher/' + id);
      };
      fac.teacherDelete = function(id) {
        return $http["delete"]($rs.baseUrl + 'user/teacher/' + id);
      };
      fac.student = function(id) {
        return $http.get($rs.baseUrl + 'user/teacher/' + id);
      };
      fac.studentAll = function() {
        return $http.get($rs.baseUrl + 'user/teacher/all');
      };
      fac.studentUpdate = function(id, data) {
        return $http.put($rs.baseUrl + 'user/teacher/' + id, data);
      };
      fac.studenteDelete = function(id) {
        return $http.put($rs.baseUrl + 'user/teacher/' + id);
      };
      return fac;
    }
  ]);

}).call(this);

//# sourceMappingURL=factories.js.map
