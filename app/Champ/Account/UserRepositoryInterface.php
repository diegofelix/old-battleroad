<?php namespace Champ\Account;

use Champ\Core\Repository\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface {

    /**
     * Return a user by the email
     *
     * @param  string $email
     * @return Champ\Account\User
     */
    public function getByEmail($email);

}