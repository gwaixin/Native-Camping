'use strict'

window.ncApp.controller 'TeacherList', [
	'$scope'
	'$rootScope'
	'$http'
	'RequestHandler'
	($s, $rs, $http, reqHandler) ->
		self = this
		$s.teachers = []
		
		# initialize Teacher list controller
		$s.init = ->
			reqHandler.teacherAll().then (res) ->
				if res.data
					$s.teachers = res.data
				else
					console.warn 'There is an error upon request'
				return
			return
			
		$s.init()
		return
]