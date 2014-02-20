<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Redirect the user to an url
	 *
	 * @param  string $url
	 * @return Response
	 */
	protected function redirectTo($url)
	{
		return Redirect::to($url);
	}

}