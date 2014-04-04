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
		$this->app->bind('Champ\Repositories\ProfileRepositoryInterface', 'Champ\Repositories\Eloquent\ProfileRepository');
		$this->app->bind('Champ\Repositories\UserRepositoryInterface', 'Champ\Repositories\Eloquent\UserRepository');
	}
}