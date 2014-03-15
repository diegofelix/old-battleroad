<?php namespace Champ\Account;

use Champ\Core\Entity\EntityInterface;

interface UserEntityInterface {

	/**
	 * Create the user using the data from the Social Auth
	 * 
	 * @param array
	 * @return Champ\Account\User
	 */
	public functin createBySocialAuth($data);

}