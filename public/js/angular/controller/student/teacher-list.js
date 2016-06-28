(function() {
  'use strict';
  window.ncApp.controller('TeacherList', [
    '$scope', '$rootScope', '$http', 'RequestHandler', function($s, $rs, $http, reqHandler) {
      var self;
      self = this;
      $s.teachers = [];
      $s.init = function() {
        reqHandler.teacherAll().then(function(res) {
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
