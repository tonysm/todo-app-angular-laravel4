<?php

namespace App\Listeners;

use Illuminate\Cache\Repository;

class TasksCacheCleanerListener
{
    /**
     * @var Repository
     */
    private $cache;

    /**
     * @param Repository $cache
     */
    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * clears cache when triggered
     */
    public function clear()
    {
        $this->cache->forget("tasks_task_cache");
    }
}
