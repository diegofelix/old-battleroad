<?php namespace Champ\Account\Repositories;

use App;
use Champ\Repositories\Core\AbstractRepository;
use Champ\Account\User;
use Champ\Account\Profile;
use Champ\Validators\UserValidator;
use Hash;

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
        return $this->registerUser($data);
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
        if (empty($data['picture']))
        {
            $data['picture'] = $this->defaultPicture;
        }

        if ( ! $this->validator->passes($data))
        {
            $this->errors = $this->validator->errors();
            return false;
        }

        $data['password'] = Hash::make($data['password']);

        return $this->registerUser($data);
    }

    /**
     * Register a user
     *
     * @param  array $data
     * @return mixed
     */
    protected function registerUser($data)
    {
        $user = $this->model->register($data);

        $user->save();

        return $user;
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
        $profile = Profile::createProfile($data);

        // link a profile with a user
        $user->profile()->save($profile);

        return $profile;
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

        $profile = $user->profile->updateProfile($data);

        $profile->save();

        return $profile;

        // add a notify false if was not passed.
        // if ( ! isset($data['notify'])) $data['notify'] = false;

        // update your profile
        // return $user->profile->fill($data)->save();
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

    /**
     * Save a user
     *
     * @param  User   $user
     * @return boolean
     */
    public function save(User $user)
    {
        return $user->save();
    }
}