<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $events = \Config::get("events");

        foreach ($events as $event => $listeners) {
            foreach ((array) $listeners as $listener) {
                \Event::listen($event, $listener);
            }
        }
    }
}
