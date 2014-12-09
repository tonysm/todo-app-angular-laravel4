<?php

namespace App\Listeners;

class TodoCacheCleanerListener
{

    public function clear($event)
    {
        \Cache::forget("todos_task_cache");
    }
} 