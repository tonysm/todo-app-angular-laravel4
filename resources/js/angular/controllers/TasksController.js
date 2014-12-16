angular
    .module("todoApp")
    .controller("TasksController", function($scope, Task) {
        $scope.newTask = "";
        $scope.tasks = [];
        $scope.completedTasks = [];

        Task.query(function(data) {
            $scope.tasks = data;
        });

        $scope.addTask = function() {
            if ( ! $scope.addTaskForm.$valid)
                return;

            Task.save({name: $scope.newTask}, function(task) {
                $scope.tasks.unshift(task);
                $scope.newTask = "";
                $scope.addTaskForm.$setPristine();
            });
        };

        $scope.deleteTask = function(task){
            Task.delete(task, function(task) {
                for (var i = 0; i < $scope.tasks.length; i++)
                {
                    if ($scope.tasks[i].id == task.id)
                    {
                        $scope.tasks.splice(i, 1);
                        $scope.completedTasks.push(task);
                        break;
                    }
                }
            });
        };

        $scope.hasCompletedTasks = function() {
            return $scope.completedTasks.length > 0;
        };

        $scope.hasTasks = function(){
            return $scope.tasks.length > 0;
        };
    });