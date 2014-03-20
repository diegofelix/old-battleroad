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

    /**
     * Get the user and profile by id
     *
     * @param int $id
     * @return Champ\Account\User
     */
    public function getById($id);

}