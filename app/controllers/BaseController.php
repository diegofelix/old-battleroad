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
	 * Return an view
	 *
	 * @param  string $view
	 * @param  array  $params
	 * @return Response
	 */
	public function view($view, array $params = array())
	{
		return View::make($view, $params);
	}

	/**
	 * Redirect the user to an url
	 *
	 * @param  string $url
	 * @return Response
	 */
	protected function redirectTo($url, $with = array())
	{
		return Redirect::to($url)->with($with);
	}

	/**
	 * Redirect the user back with an message
	 *
	 * @param  array  $with
	 * @return Response
	 */
	public function redirectBack(array $with = null)
	{
		return Redirect::back()->withInput()->with($with);
	}

	/**
	 * Redirect the user to the intended page before login or to a default
	 * page in case has no one url
	 *
	 * @param  string $fallback
	 * @return Response
	 */
	public function redirectIntended($fallback = '/')
	{
		return Redirect::intended($fallback);
	}

}