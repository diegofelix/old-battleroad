<?php

use Champ\Account\UserRepositoryInterface;

class ProfileController extends BaseController {

	/**
	 * User Repository
	 * 
	 * @var Champ\Account\UserRepositoryInterface
	 */
	protected $userRepo;

	/**
	 * Inject the user Repository
	 * 
	 * @param Champ\Account\UserRepositoryInterface
	 * @return void
	 */
	public function __construct(UserRepositoryInterface $user)
	{
		$this->userRepo = $user;

		// only logged users can view the profile
		$this->beforeFilter('auth');
	}

	/**
	 * Show The User Profile
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = $this->userRepo->getById(Auth::user()->id);

		return $this->view('profile.index', compact('user'));
	}

	/**
	 * Show the create profile form
	 *
	 * @return Response
	 */
	public function create()
	{
		if (Auth::user()->profile) return App::abort('404');
		
		return $this->view('profile.create');
	}

}