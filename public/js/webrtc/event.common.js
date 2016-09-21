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
		.off('room.generalCommand').on('room.generalCommand', function(data){});
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
	
	return obj;
})();