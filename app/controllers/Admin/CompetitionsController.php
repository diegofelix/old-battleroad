<?php namespace Admin;

use Input;
use BaseController;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;
use Champ\Championship\Repositories\GameRepositoryInterface;
use Champ\Championship\Repositories\FormatRepositoryInterface;
use Champ\Championship\Repositories\PlatformRepositoryInterface;

class CompetitionsController extends BaseController
{
    /**
     * Championship Repository
     *
     * @var Champ\Championship\Repositories\ChampionshipRepositoryInterface
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
        $championship = $this->champRepo->find($champId, ['competitions']);

        return $this->view('admin.championships.games.index', compact('championship'));
    }

    /**
     * Show all details for the competition
     *
     * @param  int $champId
     * @param  int $competitionId
     * @return Response
     */
    public function show($champId, $competitionId)
    {
        // I need to improve this code
        $championship = $this->champRepo->find($champId, ['competitions.items.join.user']);

        $competition = $championship->competitions->find($competitionId);

        return $this->view('admin.championships.games.show', compact('championship', 'competition'));
    }
}
