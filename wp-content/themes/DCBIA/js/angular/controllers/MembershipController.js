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
    	$scope.totalCost = 0;
    	var pacCost = 25;
    	$scope.membershipCost = 0;
    	$scope.membershipDescription = "";
    	
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
    		
    		if($scope.member.account_id != ""){
    			paymentInfo["ACCOUNTID"] = $scope.member.account_id;
    			paymentInfo["Type"] = "Renewal";
    		}
    		
    		return paymentInfo;
    	};
    	
    	getContactsInfo = function(){
    		var contacts = {};
    		var billingAddress = $scope.member.address1 + " " + $scope.member.address2;
    		if($scope.member.address2 === null || $scope.member.address2 === undefined){
    			billingAddress = $scope.member.address1;
    		}
    		
    		contacts[0] = {
    			"First Name": $scope.member.first_name,
    			"Last Name": $scope.member.last_name,
    			"Account Name": $scope.member.company_name,
    			"Role": "Primary",
    			"Email": $scope.member.email,
    			"Phone": $scope.member.telephone,
    			"Business Categories": $scope.member.business_category,
    			"Membership Level": $scope.membershipName,
    			"Membership Expiration Date": $scope.nextYear,
    			"Membership Status": "Active",
    			"Billing Street": billingAddress,
    			"Billing City": $scope.member.city,
    			"Billing State": $scope.member.state,
    			"Billing Code": $scope.member.zip
    		};
    		
    		if($scope.member.contact_id != ""){
    			contacts[0]["CONTACTID"] = $scope.member.contact_id; 
    		}
    		if($scope.member.account_id != ""){
    			contacts[0]["CONTACTID"] = $scope.member.account_id; 
    		}
    		
    		var j = 1;
    		for(index in $scope.users){
    			contacts[j] = {
					"First Name": $scope.users[index].first_name,
	    			"Last Name": $scope.users[index].last_name,
	    			"Account Name": $scope.member.company_name,
	    			"Business Categories": $scope.member.business_category,
	    			"Role": "Affiliate",
	    			"Email": $scope.users[index].email,
	    			"Membership Level": $scope.membershipName,
	    			"Membership Expiration Date": $scope.nextYear,
	    			"Membership Status": "Active"
    			};
    			
    			if($scope.users[index].contact_id != ""){
        			contacts[j]["CONTACTID"] = $scope.users[index].contact_id; 
        		}
        		if($scope.member.account_id != ""){
        			contacts[j]["CONTACTID"] = $scope.member.account_id; 
        		}
    		}
    		return contacts;
    	}
    	
    	getAccountInfo = function(){
    		getMembershipIndex($scope.member.membership_level);
    		
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
    			"Billing Code": $scope.member.zip,
    			"Phone": $scope.member.telephone,
    			"Account Type": "Member"
    		};
    		
    		if($scope.member.account_id != ""){
    			account["ACCOUNTID"] = $scope.member.account_id; 
    		}
    		
    		return account;
    	};
    	
    	getTotalCost = function(){
    		if($scope.isPacAdded == true){
        		$scope.totalCost = parseFloat($scope.membershipCost) + pacCost;
        	}
        	else{
        		$scope.totalCost = parseFloat($scope.membershipCost);
        	}
    	};
    	
    	$scope.addPac = function(){
    		$http({
                url: "/api/member/addPac",
                method: "GET"
            }).success(function (data) {
            	$scope.isPacAdded = data.pac;
            	getTotalCost();
            });
    	};
    	
    	$scope.checkPac = function(){
    		$http({
                url: "/api/member/checkPac",
                method: "GET"
            }).success(function (data) {
            	$scope.isPacAdded = data.pac;
            	getTotalCost();
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
    	
    	$scope.updateUser = function(){
    		var url = "/api/member/update";
    		console.log($scope.member);
    		$http({
                url: url,
                method: "POST",
                data: angular.element.param($scope.member),
                headers: getContentTypes().form
            }).success(function (data) {
            	angular.element("#wppb-edit-user").submit();
            });
    	}
    	
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
    		var index = getMembershipIndex($scope.member.membership_level);
    		$scope.membershipCost = $scope.membershipLevels[index].initial_payment;
    		$scope.membershipDescription = $scope.membershipLevels[index].description;
    		getTotalCost();
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
            		ZohoService.insertAccount(getAccountInfo(), function(data){});
            		$timeout(
                			function(){
                				ZohoService.insertContacts(getContactsInfo(), function(data){});
                        		ZohoService.insertPayment(getPaymentInfo(), function(data){});
                			}, 
                		2000
                	);
            		
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
    		$scope.loadingUser = true;
    		var url = "/api/member/current";
    		$http({
                url: url,
                method: "GET",
            }).success(function (data) {
            	$scope.loadingUser = false;
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