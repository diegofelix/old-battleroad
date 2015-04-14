<?php namespace Champ\Account\Repositories;

use Champ\Account\User;
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

    /**
     * Create a profile for the user
     *
     * @param  array $data
     * @return mixed
     */
    public function createProfile($username, array $data);

    /**
     * Update a profile for the user
     *
     * @param  int $id
     * @param  array  $data
     * @return mixed
     */
    public function updateProfile($id, array $data);

    /**
     * Get a profile by a username
     *
     * @param  int $username
     * @return Profile
     */
    public function getProfile($username);

    /**
     * Save a user
     *
     * @param  User   $user
     * @return boolean
     */
    public function save(User $user);

}