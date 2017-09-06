<?php namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;

class NewsletterListServiceProvider extends ServiceProvider
{
    /**
     * Register the Billing providers.
     */
    public function register()
    {
        $this->app->bind('Champ\Newsletters\NewsletterList', 'Champ\Newsletters\Mailchimp\NewsletterList');
        $this->app->bind('Champ\Newsletters\ChampionshipSegment', 'Champ\Newsletters\Mailchimp\ChampionshipSegment');
        $this->app->bind('Champ\Newsletters\CampaignMaker', 'Champ\Newsletters\Mailchimp\CampaignMaker');
    }
}
