angular.module('angular-wp')
    .controller('MemberController', function ($scope, $http, $timeout, MemberService) {
    	
    	replaceSpaces = function(str){
    		str = str.replace(/ /g, "");
    		str = str.replace(/\//g, "-");
    		str = str.replace(/\&/g, "-");
    		str = str.replace(/\./g, "-");
    		return str;
    	}; 
    	
    	$scope.members = {};
    	$scope.query = {};
    	$scope.query.page = 1;
    	$scope.query.orderby = "company_name";
		$scope.query.order = "ASC";
		$scope.query.resultsPerPage = 20;
		$scope.query.business_category = "";
    	
    	$scope.increasePage = function(){
    		$scope.query.page ++;
    		$scope.search();
    	};
    	
    	$scope.decreasePage = function(){
    		$scope.query.page --;
    		$scope.search();
    	};
    	
    	$scope.setResultsPerPage = function(resultsPerPage){
    		$scope.query.resultsPerPage = resultsPerPage;
    		$scope.search();
    	};
    	
    	$scope.setBusinessCategory = function(businessCategory){
    		angular.element(".business-categories").removeClass("active");
    		angular.element("#"+replaceSpaces(businessCategory)).addClass("active");
    		$scope.query.business_category = businessCategory;
    		$scope.search();
    	};
    	
    	$scope.setOrderBy = function(orderBy){
    		angular.element(".member-sort").removeClass("active");
    		angular.element("#sort-"+orderBy).addClass("active");
    		if(orderBy == "title"){
    			$scope.query.orderby = "first_name";
    			$scope.query.order = "ASC";
    		}
    		else{
    			$scope.query.orderby = "date";
    			$scope.query.order = "DESC";
    		}
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