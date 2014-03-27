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
    public function createBySocialAuth(array $data)
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
        return $this->getFirstBy('user_id', $id);
    }

    /**
     * Save a profile for a user
     *
     * @param int $userId
     * @param array $data
     * @return mixed
     */
    public function saveProfile($userId, $data)
    {
        if ( ! $this->validator->passes($data, 'createProfile')) {
            $this->errors = $this->validator->errors();
            return false;
        }

        return $this->model->find($userId)->profile()->create(array_except($data, '_token'));
    }

}