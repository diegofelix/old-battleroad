<?php namespace Champ\Account;

use Champ\Core\Repository\RepositoryInterface;

interface ProfileRepositoryInterface extends RepositoryInterface {

    public function getFirstByUserId($userId);

}