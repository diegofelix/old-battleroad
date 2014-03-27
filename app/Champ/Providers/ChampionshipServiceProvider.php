<?php namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;

class ChampionshipServiceProvider extends ServiceProvider {

    /**
     * Register the Championship providers
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Champ\Championship\ChampionshipRepositoryInterface', 'Champ\Championship\ChampionshipRepository');
    }
}