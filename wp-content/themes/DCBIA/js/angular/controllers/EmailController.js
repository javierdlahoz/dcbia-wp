angular.module('angular-wp')
    .controller('EmailController', function ($scope, $http, EmailService) {
    	
    	$scope.successToNewsletter = false;
    	$scope.errorOnNewsletter = false;
    	
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
    	
    	$scope.addToNewsletter = function(){
    		$scope.newsletter.nk = "5db2d2f6d9";
    		$scope.errorOnNewsletter = false;
    		EmailService.addToNewsletter($scope.newsletter, function(data){
    			console.log(data);
    			if(data.message == true){
    				$scope.successToNewsletter = true;
    			}
    			else{
    				$scope.errorOnNewsletter = data.message;
    			}
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