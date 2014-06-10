<?php namespace Admin;

use Input;
use BaseController;
use Champ\Repositories\ChampionshipRepositoryInterface;
use Champ\Repositories\GameRepositoryInterface;
use Champ\Repositories\FormatRepositoryInterface;
use Champ\Repositories\PlatformRepositoryInterface;
use Champ\Championship\Competition;

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
        GameRepositoryInterface $gameRepo,
        FormatRepositoryInterface $formatRepo,
        PlatformRepositoryInterface $platformRepo
    ) {
        $this->champRepo = $champRepo;
        $this->gameRepo = $gameRepo;
        $this->formatRepo = $formatRepo;
        $this->platformRepo = $platformRepo;
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
        $formats = $this->formatRepo->dropdown();
        $platforms = $this->platformRepo->dropdown();
        return $this->view('admin.championships.games.create', compact('championship', 'games', 'formats', 'platforms'));
    }

    /**
     * Attach a game to a competition
     * @param  int $champId
     * @return Response
     */
    public function store($champId)
    {
        // get the necessary inputs
        $input = Input::only('game_id', 'platform_id', 'format_id', 'price', 'start');

        // if the user setted a competition limit
        if ( ! Input::get('limit_switch') && Input::get('limit'))
        {
            $input['limit'] = Input::get('limit');
        }

        // get the championship
        $championship = $this->champRepo->find($champId, ['competitions']);

        // create a new Competition
        $competition = new Competition($input);

        // attach the competition to the championship
        $championship->competitions()->save($competition);

        // redirect back
        return \Redirect::route('admin.championships.games.index', [$champId]);

    }

    public function show($champId, $competitionId)
    {
        $championship = $this->champRepo->getCompetition($champId, $competitionId);
        $competition = $championship->competitions->first();

        $games = $this->gameRepo->dropdown();
        $formats = $this->formatRepo->dropdown();
        $platforms = $this->platformRepo->dropdown();

        return $this->view('admin.championships.games.edit', compact('championship', 'competition', 'games', 'formats', 'platforms'));
    }

    public function destroy($champId, $competitionId)
    {
        $championship = $this->champRepo->getCompetition($champId, $competitionId);
        $competition = $championship->competitions->first();

        $competition->delete();

        // redirect back
        return \Redirect::route('admin.championships.games.index', [$champId]);
    }
}
