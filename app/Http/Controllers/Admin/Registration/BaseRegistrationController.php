<?php
namespace Battleroad\Http\Controllers\Admin\Registration;

use Laracasts\Commander\CommanderTrait;
use Battleroad\Http\Controllers\BaseController;
use Champ\Championship\Repositories\ChampionshipRepository;

abstract class BaseRegistrationController extends BaseController
{
    use CommanderTrait;

    /**
     * Championship Repository.
     *
     * @var ChampionshipRepository
     */
    protected $championshipRepository;

    public function __construct(ChampionshipRepository $championshipRepository)
    {
        $this->championshipRepository = $championshipRepository;
    }
}
