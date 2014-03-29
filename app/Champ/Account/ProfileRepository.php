<?php namespace Champ\Account;

use Champ\Core\Repository\AbstractRepository;

class ProfileRepository extends AbstractRepository implements ProfileRepositoryInterface {

    /**
     * inject the model and validator into constructor
     *
     * @param Profile $model
     * @param ProfileValidator $validator
     */
    public function __construct(Profile $model, ProfileValidator $validator)
    {
        $this->model = $model;
        $this->validator = $validator;
    }

    /**
     * Get the user and your profile searching by the user id
     *
     * @param  int $userId
     * @return Model
     */
    public function getFirstByUserId($userId)
    {
        return $this->getFirstBy('user_id', $userId, ['user']);
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