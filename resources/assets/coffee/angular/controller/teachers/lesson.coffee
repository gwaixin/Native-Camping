'use strict'

window.ncApp.controller 'Lesson', [
	'$scope'
	'$http'
	($s, $http) ->
		self = this
		
		### initialize lesson ###
		$s.init = () ->
			connect.init (conn) ->
				###initialize camera ###
				connect.intitializeCamera ->
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
				when constant.disconnect.student.timeOut 
					### student's connection to the socket server timed out ###
					console.log 'Because the student was unable to reconnect within the alotted time, the system will automatically end the lesson.'
					
					### redirect the teacher to dashboard ###
					setTimeout(() ->
						window.location.href = '/teacher?action=' + command
						return
					, 2000)
					
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

		return
				
]