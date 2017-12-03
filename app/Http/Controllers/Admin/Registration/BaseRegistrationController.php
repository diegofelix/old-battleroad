<?php

namespace Battleroad\Http\Controllers\Admin\Registration;

use Laracasts\Commander\CommanderTrait;
use Battleroad\Http\Controllers\BaseController;
use Champ\Championship\Repository;

abstract class BaseRegistrationController extends BaseController
{
    use CommanderTrait;

    /**
     * Championship Repository.
     *
     * @var Repository
     */
    protected $repository;

    /**
     * Class constructor.
     *
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }
}
