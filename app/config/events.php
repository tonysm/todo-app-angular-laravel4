<?php

return [
    'App.Todos.TodoTaskDeleted' => 'App\\Listeners\\TodoCacheCleanerListener@clear',
    'App.Todos.TodoTaskCreated' => 'App\\Listeners\\TodoCacheCleanerListener@clear'
];