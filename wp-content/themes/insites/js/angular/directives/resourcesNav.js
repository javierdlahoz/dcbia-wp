angular.module('angular-wp')

/**
 * Removes server error when user updates input
 */
    .directive('resourcesNav', function () {
        return {
            restrict: 'E',
            templateUrl: '/wp-content/themes/insites/resources-nav.html',
            controller: 'ResourceController'
        };
    });