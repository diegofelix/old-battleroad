<?php namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider {

	/**
	 * Register the Account providers
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('Champ\Account\ProfileRepositoryInterface', 'Champ\Account\ProfileRepository');
		$this->app->bind('Champ\Account\UserRepositoryInterface', 'Champ\Account\UserRepository');
	}
}