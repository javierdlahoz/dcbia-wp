angular.module('angular-wp')
	.controller('ResourceController', function ($scope, $http, $rootScope, ResourceService, $timeout, localStorageService) {
		
		getResources = function(formData){
			ResourceService.getResources(
				formData, 
				function(data){
					console.log(data);
				}
			);
		}
		
		$scope.getResourcesByType = function(type){
			var formData = {
				"resource_type": type
			};
			getResources(formData);
		};
		
		$scope.getResourcesBySubject = function(subject){
			var formData = {
				"subject_of_resource": subject
			};
			getResources(formData);
		};
		
		$scope.getResourcesByKeyIssue = function(keyIssue){
			var formData = {
				"key_issue": keyIssue
			};
			getResources(formData);
		};
		
		$scope.initial = function(){
			getResources({});
		};
	});
