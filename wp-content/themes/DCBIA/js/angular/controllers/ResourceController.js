angular.module('angular-wp')
	.controller('ResourceController', function ($scope, $http, $rootScope, ResourceService, $timeout, localStorageService) {
		$scope.orderby = "title";
		$scope.stakeholders = ["*"];
		$scope.resourceType = ["*"];
		$scope.resources = {};
		$scope.resources.resources = [];
		$scope.areasOfFocus = [];
		var perPageResults = 10;
		$scope.page = 1;

		jQuery("#home").removeClass("active");



		/**
		 * it gets the different values of resource formats
		 */
		$scope.getResourceFormats = function () {
			ResourceService.getResourceFormats(function (data) {
				$scope.resourceFormats = data;
			});
		};

		/**
		 * it gets the different values of resource areas of focus
		 */
		$scope.getAreasOfFocus = function () {
			ResourceService.getAreasOfFocus(function (data) {
				$scope.resourceFormats = data;
			});
		};

		/**
		 * it gets the different values of resource type
		 */
		$scope.getResourceTypes = function () {
			ResourceService.getResourceTypes(function (data) {
				$scope.resourceFormats = data;
			});
		};

		/**
		 * it gets the different values of stakeholders
		 */
		$scope.getResourceStakeholders = function () {
			ResourceService.getResourceStakeholders(function (data) {
				$scope.resourceFormats = data;
			});
		};

		/**
		 * it gets the value of query param
		 */
		$scope.getQueryValue = function () {
			if ($scope.query == "" || $scope.query == undefined) {
				$scope.query = jQuery("#query").val();
			}
			localStorageService.set('queryval', $scope.query);
			return $scope.query;
		};

		/**
		 * it gets the value of resourceType param
		 */
		$scope.getAreasOfFocusValue = function () {
			if ($scope.areasOfFocus == "" || $scope.areasOfFocus == undefined) {
				$scope.areasOfFocus = [jQuery("#area-of-focus").val()];
			}
			return $scope.areasOfFocus;
		};

		$scope.setAreasOfFocus = function (areasOfFocus, isFromTopBar) {

			if($scope.areasOfFocus.indexOf("*") >= 0 || isFromTopBar === true){
				$scope.areasOfFocus = [];
			}

			if (areasOfFocus === "*"){
				$scope.areasOfFocus = ["*"];
			}
			else {

				if(!$scope.checkIfValueExistsInObject(areasOfFocus, $scope.areasOfFocus)){
					$scope.areasOfFocus.push(areasOfFocus);
				}
			}
			$scope.page = 1;
			localStorageService.set('areasOfFocus', $scope.areasOfFocus);
		};

		$scope.setStakeholders = function (stakeholders) {

			if($scope.stakeholders.indexOf("*") >= 0){
				$scope.stakeholders = [];
			}

			if(stakeholders === "*"){
				$scope.stakeholders = ["*"];
			} else {
				if (!$scope.checkIfValueExistsInObject(stakeholders, $scope.stakeholders)) {
					$scope.stakeholders.push(stakeholders);
				}
			}
			localStorageService.set('stakeholders', $scope.stakeholders);
			$scope.page = 1;
		};

		$scope.setOrderBy = function (orderby) {
			$scope.orderby = orderby;

			localStorageService.set('orderby', $scope.orderby);
		};

		$scope.setQuery = function (query) {
			$scope.query = query;
			jQuery("#query_from_post").val("");
		}

		$scope.setResourceType = function (resourceType) {
			if($scope.resourceType.indexOf("*") >= 0){
				$scope.resourceType = [];
			}

			if(resourceType === "*"){
				$scope.resourceType = ["*"];
			} else {
				if (!$scope.checkIfValueExistsInObject(resourceType, $scope.resourceType)) {
					$scope.resourceType.push(resourceType);
				}
			}

			localStorageService.set('resourceType', $scope.resourceType);
			$scope.page = 1;
			$scope.searchResources();
		};

		$scope.searchResources = function () {
			$scope.resources.resources = [];
			$scope.page = 1;
			$scope.getDataPaged(1);
    	};

    	$scope.deleteResourceFile = function(id){
			ResourceService.deleteResourceFile(id, function(data){
			});
		};

		$scope.queryinit = function () {
			var exec = false;
			$scope.loading = false;
			$scope.areasOfFocus = [];

			$scope.getDataPaged = function (num) {
				exec = true;
				$scope.loading = true;

				$timeout(
					function () {

						if (localStorageService.get('referer') === 'resource') {
							if(localStorageService.get('queryval')){$scope.query = localStorageService.get('queryval');}
							if(localStorageService.get('areasOfFocus')){$scope.areasOfFocus = localStorageService.get('areasOfFocus');}
							if(localStorageService.get('stakeholders')){$scope.stakeholders = localStorageService.get('stakeholders');}
							if(localStorageService.get('orderby')){$scope.orderby = localStorageService.get('orderby');}
							if(localStorageService.get('resourceType')){$scope.resourceType = localStorageService.get('resourceType');}

							localStorageService.remove('referer');
						}
						
						if(jQuery("#query_from_post").val() !== ""){
							$scope.query = jQuery("#query_from_post").val();
						}

						var formData = {
							query: $scope.getQueryValue(),
							orderby: $scope.orderby,
							stakeholders: $scope.stakeholders,
							'areas-of-focus': $scope.getAreasOfFocusValue(),
							'resource-types': $scope.resourceType,
							paged: num
						};

						ResourceService.getResources(formData, function (data) {
							$scope.resources.facets = data.facets;
							$scope.resources.count = data.count;
							if (data.resources) {
								if(num == 1){
									$scope.resources.resources = [];
								}
								
								var i;
								for (i = 0; i < data.resources.length; i++) {
									$scope.resources.resources.push(data.resources[i]);
								}
							}
							if ($scope.resources.resources == null) {
								$scope.resourcesFound = 0;
							} else {
								$scope.resourcesFound = data.count;
							}
							exec = false;
							$scope.loading = false;
							$scope.page++;

						});
					},
					200
				);
			};


			$scope.increasePaged = function () {
				if (($scope.page <= Math.ceil($scope.resourcesFound / perPageResults) || !$scope.resourcesFound) && !exec) {
					$scope.getDataPaged($scope.page);
				}
			};

		};

		jQuery(".secondary-nav a").click(function (event) {
			event.preventDefault();
		});

		$scope.checkIfValueExistsInObject = function (value, object) {
			for (i in object) {
				if (object[i] === value) {
					return true;
				}
			}
			return false;
		};
	});
