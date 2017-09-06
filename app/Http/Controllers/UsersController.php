<?php
namespace Battleroad\Http\Controllers;

use Champ\Account\Repositories\UserRepositoryInterface;

class UsersController extends BaseController
{
    /**
     * User Entity.
     *
     * @var Champ\Account\Repositories\UserRepositoryInterface
     */
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }
}
