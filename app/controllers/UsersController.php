<?php

use Champ\Account\UserEntityInterface;

class UsersController extends BaseController {

	/**
	 * User Entity
	 *
	 * @var Champ\Account\UserEntityInterface
	 */
	protected $user;

	public function __construct(UserEntityInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Show the user profile
     *
     * @return Response
     */
    public function profile()
    {
        return $this->view('users.profile');
    }

}