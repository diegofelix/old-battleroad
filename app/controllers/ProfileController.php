<?php

use Champ\Account\UserRepositoryInterface;
use Champ\Account\ProfileValidator;

class ProfileController extends BaseController {

	/**
	 * User Repository
	 *
	 * @var Champ\Account\UserRepositoryInterface
	 */
	protected $userRepo;

	/**
	 * Profile Validator
	 *
	 * @var Champ\Account\ProfileValidator
	 */
	protected $validator;

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
		// if the user already have a profile, there is no need to
		// create a profile.
		if (Auth::user()->profile) return $this->redirectRoute('profile.index');

		return $this->view('profile.create');
	}

	public function store()
	{
		if ( ! $this->userRepo->saveProfile(Auth::user()->id, Input::all())) {
			return $this->redirectBack(['error' => $this->userRepo->getErrors()]);
		}

		dd('You passed sr!');
	}

}