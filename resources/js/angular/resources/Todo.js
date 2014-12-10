angular.module("todoApp")
    .factory('Todo', function($resource) {
        return $resource('/api/v1/todos/:id', {}, {
            'query' : {
                isArray: true,
                transformResponse: function(data) {
                    return angular.fromJson(data).data;
                }
            }
        });
    });