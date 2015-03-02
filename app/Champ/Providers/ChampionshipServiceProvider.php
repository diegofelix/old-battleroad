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
        $this->app->bind('Champ\Championship\Repositories\ChampionshipRepositoryInterface', 'Champ\Championship\Repositories\ChampionshipRepository');
        $this->app->bind('Champ\Championship\Repositories\CompetitionRepositoryInterface', 'Champ\Championship\Repositories\CompetitionRepository');
        $this->app->bind('Champ\Championship\Repositories\GameRepositoryInterface', 'Champ\Championship\Repositories\GameRepository');
        $this->app->bind('Champ\Championship\Repositories\FormatRepositoryInterface', 'Champ\Championship\Repositories\FormatRepository');
        $this->app->bind('Champ\Championship\Repositories\PlatformRepositoryInterface', 'Champ\Championship\Repositories\PlatformRepository');
        $this->app->bind('Champ\Championship\Repositories\CouponRepositoryInterface', 'Champ\Championship\Repositories\CouponRepository');
    }
}