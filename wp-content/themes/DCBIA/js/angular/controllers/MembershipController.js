angular.module('angular-wp')
    .controller('MembershipController', function ($scope, $http, $timeout, $rootScope, ZohoService) {

    	$scope.users = {};
    	$scope.c = -1;
    	$scope.usernameTaken = false;
    	$scope.isSuccess = false;
    	$scope.billing = {};
    	$scope.membershipCost = null;
    	$scope.disabledToSend = false;
    	$scope.loading = false;
    	$scope.isPacAdded = false;
    	$scope.membershipName = "";
    	
    	var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();

		if(dd<10) {
		    dd='0'+dd
		} 
		if(mm<10) {
		    mm='0'+mm
		} 

		$scope.today = mm+'/'+dd+'/'+yyyy;
		yyyy = yyyy + 1;
		$scope.nextYear = mm+'/'+dd+'/'+yyyy;
    	
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
    	
    	getMembershipIndex = function(id){
    		var j = 0;
    		for(var index in $scope.membershipLevels){
    			if(id == $scope.membershipLevels[index].id){
    				$scope.membershipName = $scope.membershipLevels[index].name;
    				return j; 
    			}
    			j++;
    		}
    		return 0;
    	};
    	
    	getPaymentInfo = function(){
    		var paymentInfo = {
    			"Potential Name": $scope.member.company_name + " " + $scope.today,
    			"Account Name": $scope.member.company_name,
    			"Contact Name": $scope.member.first_name + " " + $scope.member.last_name,
    			"Type": "New Registration",
    			"Amount": $scope.member.membership_total_cost,
    			"Closing Date": $scope.today,
    			"Stage": "Paid",
    			"Membership Level": getMembershipIndex($scope.member.membership_level),
    			"Political Action Committee": $scope.member.PAC,
    			"Weblink": true,
    			"Number of Affiliates": $scope.member.affiliates.length
    		};
    		
    		return paymentInfo;
    	};
    	
    	getContactsInfo = function(){
    		var contacts = {};
    		contacts[0] = {
    			"First Name": $scope.member.first_name,
    			"Last Name": $scope.member.last_name,
    			"Account Name": $scope.member.company_name,
    			"Role": "Primary",
    			"Email": $scope.member.email,
    			"Phone": $scope.member.telephone,
    			"Membership Level": $scope.membershipName,
    			"Membership Expiration Date": $scope.nextYear,
    			"Membership Status": "Active",
    			"Billing Street": $scope.member.address1 + " " + $scope.member.address2,
    			"Billing City": $scope.member.city,
    			"Billing State": $scope.member.state,
    			"Billing Code": $scope.member.zip
    		};
    		
    		var j = 1;
    		for(index in $scope.users){
    			contacts[j] = {
					"First Name": $scope.users[index].first_name,
	    			"Last Name": $scope.users[index].last_name,
	    			"Account Name": $scope.member.company_name,
	    			"Role": "Affiliate",
	    			"Email": $scope.users[index].email,
	    			"Membership Level": $scope.membershipName,
	    			"Membership Expiration Date": $scope.nextYear,
	    			"Membership Status": "Active"
    			};
    		}
    		
    		return contacts;
    	}
    	
    	getAccountInfo = function(){
    		var account = {
    			"Account Name": $scope.member.company_name,
    			"Website": $scope.member.company_website,
    			"Business Categories": $scope.member.business_category,
    			"Description": $scope.member.company_description,
    			"Membership Level": $scope.membershipName,
    			"Member Since": $scope.today,
    			"Membership Expiration Date": $scope.nextYear,
    			"Account Status": "Active",
    			"Billing Street": $scope.member.address1 + " " + $scope.member.address2,
    			"Billing City": $scope.member.city,
    			"Billing State": $scope.member.state,
    			"Billing Code": $scope.member.zip
    		};
    		
    		return account;
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
            	console.log(data);
            	if(data.isNewUser === true){
            		ZohoService.insertAccount(getAccountInfo(), function(data){});
                	ZohoService.insertContacts(getContactsInfo(), function(data){});
            	}
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
    		var index = getMembershipIndex($scope.member.membership_level);
    		$scope.membershipCost = $scope.membershipLevels[index].initial_payment;
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
            		ZohoService.insertPayment(getPaymentInfo(), function(data){});
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