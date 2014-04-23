<?php namespace Admin;

use Input;
use BaseController;
use Champ\Repositories\ChampionshipRepositoryInterface;

class ChampGamesController extends BaseController
{

    /**
     * Championship Repository
     *
     * @var Champ\Championship\ChampionshipRepositoryInterface
     */
    protected $champRepo;

    public function __construct(ChampionshipRepositoryInterface $champRepo)
    {
        $this->champRepo = $champRepo;
    }

    /**
     * Show a list of Games for the championship given
     *
     * @param integer $champId
     * @return Response
     */
    public function index($champId)
    {
        $championship = $this->champRepo->find($champId);

        return $this->view('admin.championships.games.index', compact('championship'));
    }
}