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