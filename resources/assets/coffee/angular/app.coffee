'use strict'

window.ncApp = angular.module('ncApp', [])

window.ncApp.run [
	'$rootScope'
	'$http'
	($rs, $http) ->
		#initialize global variables
		$rs.baseUrl = "/";
			
		return
]

window.ncApp.config ($interpolateProvider) ->
  $interpolateProvider.startSymbol '<%='
  $interpolateProvider.endSymbol '%>'
  return