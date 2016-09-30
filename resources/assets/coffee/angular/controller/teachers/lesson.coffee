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
				###initialize camera ###
				connect.initializeCamera ->
					### initialize events ###
					eventCommon.init()
					### initialize events ###
					eventTeacher.init()
					### initialize connect to room ###
					eventCommon.connectToRoom()
					### catch when no camera is detected ###
					return
				, ->
					console.log 'Cannot detect camera'
					return
			, (error, conn) ->
				console.warn 'ERROR to connect socket:', error, conn
		
		###*
		 * disconnecting lesson
		 * @param  {Object} data contains information about the disconnection
		###
		$s.lessonDisconnect = (data) ->
			console.warn data
			
			### prepare command ###
			command = if typeof data.command != 'undefined' then data.command else 'unknown'
			
			### check the disconnection type ###
			switch command
				when constant.disconnect.student.finished
					### student ended lesson ###
					console.warn '[SOCKET] student stopped lesson'
					window.location.href = '/student?action=' +command
					break
				
				when constant.disconnect.student.sudden
					### student sudden disconnect ###
					console.warn '[SOCKET] student sudden disconnect'
					break
				
				when constant.disconnect.student.timeOut 
					### student's connection to the socket server timed out ###
					console.log 'Because the student was unable to reconnect within the alotted time, the system will automatically end the lesson.'
					
					### redirect the teacher to dashboard ###
					setTimeout(() ->
						window.location.href = '/teacher?action=' + command
						return
					, 2000)
					break
				else 
					### command does not belongs to any case ###
					console.log 'Unknown disconnection command -> ', command
					break
			return
		
		###*
		 * redirect to others page, however it will stop the lesson if it has lesson
		###
		$s.toOthers = () ->
			console.warn '[NG] go to others'
			reason = prompt "Are you sure to go to others? state your reason why.", "reason here"

			if reason
				data = {
					command: 'teacherLessonDisconnectOthers',
					content: connect.config,
					mode: 'to'
				}
				eventCommon.sendCommand data
				window.location.href = "/teacher?action=other"
			else
				return

		###*
		 * sending message to student by sending it to socket
		###
		$s.sendMessage = (message, sender) ->
			console.log '[NG] sending message init'
			
			### validate send message ###
			if message == "" or typeof message == "undefined"
				console.warn '[NG] message is empty'
				return
			
			console.log '[NG] continue message send'
			
			### prepare message data ###
			data = {
				command: 'sendChat'
				content: connect.config
				mode: 'to'
				message: message
			}
			
			### check if there was a sender, otherwise the teacher is the sender ###
			if typeof sender == 'undefined'
				sender = "me"
				### send chat to student via socket ###
				eventCommon.sendCommand data
			else if sender == 'system'
				### just do nothing ###
			else
				sender = connect.config.teacherID
				
			### inser new message to chat layout ###
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
				scope.$apply ()->
					scope.$eval attrs.ngEnter
					return
				event.preventDefault()
			return
		return