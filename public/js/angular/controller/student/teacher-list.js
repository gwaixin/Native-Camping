(function() {
  'use strict';
  window.ncApp.controller('TeacherList', [
    '$scope', '$rootScope', '$http', function($s, $rs, $http) {
      var self;
      self = this;
      $s.teachers = [];
      $s.init = function() {
        $http.get($rs.baseUrl + 'user/teachers').then(function(res) {
          if (res.data) {
            $s.teachers = res.data;
          } else {
            console.warn('There is an error upon request');
          }
        });
      };
      $s.init();
    }
  ]);

}).call(this);

//# sourceMappingURL=teacher-list.js.map
