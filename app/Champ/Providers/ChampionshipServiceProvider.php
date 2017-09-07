<?php namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;

class ChampionshipServiceProvider extends ServiceProvider
{
    /**
     * Register the Championship providers.
     */
    public function register()
    {
        $this->app->bind('Champ\Championship\Repositories\GameRepositoryInterface', 'Champ\Championship\Repositories\GameRepository');
        $this->app->bind('Champ\Championship\Repositories\PlatformRepositoryInterface', 'Champ\Championship\Repositories\PlatformRepository');
    }
}
