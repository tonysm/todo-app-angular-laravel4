angular.module("todoApp")
    .factory('Todo', function($resource) {
        return $resource('/api/v1/todos/:id');
    });