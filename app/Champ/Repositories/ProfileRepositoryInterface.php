<?php namespace Champ\Repositories;

use Champ\Repositories\Core\RepositoryInterface;

interface ProfileRepositoryInterface extends RepositoryInterface {

    /**
     * Get the user and your profile searching by the user id
     *
     * @param  int $userId
     * @return Model
     */
    public function getFirstByUserId($userId);

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