<?php namespace Champ\Repositories;

use Champ\Repositories\Core\RepositoryInterface;

interface ProfileRepositoryInterface extends RepositoryInterface {

    public function getFirstByUserId($userId);

}