angular.module('angular-wp')
	.controller('SingleResourceController', function ($scope, localStorageService) {

	localStorageService.set('referer', 'resource');

	});
