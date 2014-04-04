<?php namespace Champ\Repositories\Eloquent;

use Champ\Repositories\Core\TenantRepository;
use Champ\Account\Profile;
use Champ\Validators\ProfileValidator;
use Champ\Repositories\ProfileRepositoryInterface;
use Champ\Contexts\Core\ContextInterface;

class ProfileRepository extends TenantRepository implements ProfileRepositoryInterface {

    /**
     * inject the model and validator into constructor
     *
     * @param Champ\Account\Profile $model
     * @param Champ\Validators\ProfileValidator $validator
     */
    public function __construct(Profile $model, ProfileValidator $validator, ContextInterface $context)
    {
        $this->model = $model;
        $this->validator = $validator;
        $this->context = $context;
    }

    /**
     * Get the user and your profile searching by the user id
     *
     * @param  int $userId
     * @return Model
     */
    public function getFirstByUserId($userId)
    {
        return $this->getFirst();
    }

    /**
     * Create a profile assigned to a user
     *
     * @param  int $userId
     * @param  array  $data
     * @return Model
     */
    public function createForUser($userId, $data = array())
    {
        $data['user_id'] = $userId;
        return $this->create($data);
    }

}