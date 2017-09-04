<?php
namespace Battleroad\Http\Controllers\Admin;

use BaseController;
use Champ\Championship\Repositories\CompetitionRepositoryInterface;
use Champ\Championship\Repositories\FormatRepositoryInterface;
use Champ\Championship\Repositories\GameRepositoryInterface;
use Champ\Championship\Repositories\PlatformRepositoryInterface;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Input;

class CompetitionsController extends BaseController
{

    /**
     * Competition Repository
     *
     * @var Champ\Championship\Repositories\CompetitionRepositoryInterface
     */
    protected $competitionRepository;

    /**
     * Join Repository
     *
     * @var Champ\Join\Repositories\JoinRepositoryInterface
     */
    protected $joinRepository;

    public function __construct(
        CompetitionRepositoryInterface $competitionRepository,
        JoinRepositoryInterface $joinRepository
    )
    {
        $this->competitionRepository = $competitionRepository;
        $this->joinRepository = $joinRepository;
    }

    /**
     * Show a list of Games for the championship given
     *
     * @param integer $champId
     * @return Response
     */
    public function index($champId)
    {
        $competitions = $this->competitionRepository->getByChampionship($champId);

        return $this->view('admin.championships.games.index', compact('competitions'));
    }

    /**
     * Show all details for the competition
     *
     * @param  int $champId
     * @param  int $competitionId
     * @return Illuminate\Http\Response
     */
    public function show($champId, $competitionId)
    {
        $competition    = $this->competitionRepository->find($competitionId);
        $joins          = $this->joinRepository->getByCompetition($competitionId, ['user']);

        return $this->view('admin.championships.games.show', compact('competition', 'joins'));
    }
}
