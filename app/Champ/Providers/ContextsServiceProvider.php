<?php namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;

class ContextsServiceProvider extends ServiceProvider {

    /**
     * Register the Contexts providers
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Champ\Contexts\Core\ContextInterface', 'Champ\Contexts\UserContext');
/*
        $this->app['context'] = $this->app->share(function($app)
        {
            return new \Champ\Contexts\UserContext;
        });

        $this->app->bind('Champ\Contexts\Core\ContextInterface', function($app)
        {
            return $app['context'];
        });*/
    }
}