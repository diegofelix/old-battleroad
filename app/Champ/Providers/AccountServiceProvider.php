<?php namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider {

	/**
	 * Register the binding
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('Champ\Account\UserEntityInterface', 'Champ\Account\UserEntity');
		$this->app->bind('Champ\Account\UserRepositoryInterface', 'Champ\Account\UserRepository');
	}
}