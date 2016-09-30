(function() {
  'use strict';
  window.ncApp.controller('Lesson', [
    '$scope', '$http', function($s, $http) {
      var self;
      self = this;

      /* initialize variables */
      $s.chats = [];
      $s.chatMessage = "";

      /* initialize lesson */
      $s.init = function() {
        connect.init(function(conn) {

          /* initialize camera */
          connect.initializeCamera(function() {

            /* initialize events */
            eventCommon.init();

            /* initialize student events */
            eventStudent.init();

            /* initialize connect to room */
            eventCommon.connectToRoom();

            /* catch when no camera is detected */
          }, function() {
            console.log('Cannot detect camera');
          });
        }, function(error, conn) {
          console.warn('ERROR to connect socket: ', error, conn);
        });
      };

      /**
      		 * disconnecting lesson
      		 * @param  {Object} data  contains information about the disconnection
       */
      $s.lessonDisconnect = function(data) {
        var command;
        console.warn(data);

        /* prepare command */
        command = typeof data.command !== 'undefined' ? data.command : 'unknown';

        /* process the disconnection */
        switch (command) {
          case constant.disconnect.teacher.others:

            /* teacher has suddenly stop the lesosn by others */
            console.warn('[SOCKET] teacher stopped lesson by others');
            $s.$apply(function() {
              return $s.sendMessage("teacher left the lesson", "system");
            });
            setTimeout(function() {
              return window.location.href = '/student/teacher/' + connect.config.teacherID + "?action=lessonEnd";
            }, 1000);
            break;
          case constant.disconnect.teacher.sudden:

            /* student will be notify by theacher's sudden disconnection */
            console.warn('[SOCKET] teacher sudden disconnection');
            $s.$apply(function() {
              return $s.sendMessage("teacher sudden disconnection", "system");
            });
            break;
          case constant.disconnect.teacher.timeOut:

            /* teacher's connection to the socket server timed out */
            console.log('[SOCKET] Because the teacher was unable to reconnect within the alotted time, the system will automatically end the lesson.');

            /* redirect student to dashboard */
            setTimeout(function() {
              window.location.href = '/student?action=' + command;
            }, 2000);
            break;
          default:
            console.log('[SOCKET] Unknown disconnection command -> ', command);
        }
      };

      /**
      		 * stops lesson and process disconnecting to socket and redirect to finish lesson page
       */
      $s.endLesson = function() {
        var data;
        console.warn('[NG] ending the lesson');
        if (confirm("Are you sure you want to end lesson now?")) {
          data = {
            command: 'studentLessonFinished',
            content: connect.config,
            mode: 'to'
          };
          eventCommon.sendCommand(data);
          window.location.href = "/student/lesson_finish";
        }
      };
      $s.sendMessage = function(message, sender) {
        var data;
        console.log('[NG] sending message init');
        if (message === "" || typeof message === "undefined") {
          console.warn('[NG] message is empty');
          return;
        }
        console.log('[NG] continue message sending');

        /* prepare message data */
        data = {
          command: 'sendChat',
          content: connect.config,
          mode: 'to',
          message: message
        };

        /* check if there was a sender, otherwise the student is the sender */
        if (typeof sender === 'undefined') {
          sender = "me";

          /* send chat to teacher via socket */
          eventCommon.sendCommand(data);
        } else if (sender === 'system') {

          /* just do nothing */
        } else {
          sender = connect.config.userID;
        }

        /* insert new message to chat layout */
        $s.chats.push({
          sender: sender,
          message: message
        });

        /* clear message chat input */
        $s.chatMessage = "";
      };
    }
  ]).directive('ngEnter', function() {
    return function(scope, element, attrs) {
      element.bind('keydown keypress', function(event) {
        if (event.which === 13) {
          scope.$apply(function() {
            scope.$eval(attrs.ngEnter);
          });
          event.preventDefault();
        }
      });
    };
  });

}).call(this);

//# sourceMappingURL=lesson.js.map
