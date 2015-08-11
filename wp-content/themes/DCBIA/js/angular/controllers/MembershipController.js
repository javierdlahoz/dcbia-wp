angular.module('angular-wp')
    .controller('MembershipController', function ($scope, $http) {

    	$scope.users = {};
    	$scope.c = 0;
    	
    	$scope.add = function(){
    		$scope.c ++;
    		var index = $scope.c; 
    		$scope.users[index] = {
				id: index,
    			fname: "",
				lname: "",
				email: "",
				committee: ""
    		};
    	};
    	
    	$scope.remove = function(i){
    		delete $scope.users[i];
    	};
    	
    	$scope.initialize = function(){
    		$scope.users[$scope.c] = {
				id: "0",
    			fname: "",
				lname: "",
				email: "",
				committee: ""
    		};
    	};
    
    	angular.element("#address").attr("g-places-autocomplete", "");
    	angular.element("#address").attr("ng-model", "address");
    	angular.element("#city").attr("ng-model", "city");
    	angular.element("#state").attr("ng-model", "state");
    }
);