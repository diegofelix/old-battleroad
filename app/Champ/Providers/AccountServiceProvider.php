<?php namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Register the Account providers.
     */
    public function register()
    {
        $this->app->bind('Champ\Account\Repositories\UserRepositoryInterface', 'Champ\Account\Repositories\UserRepository');
    }
}
