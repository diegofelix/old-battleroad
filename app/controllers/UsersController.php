<?php

use Champ\Repositories\UserRepositoryInterface;

class UsersController extends BaseController {

	/**
	 * User Entity
	 *
	 * @var Champ\Repositories\UserRepositoryInterface
	 */
	protected $user;

	public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

}