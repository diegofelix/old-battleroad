<?php namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;

class SubscriptionServiceProvider extends ServiceProvider {

    /**
     * Register the Subscription providers
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Champ\Subscription\Repositories\SubscriptionRepositoryInterface', 'Champ\Subscription\Repositories\SubscriptionRepository');
        $this->app->bind('Champ\Subscription\Repositories\ItemRepositoryInterface', 'Champ\Subscription\Repositories\ItemRepository');
    }
}