angular.module('angular-wp')
    .controller('MembershipController', function ($scope, $http, $timeout) {

    	$scope.users = {};
    	$scope.c = -1;
    	$scope.usernameTaken = false;
    	$scope.isSuccess = false;
    	$scope.billing = {};
    	$scope.membershipCost = null;
    	
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
            	window.location = "/checkout";
            });
    	};
    	
    	$scope.getMembershipLevels = function(){
    		var url = "/api/member/levels";
    		$http({
                url: url,
                method: "GET"
            }).success(function (data) {
            	$scope.membershipLevels = data;
            });
    	};
    	
    	$scope.setMembershipCost = function(){
    		$scope.membershipCost = $scope.membershipLevels[$scope.member.membership_level - 1].initial_payment;
    	};
    	
    	$scope.getAdditionalUsers = function(){
    		var url = "/api/member/affiliates";
    		$http({
                url: url,
                method: "GET"
            }).success(function (data) {
            	$scope.users = data.affiliates;
            	$scope.c = data.affiliates.length - 1;
            	console.log($scope.c);
            });
    	};
    	
    	$scope.setAdditionalUsers = function(){
    		var url = "/api/member/affiliates";
    		$scope.member = {};
    		$scope.member.additional_users = $scope.users;
    		$http({
                url: url,
                method: "POST",
                data: jQuery.param($scope.member),
                headers: getContentTypes().form
            }).success(function (data) {
            	$scope.isSuccess = true;
            	window.location = "/checkout";
            });
    	};
    	
    	$scope.isUsernameTaken = function(){
    		if($scope.member.username.length > 4){
    			var url = "/api/member/check";
        		$http({
                    url: url,
                    method: "POST",
                    data: jQuery.param({username: $scope.member.email}),
                    headers: getContentTypes().form
                }).success(function (data) {
                	$scope.usernameTaken = data.is_taken;
                });
    		}
    	};
    	
    	$scope.charge = function(){
    		$scope.billing.expiration_date = $scope.billing.expiration_month + $scope.billing.expiration_year;
    		$scope.billing.country = "US";
    		var url = "/api/member/pay";
    		$http({
                url: url,
                method: "POST",
                data: jQuery.param($scope.billing),
                headers: getContentTypes().form
            }).success(function (data) {
            	$scope.billing.status = data.status;
            	if(data.status == true){
            		$timeout(
            			function(){
            				window.location = "/";
            			}, 
            			5000
            		);
            	}
            });
    	};
    	
    	$scope.getCurrentUser = function(){
    		var url = "/api/member/current";
    		$http({
                url: url,
                method: "GET",
            }).success(function (data) {
            	if(data.first_name !== false){
            		$scope.member = data;
            		$scope.users = data.affiliates;
            	}
            });
    	};
    
    	angular.element("#address").attr("g-places-autocomplete", "");
    	angular.element("#address").attr("ng-model", "address");
    	angular.element("#city").attr("ng-model", "city");
    	angular.element("#state").attr("ng-model", "state");
    }
);