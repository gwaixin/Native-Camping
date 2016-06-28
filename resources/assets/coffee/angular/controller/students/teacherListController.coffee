'use strict'

window.ncApp.controller 'TeacherList', [
	'$scope'
	'$rootScope'
	'$http'
	($s, $rs, $http) ->
		self = this
		$s.teachers = []
		
		# initialize Teacher list controller
		$s.init = ->
			$http.get($rs.baseUrl + 'user/teachers').then (res) ->
				if res.data
					$s.teachers = res.data
				else
					console.warn 'There is an error upon request'
				return
			return
			
		$s.init()
		return
]