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
        $this->app->bind('Champ\Repositories\ChampionshipRepositoryInterface', 'Champ\Repositories\Eloquent\ChampionshipRepository');
        $this->app->bind('Champ\Repositories\CompetitionRepositoryInterface', 'Champ\Repositories\Eloquent\CompetitionRepository');
        $this->app->bind('Champ\Repositories\GameRepositoryInterface', 'Champ\Repositories\Eloquent\GameRepository');
    }
}