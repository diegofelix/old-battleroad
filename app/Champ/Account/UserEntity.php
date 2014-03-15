<?php namespace Champ\Account;

use Champ\Core\Entity\AbstractEntity;
use Champ\Account\UserRepositoryInterface;
use Champ\Account\UserValidator;

class UserEntity extends AbstractEntity implements UserEntityInterface {

    /**
     * User Repository
     *
     * @var Champ\Account\UserRepositoryInterface;
     */
    protected $repository;

    /**
     * User Validator
     *
     * @var Champ\Services\Validation\User\UserValidator;
     */
    protected $validator;

    /**
     * @var Illuminate\Support\MessageBag
     */
    protected $errors;

    /**
     * Construct
     *
     * @param UserRepositoryInterface $userRepository
     * @param UserValidator           $validator
     */
    public function __construct(UserRepositoryInterface $userRepository, UserValidator $validator)
    {
        $this->repository = $userRepository;
        $this->validator = $validator;
    }

    /**
     * Create the user using the data from the Social Auth
     * 
     * @param array
     * @return Champ\Account\User
     */
    public functin createBySocialAuth($data)
    {
        return $this->repository->create($data);
    }

}