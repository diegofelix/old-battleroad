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

	function champ_action_links($name, $route, $id, $icon)
	{
		$class = '';
		if (Route::currentRouteName() == $route)
		{
			$class = 'active';
		}

		return '<li class="'. $class .'"><a href="'. route($route, $id) .'"><i class="pull-right icon '. $icon .'"></i> '. $name .'</a></li>';
	}
}