angular.module('angular-wp')
    .controller('MembershipController', function ($scope, $http, $timeout, $rootScope) {

    	$scope.users = {};
    	$scope.c = -1;
    	$scope.usernameTaken = false;
    	$scope.isSuccess = false;
    	$scope.billing = {};
    	$scope.membershipCost = null;
    	$scope.disabledToSend = false;
    	$scope.loading = false;
    	$scope.isPacAdded = false;
    	
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
    	
    	$scope.addPac = function(){
    		$http({
                url: "/api/member/addPac",
                method: "GET"
            }).success(function (data) {
            	$scope.isPacAdded = data.pac;
            });
    	};
    	
    	$scope.checkPac = function(){
    		$http({
                url: "/api/member/checkPac",
                method: "GET"
            }).success(function (data) {
            	$scope.isPacAdded = data.pac;
            });
    	};
    	
    	$scope.remove = function(i){
    		delete $scope.users[i];
    	};
    	
    	$scope.initialize = function(){
    		$scope.checkPac();
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
            });
    	};
    	
    	$scope.setAdditionalUsers = function(isRenewal){    		
    		if(isRenewal === undefined){
    			isRenewal = false;
    		}
    		localStorage.setItem("isRenewal", isRenewal);

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
    	
    	setDisabledToSend = function(isTaken){
        	$scope.disabledToSend = isTaken;
    	};
    	
    	$scope.isUsernameTaken = function(email){
    		if($scope.member.email.length > 4){
    			var url = "/api/member/check";
        		$http({
                    url: url,
                    method: "POST",
                    data: jQuery.param({email: $scope.member.email}),
                    headers: getContentTypes().form
                }).success(function (data) {
                	$scope.usernameTaken = data.is_taken;
                	setDisabledToSend(data.is_taken);
                });
    		}
    	};
    	
    	$scope.checkEmailForAffiliates = function(index){
    		var user = $scope.users[index];
    		if(user.email.length > 4){
    			var url = "/api/member/check";
        		$http({
                    url: url,
                    method: "POST",
                    data: jQuery.param({email: user.email}),
                    headers: getContentTypes().form
                }).success(function (data) {
                	$scope.users[index].isTaken = data.is_taken;
                	if($scope.users[index].email == $scope.member.email){
            			$scope.users[index].isTaken = true;
            		}
                	setDisabledToSend(data.is_taken);
                });
    		}
    		
    	};
    	
    	$scope.charge = function(){
    		$scope.loading = true;
    		$scope.billing.expiration_date = $scope.billing.expiration_month + $scope.billing.expiration_year;
    		$scope.billing.country = "US";
    		$scope.billing.isRenewal = localStorage.isRenewal;
    		var url = "/api/member/pay";
    		$http({
                url: url,
                method: "POST",
                data: jQuery.param($scope.billing),
                headers: getContentTypes().form
            }).success(function (data) {
            	$scope.billing.status = data.status;
            	$scope.loading = false;
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