var eventCommon = (function() {
	"use strict";
	
	/* declare variables */
	var obj = {};
	var element = null;
	
	/* initialize events*/
	obj.init = function(callback) {
		/* declare element for global usage */
		element = this;
		
		element.receiveCommands();
		
		/* execute callback */
		if ($.isFunction(callback)) { callback(); }
	};
	
	obj.receiveCommands = function() {
		/* disable event duplication */
		if (!eventCommon.preventTwice('lesson_common_events')) {
			return console.warn("[SOCKET] duplicate common events");
		}
		
		/* catch socket events */
		connect.socket
		
		/* catch room success connection */
		.off('common.connectedToRoom').on('common.connectedToRoom', function(data){})
		
		/* catch user class checker */
		.off('room.userHasClass').on('room.userHasClass', function(data){})
		
		/* catch teacher clear class checker */
		.off('room.clearClassOccupants').on('room.clearClassOccupants', function(data){})
		
		/* catch sent general command event */
		.off('room.generalCommandSent').on('room.generalCommandSent', function(data){})
		
		/* receive general message events */
		.off('room.generalCommand').on('room.generalCommand', function(data){
			console.log('[EVENT_COMMON] received generalCommand', data);
			switch(data.command) {
				/* catch general connect */
				case 'teacherConnected': 
					ngLesson.$apply(ngLesson.sendMessage('Teacher has connected', 'system'));
					break;
				case 'studentConnected':
					ngLesson.$apply(ngLesson.sendMessage('Student has connected', 'system'));
					break;
				// case 'roomConnected' : break;
				// case 'startLesson' : break;
				// case 'callStudent' : break;
				// case 'appendConnectedTest' : break;
				// case 'selectIp' : break;
				// case 'closeExistingAdmin' : break;
				// case 'refreshConnectedAdmin' : break;
				// case 'removeAdminIp' : break;
				// case 'studentSelectingTextbook' : break;
				// case 'studentSelectedTextbook' : break;
				// case 'studentSelectedSideMenuTextbook' : break;
				// case 'changeVolume' : break;
				// case 'toggleCamera' : break;
				// case 'refreshPeerJS' : break;
				
				/* catch general disconnection */
				case 'lessonDisconnect' :
				case 'teacherLessonDisconnect' :
				case 'studentLessonDisconnect' :
				case 'teacherLessonDisconnectOthers' :
				case 'studentLessonDisconnectOthers' :
				case 'studentLessonFinished':
				case 'studentTimedOut' :
				case 'teacherTimedOut' : 
					connect.lessonFinished = true; // set lesson to finished
				case 'teacherForceReconnect' :
				case 'studentForceReconnect' :
				case 'teacherSuddenDisconnect' :
				case 'studentSuddenDisconnect' :
					/* check if angular already setup */
					if (typeof ngLesson !== 'undefined') {
						ngLesson.lessonDisconnect(data);
					} else if (typeof lessonDisconnect !== 'undefined') { 
						lessonDisconnect(data);
					} else {
						console.warn('[EVENT_COMMON] cannot find lessonDisconnect');
					}
					break;
				/* receiving new chat */
				case 'sendChat' : 
					ngLesson.$apply(ngLesson.sendMessage(data.message, 'testing'));
					break;
				// case 'passStudentSettings' : break;
				// case 'passVideoSettings' : break;
				// case 'playSound' : break;
				// case 'callTestStudent' : break;
				// case 'SelectAdmin' : break;
				// case 'adminAvailable' : break;
				// case 'AskAdminCallStudent' : break;
			}
		});
	};
	
	/**
	 * connectToRoom
	 * this function will connect peers to the room
	 */
	obj.connectToRoom = function(callback){
		setTimeout(function(){ connect.socket.emit('common.connectToRoom', connect.config); }, 3000);
	};
	
	/**
	 * function that will prevent the duplicate execution
	 * of events
	 */
	obj.preventTwice = function(command){
		/* check if the event has already been executed */
		if ($.inArray(command, connect.preventTwice) >= 0) {
			return false;
		}

		/* push command */
		connect.preventTwice.push(command);

		/* return true */
		return true;
	};
	
	/**
	 * emmiting command to socket
	 * @param  {Object} data [command] type of command wil be send
	 * @param  {Object} data [content] information about the sender
	 * @param  {Object} data [mode] intended for 'to' or 'all'
	 */
	obj.sendCommand = function(data) {
		console.log('[SOCKET] sending general command');
		connect.socket.emit('room.generalCommand', data);
	};
	
	return obj;
})();