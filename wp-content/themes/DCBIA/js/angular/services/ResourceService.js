angular.module('angular-wp')
	.factory('ResourceService', function($http) {

		return{
			getResources: function(formData, callBack){
				$http({
	                url: "/api/resource/get",
	                method: "POST",
	                data: jQuery.param(formData),
	                headers: getContentTypes().form
	            }).success(function (data) {
	            	return callBack(data);
	            });
			}
		};
	});