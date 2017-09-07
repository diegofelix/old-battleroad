<?php

namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;

class NotificationsServiceProvider extends ServiceProvider
{
    /**
     * Register the Billing providers.
     */
    public function register()
    {
        $this->app->bind('Champ\Notifications\ChampionshipPublished', 'Champ\Notifications\Mailchimp\ChampionshipPublished');
    }
}
