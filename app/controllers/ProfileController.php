<?php

use Champ\Account\ProfileRepositoryInterface;

class ProfileController extends BaseController {

	/**
	 * Profile Repository
	 *
	 * @var Champ\Account\ProfileRepositoryInterface
	 */
	protected $profileRepo;

	public function __construct(ProfileRepositoryInterface $profile)
	{
		$this->profileRepo = $profile;
	}

	/**
	 * Show The User Profile
	 *
	 * @return Response
	 */
	public function index()
	{
		$profile = $this->profileRepo->getFirstByUserId(Auth::user()->id);

		return $this->view('profile.index', compact('profile'));
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

	/**
	 * Show the profile update form
	 *
	 * @return Response
	 */
	public function edit()
	{
		return $this->view('profile.edit', ['profile' => Auth::user()->profile]);
	}

	/**
	 * Updates the user profile
	 *
	 * @return Response
	 */
	public function update()
	{
		$id = Auth::user()->profile->id;

		if ( ! $this->profileRepo->update($id, Input::all())) {
			return $this->redirectBack(['error' => $this->userRepo->getErrors()]);
		}

		return $this->redirectRoute('profile.index')
			->with('message', 'Perfil Atualizado com sucesso!');
	}

	/**
	 * Create a profile to a user
	 *
	 * @return Reponse
	 */
	public function store()
	{
		if ( ! $this->profileRepo->createForUser(Auth::user()->id, Input::all())) {
			return $this->redirectBack(['error' => $this->profileRepo->getErrors()]);
		}

		return $this->redirectRoute('profile.index')
			->with('message', 'Perfil Criado com sucesso!');
	}

}