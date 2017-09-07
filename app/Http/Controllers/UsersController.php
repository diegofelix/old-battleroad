<?php

namespace Battleroad\Http\Controllers;

use Champ\Account\Repositories\UserRepository;

class UsersController extends BaseController
{
    /**
     * User Entity.
     *
     * @var Champ\Account\Repositories\UserRepository
     */
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
}
