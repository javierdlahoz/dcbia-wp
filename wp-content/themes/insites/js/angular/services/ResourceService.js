angular.module('angular-wp')
	.factory('ResourceService', function($http) {

		return{
			getResources: function(formData, callBack){
				$http({
	                url: getUrls().searchResources,
	                method: "POST",
	                data: jQuery.param(formData),
	                headers: getContentTypes().form
	            }).success(function (data) {
	            	return callBack(data);
	            });
			},

			getAreasOfFocus: function(callBack){
				$http({
	                url: getUrls().getAreasOfFocus,
	                method: "GET"
	            }).success(function (data) {
	            	return callBack(data);
	            });
			},

			getResourceTypes: function(callBack){
				$http({
	                url: getUrls().getResourceTypes,
	                method: "GET"
	            }).success(function (data) {
	            	return callBack(data);
	            });
			},

			getResourceStakeholders: function(callBack){
				$http({
	                url: getUrls().getResourceStakeholders,
	                method: "GET"
	            }).success(function (data) {
	            	return callBack(data);
	            });
			},

			getResourceFormats: function(callBack){
				$http({
	                url: getUrls().getResourceFormats,
	                method: "GET"
	            }).success(function (data) {
	            	return callBack(data);
	            });
			}
		};
	});