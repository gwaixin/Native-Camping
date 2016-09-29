var constant = (function() {
	"use strict";
	
	var con = {};
	
	con.signalHost = "localhost";
	con.signalPort = 3030;

	/* camera streams */
	con.myCamera = "#ownVideo";
	con.peerCamera = "#othersVideo";

	
	/* socket commands */
	con.disconnect = {
		teacher: {
			finished: "teacherLessonFinished",
			sudden: "teacherSuddenDisconnect",
			others: "teacherLessonDisconnectOthers",
			timeOut: "teacherTimedOut",
			forceReconnect: "teacherForceReconnect",
		},
		student: {
			finished: "studentLessonFinished",
			sudden: "studentSuddenDisconnect",
			timeOut: "studentTimedOut",
			forceReconnect: "studentForceReconnect",
		}
	};


	return con;
	
})();