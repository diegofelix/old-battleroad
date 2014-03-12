<?php

class SessionController extends BaseController {
	
	public function __construct()
	{
		
	}

	/**
	 * Show the login page
	 * 
	 * @return Response
	 */
	public function create()
	{
		return $this->view('session.create');
	}

}