<?php namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;

class EventingServiceProvider extends ServiceProvider {

    /**
     * Register the Account providers
     *
     * @return void
     */
    public function register()
    {
        $listeners = $this->app['config']->get('champ.listeners');

        foreach ($listeners as $listener)
        {
            $this->app['events']->listen('Champ.*', $listener);
        }

        $this->app['events']->listen('championship.finished', 'Champ\Listeners\AdminNotificationListener');
    }
}