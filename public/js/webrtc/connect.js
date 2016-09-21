var connect = (function() {
	"use strict";
	
	/* this will return handlers */
	var con = {};
	var element = null;
	
	/* default host */
	con.signalHost = constant.signalHost;
	con.signalPort = constant.signalPort;
	
	/* will contain the active socket connection */
	con.socket = null;

	/* will contain the active peer connection */
	con.peer = null;
	con.peerID = false;
	
	/* set camera */
	con.camera = null;
	con.cameraStream = null;
	con.cameraConstraints = {video: true, audio: true};
	con.media = {audio: true, video: true};
	con.peerStream = null;
	con.enableMyCamera = 1;
	
	/* prevent twice */
	con.preventTwice = [];
	con.eventsLoaded = false;
	con.lessonFinished = false;
	
	/* free variable for customization */
	con.config = {};
	
	
	/* initialize connection method */
	con.init = function(successCallBack, failCallBack) {
		element = this;
		
		/* try initialize the connections! */
		try {
			/* try connecting to the socket and peer server */
			element.initializeSocket(function() {
				/* connected */
				if ($.isFunction(successCallBack)) { successCallBack(); }
			});
		/* return error if unable to connect to socket or peer server */
	} catch(err) {
			if ($.isFunction(failCallBack)) { failCallBack({error: 'reason_socket_fail', content: err}); }
		}
	};
	
	/* initialize camera */
	con.intitializeCamera = function(successCallBack, failCallBack) {
		element = this;
		
		/* trigger fail callback */
		if (typeof navigator.getUserMedia == 'undefined') { return failCallBack(); }
		
		/* declare camera checker */
		var cameraChecker = new $.Deferred();
		cameraChecker.done(function(stream) {
			/* set my camera */
			$(constant.myCamera)
			.prop("src", window.URL.createObjectURL(stream))
			.attr("muted", true);
			// .attr("poster", "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=");
			
			/* set camera stream */
			element.cameraStream = stream;
			
			// /* declare sound barometer */
			// if (typeof SoundMeter !== 'undefined') { SoundMeter.play(); }
			
			/* check if the camera was successfully intialized */
			if ($.isFunction(successCallBack)) { return successCallBack(); }
		})
		.fail(function(err) {
			/* check if student */
			if (typeof eventStudent !== 'undefined') {
				$('#dialog_error_media #errDiscon span').html(constant.errLesson.JSE11.code);
				$('#trigger_modal_error_media').click();
			}
			
			/* called when no camera is detected */
			if ($.isFunction(failCallBack)) { return failCallBack(err); }
		})
		.always(function(){
			// TODO
			if (typeof eventStudent === 'undefined') { return false; }
			if (element.testing === true) { return false; }
		});
		
		/* set video camera source */
		navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mediaDevices.getUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
		
		/* intialize camera */
	 	element.camera = navigator.getUserMedia(
	 		element.cameraConstraints,
			
			/* if camera detected */
	 		function(stream) {
				connect.media = element.cameraConstraints;
				return cameraChecker.resolve(stream);
			},
			
			/* if no camera was found, disable video, enable audio */
			function(err) {
				/* if teacher event is not defined */
				if (typeof eventTeacher !== 'undefined') { return cameraChecker.reject(err); }
				if (typeof eventStudentTest !== 'undefined') { return cameraChecker.reject(err); }
				
				/* only allow fallback for students */
				element.cameraConstraints.video = false;
				element.cameraConstraints.audio = true;
				element.config.enableMyCamera = 0;
				
				/* get user media */
				element.camera = navigator.getUserMedia(
					element.cameraConstraints,
					function(stream){ 
						connect.media = { video: false, audio: true};
						return cameraChecker.resolve(stream); 
					},
					function(err){ 
						connect.media = { video: false, audio: false};
						return cameraChecker.reject(err); 
					}
				);
			}
		);
	};
	
	/* initialize socket */
	con.initializeSocket = function(successCallBack, failCallBack) {
		element = this;
		
		/* check emergency stop */
		// if (element.emergencyStop) {
			// return console.warn("[SOCKET.IO] stopping socket.io connect");
		// }
		
		/* connect to the socket */
		element.socket = io.connect("https://" + element.signalHost + ":" + element.signalPort, {
			'reconnection': true,
			'reconnnectionDelay': 5000,
			'reconnectionDelayMax': 10000
		});
		
		element.socket
		.off('connect').on('connect', function() {
			/* set socket ID */
			element.config.socketID = element.socket.id;
			/* execute callback */
			if (typeof successCallBack !== 'undefined' && $.isFunction(successCallBack)) { successCallBack(); }
		})
		.off('reconnecting').on('reconnecting', function(number) {
			// TODO
		})
		.off('disconnect').on('disconnect', function(code) {
			// TODO
		})
		.off('error').on('error', function(error) {
			// TODO
		});
	};
	
	return con;
	
})();