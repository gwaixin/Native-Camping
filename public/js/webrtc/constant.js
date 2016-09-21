var constant = (function() {
	"use strict";
	
	var con = {};
	
	con.signalHost = "localhost";
	con.signalPort = 3030;

	/* camera streams */
	con.myCamera = "#ownVideo";
	con.peerCamera = "#othersVideo";

	return con;
	
})();