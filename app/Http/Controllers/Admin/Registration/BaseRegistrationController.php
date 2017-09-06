<?php
namespace Battleroad\Http\Controllers\Admin\Registration;

use Laracasts\Commander\CommanderTrait;
use Battleroad\Http\Controllers\BaseController;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;

abstract class BaseRegistrationController extends BaseController
{
    /**
     * Championship Repository.
     *
     * @var ChampionshipRepositoryInterface
     */
    protected $championshipRepository;

    use CommanderTrait;

    public function __construct(ChampionshipRepositoryInterface $championshipRepository)
    {
        $this->championshipRepository = $championshipRepository;
    }
}
