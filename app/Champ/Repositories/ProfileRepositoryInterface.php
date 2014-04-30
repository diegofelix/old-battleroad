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

}