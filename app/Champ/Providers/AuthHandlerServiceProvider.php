<?php namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;
use Event;

class AuthHandlerServiceProvider extends ServiceProvider {

    /**
     * Register the Account providers
     *
     * @return void
     */
    public function register()
    {
        Event::listen('auth.login', 'Champ\Events\AuthHandler');
    }
}