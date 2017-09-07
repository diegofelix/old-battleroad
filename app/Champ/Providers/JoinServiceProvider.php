<?php namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;

class JoinServiceProvider extends ServiceProvider
{
    /**
     * Register the Join providers.
     */
    public function register()
    {
        $this->app->bind('Champ\Join\Repositories\JoinRepositoryInterface', 'Champ\Join\Repositories\JoinRepository');
        $this->app->bind('Champ\Join\Repositories\WaitingListRepositoryInterface', 'Champ\Join\Repositories\WaitingListRepository');
    }
}
