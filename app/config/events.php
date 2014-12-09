<?php

return [
    'App.Todos.Events.TodoTaskDeleted' => 'App\\Listeners\\TodoCacheCleanerListener@clear',
    'App.Todos.Events.TodoTaskCreated' => 'App\\Listeners\\TodoCacheCleanerListener@clear'
];