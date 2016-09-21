var eventTeacher = (function() {
	"use strict";
	var obj = {};
	var element = null;
	
	/* initialize events */
	obj.init = function() {
		element = this;
		/* add handler for receiving events */
		this.receiveCommands();
	};
	
	/**
	 * receive exclusive commands from nodejs
	 */
	obj.receiveCommands = function(){};
	
	return obj;
})();