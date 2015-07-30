angular.module('angular-wp')
	.factory('PostService', function($http) {

		return{
			getPosts: function(formData, callBack){
				$http({
	                url: getUrls().searchPost,
	                method: "POST",
	                data: jQuery.param(formData),
	                headers: getContentTypes().form
	            }).success(function (data) {
	            	return callBack(data);
	            });
			}
		};
	});