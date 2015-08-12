angular.module('angular-wp')
    .controller('MembershipController', function ($scope, $http) {

    	$scope.users = {};
    	$scope.c = -1;
    	$scope.usernameTaken = false;
    	$scope.isSuccess = false;
    	
    	$scope.add = function(){
    		$scope.c ++;
    		var index = $scope.c; 
    		$scope.users[index] = {
				id: index,
    			first_name: "",
				last_name: "",
				email: "",
				password: "",
				committee: ""
    		};
    	};
    	
    	$scope.remove = function(i){
    		delete $scope.users[i];
    	};
    	
    	$scope.initialize = function(){
    		$scope.users = {
    		};
    	};
    	
    	$scope.setCity = function(){
    		if (typeof $scope.member.city == "object"){
    			$scope.member.state = $scope.member.city.address_components[1].short_name;
    			$scope.member.city = $scope.member.city.address_components[0].long_name;
    		}
    	};
    	
    	$scope.register = function(){
    		var url = "/api/member/register";
    		$scope.member.additional_users = $scope.users;
    		$http({
                url: url,
                method: "POST",
                data: jQuery.param($scope.member),
                headers: getContentTypes().form
            }).success(function (data) {
            	$scope.isSuccess = true;
            });
    		
    	};
    	
    	$scope.isUsernameTaken = function(){
    		if($scope.member.username.length > 4){
    			var url = "/api/member/check";
        		$http({
                    url: url,
                    method: "POST",
                    data: jQuery.param({username: $scope.member.username}),
                    headers: getContentTypes().form
                }).success(function (data) {
                	$scope.usernameTaken = data.is_taken;
                });
    		}
    	};
    
    	angular.element("#address").attr("g-places-autocomplete", "");
    	angular.element("#address").attr("ng-model", "address");
    	angular.element("#city").attr("ng-model", "city");
    	angular.element("#state").attr("ng-model", "state");
    }
);