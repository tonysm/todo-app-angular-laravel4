angular
    .module("todoApp", ['ngResource', 'ngRoute'])
    .config(['$routeProvider', function($routeProvider) {
        $routeProvider
            .when('/', {
                controller: 'TasksController',
                templateUrl: '/templates/home.html'
            })
            .otherwise({
                redirectTo: '/'
            });
    }]);