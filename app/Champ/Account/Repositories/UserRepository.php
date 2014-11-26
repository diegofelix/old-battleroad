<?php namespace Champ\Account\Repositories;

use App;
use Champ\Repositories\Core\AbstractRepository;
use Champ\Account\User;
use Champ\Account\Profile;
use Champ\Validators\UserValidator;

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
     * @param  array  $dataedit
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

    /**
     * Create a profile for the user
     *
     * @param  array $data
     * @return mixed
     */
    public function createProfile($id, array $data)
    {
        // get a user
        $user = $this->find($id, ['profile']);

        // create a profile
        $profile = new Profile($data);

        // link a profile with a user
        return $user->profile()->save($profile);
    }

    /**
     * Update a profile for the user
     *
     * @param  int $id
     * @param  array  $data
     * @return mixed
     */
    public function updateProfile($id, array $data)
    {
        // get a user
        $user = $this->find($id, ['profile']);

        // add a notify false if was not passed.
        if ( ! isset($data['notify'])) $data['notify'] = false;

        // update your profile
        return $user->profile->fill($data)->save();
    }

    /**
     * Get a profile by a username
     *
     * @param  int $username
     * @return Profile
     */
    public function getProfile($username)
    {
        return $this->getFirstBy('username', $username, ['profile']);
    }
}