angular.module('angular-wp')
    .controller('PostController', function ($scope, $http, $rootScope, PostService) {
    	$scope.paged = 1;

    	$scope.searchPosts = function(){
    		$scope.isLoading = true;
    		var formData = {
            	query: $scope.getQueryValue(),
            	paged: $scope.paged,
            	type: "post"
            };

    		PostService.getPosts(formData, function(data){
    			$scope.isLoading = false;
            	$scope.posts = data.posts;
            	$scope.paged = data.paged;
            	$scope.pagesNumber = data.pagesNumber;
            	$scope.postsFound = data.count;
    		});

    	};

		$scope.increasePaged = function(){
			$scope.paged++;
		};

		$scope.decreasePaged = function(){
			$scope.paged--;
		};

    	/**
    	 * it gets the value of query param
    	 */
    	$scope.getQueryValue = function(){
    		if($scope.query == "" || $scope.query == undefined){
    			$scope.query = jQuery("#query").val();;
    		}

    		return $scope.query;
    	};
    }
);