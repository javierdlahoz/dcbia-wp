angular.module('angular-wp')
	.factory('EmailService', function($http) {

		return{
			sendContactEmail: function(formData, callBack){
				$http({
	                url: getUrls().sendContactEmail,
	                method: "POST",
	                data: jQuery.param(formData),
	                headers: getContentTypes().form
	            }).success(function (data) {
	            	return callBack(true);
	            }).error(function(data){
	            	return callBack(false);
	            });
			},

			shareThis: function(formData, callBack){
				$http({
	                url: getUrls().shareThis,
	                method: "POST",
	                data: jQuery.param(formData),
	                headers: getContentTypes().form
	            }).success(function (data) {
	            	return callBack(true);
	            }).error(function(data){
	            	return callBack(false);
	            });
			},
			
			addToNewsletter: function(formData, callBack){
				$http({
	                url: "/wp-content/plugins/newsletter/api/add.php",
	                method: "POST",
	                data: jQuery.param(formData),
	                headers: getContentTypes().form
	            }).success(function (data) {
	            	return callBack(data);
	            }).error(function(data){
	            	return callBack(data);
	            });
			}
		};
	});