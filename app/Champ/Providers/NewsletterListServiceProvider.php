<?php namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;

class NewsletterListServiceProvider extends ServiceProvider {

    /**
     * Register the Billing providers
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Champ\Newsletters\NewsletterList', 'Champ\Newsletters\Mailchimp\NewsletterList');
    }
}