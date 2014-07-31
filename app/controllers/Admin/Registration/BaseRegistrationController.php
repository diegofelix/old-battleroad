<?php namespace Admin\Registration;

use BaseController;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;
use Laracasts\Commander\CommanderTrait;

abstract class BaseRegistrationController extends BaseController {

    /**
     * Championship Repository
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