<?php namespace Champ\Repositories;

use Champ\Repositories\Core\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface {

    /**
     * Return a user by the email
     *
     * @param  string $email
     * @return Champ\Account\User
     */
    public function getByEmail($email);

    /**
     * Create a user with the social data
     *
     * @param array $data
     * @return Model
     */
    public function createBySocialAuth(array $data);

    /**
     * Overrided method to add a default picture to a user in registration
     *
     * @param  array  $data
     * @return Model
     */
    public function create(array $data);

    /**
     * Get the user and profile by id
     *
     * @param int $id
     * @return Champ\Account\User
     */
    public function getById($id);

}