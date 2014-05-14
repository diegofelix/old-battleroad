<?php namespace Champ\Repositories\Eloquent;

use Champ\Repositories\Core\AbstractRepository;
use Champ\Account\User;
use Champ\Validators\UserValidator;
use Champ\Repositories\UserRepositoryInterface;

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
     * Default Image if user has no picture
     *
     * @var string
     */
    protected $defaultPicture = 'images/defaultUser.jpg';

    /**
     * Constructor
     *
     * @param Champ\Account\User $userModel
     * @param Champ\Validators\UserValidator $validator
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
     * Overrided method to add a default picture to a user in registration
     *
     * @param  array  $data
     * @return Model
     */
    public function create(array $data)
    {
        // attach a default image to the user
        if (empty($data['picture'])) {
            $data['picture'] = $this->defaultPicture;
        }

        // call the create of a abstract
        return parent::create($data);
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
}