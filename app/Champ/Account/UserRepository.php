<?php namespace Champ\Account;

use Champ\Core\Repository\AbstractRepository;
use Champ\Account\User;

class UserRepository extends AbstractRepository implements UserRepositoryInterface {

    /**
     * User model
     *
     * @var Champ\Account\User
     */
    protected $model;

    /**
     * Constructor
     *
     * @param Champ\Account\User $userModel
     */
    public function __construct(User $userModel)
    {
        $this->model = $userModel;
    }

    /**
     * Return a user by the email
     *
     * @param  string $email
     * @return Champ\Account\User
     */
    public function getByEmail($email)
    {
        return $this->model->whereEmail($email)->first();
    }

}