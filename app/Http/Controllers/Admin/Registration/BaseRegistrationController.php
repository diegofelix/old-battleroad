<?php
namespace Battleroad\Http\Controllers\Admin\Registration;

use Laracasts\Commander\CommanderTrait;
use Battleroad\Http\Controllers\BaseController;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;

abstract class BaseRegistrationController extends BaseController
{
    use CommanderTrait;

    /**
     * Championship Repository.
     *
     * @var ChampionshipRepositoryInterface
     */
    protected $championshipRepository;

    public function __construct(ChampionshipRepositoryInterface $championshipRepository)
    {
        $this->championshipRepository = $championshipRepository;
    }
}
