<?php

namespace unit\Listeners;

use App\Listeners\TodoCacheCleanerListener;
use Mockery;

class TodoCacheCleanerListenerTest extends \TestCase
{
    /** @test */
    function it_triggers_when_event_is_fired()
    {
        $cache = Mockery::mock('Illuminate\Cache\Repository');
        $cache->shouldReceive('forget')
            ->once();

        $listener = new TodoCacheCleanerListener($cache);

        \App::instance('App\Listeners\TodoCacheCleanerListener', $listener);

        \Event::fire("App.Todos.Events.TodoTaskCreated", "lorem");
    }
} 