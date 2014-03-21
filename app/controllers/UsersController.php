<?php

use Champ\Account\UserRepositoryInterface;

class UsersController extends BaseController {

	/**
	 * User Entity
	 *
	 * @var Champ\Account\UserRepositoryInterface
	 */
	protected $user;

	public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

}