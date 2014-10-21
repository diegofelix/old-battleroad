<?php namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;

class BillingServiceProvider extends ServiceProvider {

    /**
     * Register the Billing providers
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Champ\Billing\Core\BillingInterface', 'Champ\Billing\Pagseguro\Pagseguro');
    }
}