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
    protected $championshipRepository;

    public function __construct(Repository $championshipRepository)
    {
        $this->championshipRepository = $championshipRepository;
    }
}
