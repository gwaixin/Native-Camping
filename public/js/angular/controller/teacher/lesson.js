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
        return connect.init(function(conn) {

          /*initialize camera */
          return connect.initializeCamera(function() {

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
          case constant.disconnect.student.finished:

            /* student ended lesson */
            console.warn('[SOCKET] student stopped lesson');
            window.location.href = '/student?action=' + command;
            break;
          case constant.disconnect.student.sudden:

            /* student sudden disconnect */
            console.warn('[SOCKET] student sudden disconnect');
            break;
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

      /**
      		 * sending message to student by sending it to socket
       */
      $s.sendMessage = function(message, sender) {
        var data;
        console.log('[NG] sending message init');

        /* validate send message */
        if (message === "" || typeof message === "undefined") {
          console.warn('[NG] message is empty');
          return;
        }
        console.log('[NG] continue message send');

        /* prepare message data */
        data = {
          command: 'sendChat',
          content: connect.config,
          mode: 'to',
          message: message
        };

        /* check if there was a sender, otherwise the teacher is the sender */
        if (typeof sender === 'undefined') {
          sender = "me";

          /* send chat to student via socket */
          eventCommon.sendCommand(data);
        } else if (sender === 'system') {

          /* just do nothing */
        } else {
          sender = connect.config.teacherID;
        }

        /* inser new message to chat layout */
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
