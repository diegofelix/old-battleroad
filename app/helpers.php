<?php

if ( ! function_exists('usernameFromEmail')) {
	/**
	 * Get a username from a e-mail address given
	 *
	 * @param string $email
	 * @return string username
	 */
	function usernameFromEmail($email)
	{
		$username = explode('@', $email);

		return $username[0];
	}
}

if ( ! function_exists('champ_action_links')) {

	/**
	 * Generate a menu based on segment and classify what menu is active
	 *
	 * @param  string $name
	 * @param  string $segment
	 * @param  string $route
	 * @param  int $id
	 * @param  string $icon
	 * @return string
	 */
	function champ_action_links($name, $segment, $route, $id, $icon)
	{
		$class = '';
		if (Request::segment(4) == $segment)
		{
			$class = 'active';
		}

		return '<li class="'. $class .'"><a href="'. route($route, $id) .'"><i class="pull-right icon '. $icon .'"></i> '. $name .'</a></li>';
	}
}