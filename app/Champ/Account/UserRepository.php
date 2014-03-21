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
     * User Validator
     *
     * @var Champ\Services\Validation\User\UserValidator;
     */
    protected $validator;

    /**
     * Constructor
     *
     * @param Champ\Account\User $userModel
     * @param Champ\Account\UserValidator $validator
     * @return void
     */
    public function __construct(User $userModel, UserValidator $validator)
    {
        $this->model = $userModel;
        $this->validator = $validator;
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

    /**
     * Create a user with the social data
     *
     * @param array $data
     * @return Model
     */
    public function createBySocialAuth($data)
    {
        return $this->model->create($data);
    }

    /**
     * Get the user and profile by id
     *
     * @param int $id
     * @return Champ\Account\User
     */
    public function getById($id)
    {
        return $this->model->with('profile')->find($id);
    }

}