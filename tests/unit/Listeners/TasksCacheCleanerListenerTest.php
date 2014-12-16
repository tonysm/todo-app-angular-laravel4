<?php

namespace unit\Listeners;

use App\Listeners\TasksCacheCleanerListener;
use Mockery;

class TasksCacheCleanerListenerTest extends \TestCase
{
    /** @test */
    function it_triggers_when_event_is_fired()
    {
        $cache = Mockery::mock('Illuminate\Cache\Repository');
        $cache->shouldReceive('forget')
            ->once();

        $listener = new TasksCacheCleanerListener($cache);

        \App::instance('App\Listeners\TasksCacheCleanerListener', $listener);

        \Event::fire("App.Tasks.Events.TaskCreated", "lorem");
    }
} 