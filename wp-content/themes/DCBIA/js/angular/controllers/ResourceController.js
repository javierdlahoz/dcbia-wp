angular.module('angular-wp')
	.controller('ResourceController', function ($scope, $http, $rootScope, ResourceService, $timeout) {
		
		$scope.resources = {};
		$scope.formData = {};
		$scope.resultsInTop = false;
		
		getResources = function(){
			$scope.loading = true;
			$scope.resources = {};
			
			ResourceService.getResources(
				$scope.formData, 
				function(data){
					$timeout(
						function(){
							$scope.loading = false;
							$scope.resources = data;
						},
						500
					);
				}
			);
		};
		
		$scope.setOrderBy = function(orderby){
			$scope.formData.orderby = orderby;
			angular.element(".button2").removeClass("advocacy-active");
			
			if(orderby == "date"){
				angular.element("#sort-date").addClass("advocacy-active");
			}
			else{
				angular.element("#sort-title").addClass("advocacy-active");
			}
			getResources();
		};
		
		getKeyIssues = function(){
			$scope.loading = true;
			$scope.resources = {};
			
			ResourceService.getKeyIssues(
				$scope.formData, 
				function(data){
					$timeout(
						function(){
							$scope.loading = false;
							$scope.resources = data;
						},
						500
					);
				}
			);
		};
		
		setTypeActive = function(type){
			angular.element(".types").removeClass("active");
			angular.element("#keys").removeClass("active");
			angular.element("#"+type).addClass("active");
			$scope.isTypeSearch = true;
			delete $scope.formData.key_issue;
		};
		
		setActiveKeyIssue = function(keyIssue){
			angular.element(".types").removeClass("active");
			angular.element("#keys").addClass("active");
			angular.element(".issues").removeClass("active");
			
			console.log(keyIssue);
			if(keyIssue !== null){
				angular.element("#heading_"+keyIssue).addClass("active");
			}
			
			delete $scope.formData.resource_type;
			$scope.isTypeSearch = false;
		};
		
		$scope.searchOnlyInText = function(){
			$scope.resultsInTop = true;
			delete $scope.formData.key_issue;
			delete $scope.formData.resource_type;
			delete $scope.formData.subject_of_resource;
			getResources();
		};
		
		$scope.search = function(){
			$scope.formData.query = "";
			$scope.resultsInTop = false;
			getResources();
		};
		
		$scope.getResourcesByType = function(type){
			$scope.formData.resource_type = type;
			setTypeActive(type);
			getResources();
		};
		
		$scope.getResourcesBySubject = function(subject){
			$scope.formData.subject_of_resource = subject;
			getResources();
		};
		
		$scope.getResourcesByKeyIssue = function(keyIssue){
			$scope.formData.key_issue = keyIssue;
			setActiveKeyIssue(keyIssue);
			getKeyIssues();
		};
		
		$scope.initial = function(){
			$scope.formData.query = "";
			$scope.resultsInTop = false;
			$scope.getResourcesByType("resource_testimony");
		};
	});
