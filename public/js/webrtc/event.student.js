var eventStudent = (function() {
	"use strict";
	
	/* declare variable */
	var obj = {};
	var element = null;
	
	/* initialize events */
	obj.init = function() {
		element = this;
		
		/* receive events */
		element.receiveCommands();
	};
	
	/**
	 * receive events
	 * @return {[type]}
	 */
	obj.receiveCommands = function() {};
	
	/**
	 * this will call the teacher using his/her peerID
	 * @param  Object data connection
	 */
	obj.callTeacher = function(data) {
		// TODO
	};
	
	/**
	 * when receive teacher call
	 * @param  Object data connection
	 */
	obj.receiveTeacherCall = function (data) {
		// TODO
	};
	
	/**
	 * this event will be triggered when the teacher is
	 * disconnected from the lesson
	 * @param  int disconnectionType the way it will be disconnected
	 */
	obj.handlerTeacherDisconnect = function(disconnectionType) {
		// TODO
	};
	
	/**
	 * clear the teacher disconnection logic
	 */
	obj.clearTeacherDisconnect = function() {
		// TODO
	};
	
	/**
	 * sending message to the teacher
	 * @param  params.info     information of the student
	 * @param  params.message  message content
	 */
	obj.jsSendMessage = function(params) {
		// TODO
	};
	
	/**
	 * pass student settings to teacher
	 * @param  Object config   student's config
	 */
	obj.passStudentSettings = function(config) {
		// TODO
	};
	
	/**
	 * report unknown disconnection to the server
	 */
	obj.reportUnknownDisconnection = function(disconnection) {
		// TODO
	};
	
	
	return obj;
})();