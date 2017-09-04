<?php
namespace Battleroad\Http\Controllers;

class SessionController extends BaseController {

	/**
	 * Show the login page
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->view('session.create');
	}

	/**
	 * Do the login
	 *
	 * @return Response
	 */
	public function store()
	{
		$credentials = Input::only(['email', 'password']);

		if ( ! Auth::attempt($credentials, Input::get('remember'))) {
			return $this->redirectBack(['error' => 'E-mail ou senha inválidos.']);
		}

		return $this->redirectIntended('/');
	}

	/**
	 * Logout the user and redirect him to home
	 *
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();
		return $this->redirectTo('/');
	}

}