(function() {
  'use strict';
  window.ncApp = angular.module('ncApp', []);

  window.ncApp.run([
    '$rootScope', '$http', function($rs, $http) {
      $rs.baseUrl = "/";
    }
  ]);

  window.ncApp.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%=');
    $interpolateProvider.endSymbol('%>');
  });

}).call(this);

//# sourceMappingURL=app.js.map
