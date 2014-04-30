<?php namespace Admin;

use Input;
use BaseController;
use Champ\Repositories\ChampionshipRepositoryInterface;
use Champ\Repositories\GameRepositoryInterface;

class CompetitionsController extends BaseController
{
    /**
     * Championship Repository
     *
     * @var Champ\Repositories\ChampionshipRepositoryInterface
     */
    protected $champRepo;

    /**
     * Game Repository
     *
     * @var Champ\Repositories\GameRepositoryInterface
     */
    protected $gameRepo;

    public function __construct(
        ChampionshipRepositoryInterface $champRepo,
        GameRepositoryInterface $gameRepo
    ) {
        $this->champRepo = $champRepo;
        $this->gameRepo = $gameRepo;
    }

    /**
     * Show a list of Games for the championship given
     *
     * @param integer $champId
     * @return Response
     */
    public function index($champId)
    {
        $championship = $this->champRepo->find($champId, ['competitions']);

        return $this->view('admin.championships.games.index', compact('championship'));
    }

    /**
     * Show a form to create a new competition
     *
     * @param  int $champId
     * @return Response
     */
    public function create($champId)
    {
        $championship = $this->champRepo->find($champId, ['competitions']);
        $games = $this->gameRepo->dropdown();
        return $this->view('admin.championships.games.create', compact('championship', 'games'));
    }
}