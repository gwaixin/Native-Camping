(function() {
  'use strict';
  window.ncApp.controller('Lesson', [
    '$scope', '$http', function($s, $http) {
      var self;
      self = this;

      /* initialize lesson */
      $s.init = function() {
        return connect.init(function(conn) {

          /*initialize camera */
          return connect.intitializeCamera(function() {

            /* initialize events */
            eventCommon.init();

            /* initialize events */
            eventTeacher.init();

            /* initialize connect to room */
            eventCommon.connectToRoom();

            /* catch when no camera is detected */
          }, function() {
            console.log('Cannot detect camera');
          });
        }, function(error, conn) {
          return console.warn('ERROR to connect socket:', error, conn);
        });
      };

      /**
      		 * disconnecting lesson
      		 * @param  {Object} data contains information about the disconnection
       */
      $s.lessonDisconnect = function(data) {
        var command;
        console.warn(data);

        /* prepare command */
        command = typeof data.command !== 'undefined' ? data.command : 'unknown';

        /* check the disconnection type */
        switch (command) {
          case constant.disconnect.student.timeOut:

            /* student's connection to the socket server timed out */
            console.log('Because the student was unable to reconnect within the alotted time, the system will automatically end the lesson.');

            /* redirect the teacher to dashboard */
            setTimeout(function() {
              window.location.href = '/teacher?action=' + command;
            }, 2000);
            break;
          default:

            /* command does not belongs to any case */
            console.log('Unknown disconnection command -> ', command);
            break;
        }
      };

      /**
      		 * redirect to others page, however it will stop the lesson if it has lesson
       */
      $s.toOthers = function() {
        var data, reason;
        console.warn('[NG] go to others');
        reason = prompt("Are you sure to go to others? state your reason why.", "reason here");
        if (reason) {
          data = {
            command: 'teacherLessonDisconnectOthers',
            content: connect.config,
            mode: 'to'
          };
          eventCommon.sendCommand(data);
          return window.location.href = "/teacher?action=other";
        } else {

        }
      };
    }
  ]);

}).call(this);

//# sourceMappingURL=lesson.js.map
