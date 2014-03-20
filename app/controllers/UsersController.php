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

    /**
     * Show the user profile
     *
     * @return Response
     */
    public function profile()
    {
        $user = $this->user->getById(Auth::user()->id);

        return $this->view('users.profile', compact('user'));
    }

}