<?php namespace Champ\Providers;

use Illuminate\Support\ServiceProvider;
use Champ\Account\UserEntity;
use Champ\Account\UserValidator;

class EntityServiceProvider extends ServiceProvider {

  /**
   * Register the binding
   *
   * @return void
   */
  public function register()
  {
    /**
     * User Entity
     */
    $this->app->bind('Champ\Account\UserEntityInterface', function($app)
    {
      return new UserEntity(
          $app->make('Champ\Account\UserRepository'),
          new UserValidator
        );
    });
  }

}