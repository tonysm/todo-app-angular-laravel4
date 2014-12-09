<?php

namespace App\Listeners;

use Illuminate\Cache\CacheManager;

class TodoCacheCleanerListener
{
    /**
     * @var \Illuminate\Cache\CacheManager
     */
    private $cacheManager;

    /**
     * @param CacheManager $cacheManager
     */
    function __construct(CacheManager $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }

    public function clear($event)
    {
        $this->cacheManager->forget("todos_task_cache");
    }
} 