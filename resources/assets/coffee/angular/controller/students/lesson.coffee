'use strict'

window.ncApp.controller 'Lesson', [
	'$scope'
	'$http'
	($s, $http) ->
		self = this
		
		### initialize variables ###
		$s.chats = []
		$s.chatMessage = ""
		
		### initialize lesson ###
		$s.init = () ->
			connect.init (conn) ->
				### initialize camera ###
				connect.initializeCamera ->
					### initialize events ###
					eventCommon.init()
					### initialize student events ###
					eventStudent.init()
					### initialize connect to room ###
					eventCommon.connectToRoom()
					### catch when no camera is detected ###
					return
				, ->
					console.log 'Cannot detect camera'
					return
				return
			, (error, conn) ->
				console.warn 'ERROR to connect socket: ', error, conn
				return
			return
			
		###*
		 * disconnecting lesson
		 * @param  {Object} data  contains information about the disconnection
		###
		$s.lessonDisconnect = (data) ->
			console.warn data
			
			### prepare command ###
			command = if typeof data.command != 'undefined' then data.command else 'unknown'
			
			### process the disconnection ###
			switch command
				when constant.disconnect.teacher.others
					### teacher has suddenly stop the lesosn by others ###
					console.warn '[SOCKET] teacher stopped lesson by others'
					$s.$apply () ->
						$s.sendMessage "teacher left the lesson", "system"
					setTimeout () ->
						window.location.href = '/student/teacher/' + connect.config.teacherID + "?action=lessonEnd"
					, 1000
					break
				when constant.disconnect.teacher.sudden
					### student will be notify by theacher's sudden disconnection ###
					console.warn '[SOCKET] teacher sudden disconnection'
					$s.$apply () ->
						$s.sendMessage "teacher sudden disconnection", "system"
					break
				when constant.disconnect.teacher.timeOut
					### teacher's connection to the socket server timed out ###
					console.log '[SOCKET] Because the teacher was unable to reconnect within the alotted time, the system will automatically end the lesson.'
					### redirect student to dashboard ###
					setTimeout () ->
						window.location.href = '/student?action=' + command
						return
					, 2000
					break
				else
					console.log '[SOCKET] Unknown disconnection command -> ', command
			return
		
		###*
		 * stops lesson and process disconnecting to socket and redirect to finish lesson page
		###
		$s.endLesson = () ->
			console.warn '[NG] ending the lesson'
			if confirm "Are you sure you want to end lesson now?"
				data = {
					command: 'studentLessonFinished'
					content: connect.config
					mode: 'to'
				}
				eventCommon.sendCommand data
				window.location.href = "/student/lesson_finish"
			return
			
		$s.sendMessage = (message, sender) ->
			console.log '[NG] sending message init'
			
			if message == "" or typeof message == "undefined"
				console.warn '[NG] message is empty'
				return
			
			console.log '[NG] continue message sending'
			
			### prepare message data ###
			data = {
				command: 'sendChat'
				content: connect.config
				mode: 'to'
				message: message
			}
			
			### check if there was a sender, otherwise the student is the sender ###
			if typeof sender == 'undefined'
				sender = "me"
				### send chat to teacher via socket ###
				eventCommon.sendCommand data
			else if sender == 'system'
				### just do nothing ###
			else 
				sender = connect.config.userID
				
			### insert new message to chat layout ###
			$s.chats.push {
				sender: sender
				message: message
			}
			### clear message chat input ###
			$s.chatMessage = ""
			return
		return
]

.directive 'ngEnter', () ->
	(scope, element, attrs) ->
		element.bind 'keydown keypress', (event) ->
			if event.which == 13
				scope.$apply () ->
					scope.$eval attrs.ngEnter
					return
				event.preventDefault()
			return
		return