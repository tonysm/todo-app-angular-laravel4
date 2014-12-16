<?php

return [
    'App.Tasks.Events.TaskDeleted' => 'App\\Listeners\\TasksCacheCleanerListener@clear',
    'App.Tasks.Events.TaskCreated' => 'App\\Listeners\\TasksCacheCleanerListener@clear'
];