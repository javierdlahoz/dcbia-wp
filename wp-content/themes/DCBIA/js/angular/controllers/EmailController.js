angular.module('angular-wp')
    .controller('EmailController', function ($scope, $http, EmailService) {

    	$scope.sendContactEmail = function(){
    		$scope.to = jQuery("#to").val();

    		var formData = {
            	from: $scope.from,
            	content: $scope.content,
            	to: $scope.to,
            	name: $scope.name
            };

    		EmailService.sendContactEmail(formData, function(data){
    			$scope.successfull = data;
    		});

    	};

    	$scope.shareThis = function(){
    		$scope.to = jQuery("#to").val();

    		var formData = {
            	url: window.location.href,
            	to: $scope.to
            };

    		EmailService.shareThis(formData, function(data){
    			$scope.successfull = data;
    		});

    	};
    }
);