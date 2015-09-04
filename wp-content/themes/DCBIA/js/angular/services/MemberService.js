angular.module('angular-wp')
	.factory('MemberService', function($http) {

		return{
			getMembers: function(formData, callBack){
				$http({
	                url: "/api/member/index",
	                method: "POST",
	                data: jQuery.param(formData),
	                headers: getContentTypes().form
	            }).success(function (data) {
	            	return callBack(data);
	            });
			}
		};
	});