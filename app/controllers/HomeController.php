<?php

class HomeController extends BaseController {

	/**
	 * Show the home to the user
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->view('home.index');
	}

}