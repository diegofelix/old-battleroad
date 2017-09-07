<?php namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;

class BillingServiceProvider extends ServiceProvider
{
    /**
     * Register the Billing providers.
     */
    public function register()
    {
        $this->app->bind('Champ\Billing\Contracts\TransactionService', 'Champ\Billing\Bcash\BcashTransaction');
        $this->app->bind('Champ\Billing\Contracts\TransactionDataFormatter', 'Champ\Billing\Bcash\BcashDataFormatter');
    }
}
