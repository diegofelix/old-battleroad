<?php namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;
use Champ\Validation\ChampValidator;

class ValidationServiceProvider extends ServiceProvider {

    /**
     * Register the Validators providers
     *
     * @return void
     */
    public function boot()
    {
        $this->app->validator->resolver(function($translator, $data, $rules, $messages)
        {
            return new ChampValidator($translator, $data, $rules, $messages);
        });
    }
    public function register(){}
}