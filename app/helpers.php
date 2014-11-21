<?php

if ( ! function_exists('usernameFromEmail'))
{
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

if ( ! function_exists('champ_action_links'))
{
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

if ( ! function_exists('icon_route'))
{
	/**
	 * Generate an html link with an icon inside
	 *
	 * @param  string $route
	 * @param  string $name
	 * @param  string $icon
	 * @param  mixed $params
	 * @return strgin
	 */
	function icon_route($route, $name, $icon, $params = null)
	{
		return '<a href="' . route($route, $params) . '">' . '<i class="fa fa-' . $icon . '"> </i> ' . $name . '</a>';
	}
}
if ( ! function_exists('icon_link'))
{
	/**
	 * Generate an html link with an icon inside
	 *
	 * @param  string $link
	 * @param  string $name
	 * @param  string $icon
	 * @param  mixed $params
	 * @return strgin
	 */
	function icon_link($link, $name, $icon, $params = null)
	{
		return '<a href="' . $link . '">' . '<i class="fa fa-' . $icon . '"> </i> ' . $name . '</a>';
	}
}

if ( ! function_exists('apply_rate'))
{
	/**
	 * Apply a rate to a price.
	 *
	 * The calcule is a follow:
	 * If the user input 20, what the number that, applying our 10% ( for example ) rate, results in 20?
	 * In this case is 22,22.
	 *
	 * @param  int $price
	 * @param  float $rate
	 * @return float
	 */
	function apply_rate($price, $rate)
	{
		return ($price / (100 - $rate)) * 100;
	}
}