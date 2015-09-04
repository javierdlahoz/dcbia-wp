angular.module('angular-wp')
    .controller('MemberController', function ($scope, $http, $timeout, MemberService) {

    	$scope.members = {};
    	$scope.query = {};
    	$scope.query.page = 1;
    	
    	$scope.increasePage = function(){
    		$scope.query.page ++;
    		$scope.search();
    	};
    	
    	$scope.decreasePage = function(){
    		$scope.query.page --;
    		$scope.search();
    	};
    	
    	
    	$scope.search = function(){
    		$scope.loading = true;
    		MemberService.getMembers($scope.query, 
    			function(data){
    				$scope.members = data.users;
    				$scope.total = data.total;
    				$scope.pages = data.pages;
    				$scope.page = data.page;
    				
    				$scope.fNumber = (data.page - 1) * data.limit + 1;
    				$scope.lNumber = (data.page) * data.limit;
    				if($scope.lNumber > data.total){
    					$scope.lNumber = data.total;
    				}
    				
    				$scope.loading = false;
    		});
    	};
    	
    }
);