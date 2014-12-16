angular.module("todoApp")
    .factory('Task', function($resource) {
        return $resource('/api/v1/tasks/:id', {}, {
            'query': {
                isArray: true,
                transformResponse: function(data) {
                    return angular.fromJson(data).data;
                }
            }
        });
    });