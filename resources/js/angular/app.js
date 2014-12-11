angular
    .module("todoApp", ['ngResource', 'ngRoute'])
    .config(['$routeProvider', function($routeProvider) {
        $routeProvider
            .when('/', {
                controller: 'TodosController',
                templateUrl: '/templates/home.html'
            })
            .otherwise({
                redirectTo: '/'
            });
    }]);