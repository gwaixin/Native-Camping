'use strict'

window.ncApp.factory 'RequestHandler', [
	'$rootScope'
	'$http'
	($rs, $http) ->
		fac = {}
		
		#Teacher's Requests
		fac.teacher = (id)->
			$http.get($rs.baseUrl + 'user/teacher/' + id)
		fac.teacherAll = ->
			$http.get($rs.baseUrl + 'user/teacher/all')
		fac.teacherUpdate = (id, data)->
			$http.put($rs.baseUrl + 'user/teacher/' + id)
		fac.teacherDelete = (id)->
			$http.delete($rs.baseUrl + 'user/teacher/' + id)
	
		#Student's Requests
		fac.student = (id)->
			$http.get($rs.baseUrl + 'user/teacher/' + id)
		fac.studentAll = ->
			$http.get($rs.baseUrl + 'user/teacher/all')
		fac.studentUpdate = (id, data)->
			$http.put($rs.baseUrl + 'user/teacher/' + id, data)
		fac.studenteDelete = (id)->
			$http.put($rs.baseUrl + 'user/teacher/' + id)
			
		fac
]