angular.module("todoApp").controller("TodosController", function($scope, Todo) {
    $scope.newTodo = "";
    $scope.todos = [];
    $scope.completedTodos = [];

    Todo.query(function(data){
        $scope.todos = data;
    });

    $scope.addTodo = function(newTodo) {
        Todo.save({name: newTodo}, function(todo) {
            $scope.todos.unshift(todo);
            $scope.newTodo = "";
        });
    };

    $scope.deleteTodo = function(todo){
        Todo.delete(todo, function(todo) {
            for (var i = 0; i < $scope.todos.length; i++)
            {
                if ($scope.todos[i].id == todo.id)
                {
                    $scope.todos.splice(i, 1);
                    $scope.completedTodos.push(todo);
                    break;
                }
            }
        });
    };

    $scope.hasCompletedTodos = function() {
        return $scope.completedTodos.length > 0;
    };

    $scope.hasTodos = function(){
        return $scope.todos.length > 0;
    };
});