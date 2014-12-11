<?php

namespace App\Listeners;

use Illuminate\Cache\Repository;

class TodoCacheCleanerListener
{
    /**
     * @var Repository
     */
    private $cache;

    /**
     * @param Repository $cache
     */
    function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param $event
     */
    public function clear($event)
    {
        $this->cache->forget("todos_task_cache");
    }
} 