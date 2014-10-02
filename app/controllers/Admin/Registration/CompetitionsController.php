<?php namespace Admin\Registration;

use Input;
use BaseController;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;
use Champ\Championship\Repositories\GameRepositoryInterface;
use Champ\Championship\Repositories\FormatRepositoryInterface;
use Champ\Championship\Repositories\PlatformRepositoryInterface;

class CompetitionsController extends BaseRegistrationController
{
    /**
     * Championship Repository
     *
     * @var Champ\Championship\Repositories\ChampionshipRepositoryInterface
     */
    protected $champRepo;

    /**
     * Game Repository
     *
     * @var Champ\Championship\Repositories\GameRepositoryInterface
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
        $championship = $this->champRepo->find($champId, ['competitions']);
        $games = $this->gameRepo->dropdown();
        $formats = $this->formatRepo->dropdown();
        $platforms = $this->platformRepo->dropdown();

        return $this->view('admin.register.games.index', compact('championship', 'games', 'formats', 'platforms'));
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
        return $this->view('admin.register.games.create', compact('championship', 'games', 'formats', 'platforms'));
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

        // create the championship
        if ( ! $this->champRepo->createCompetition($champId, $input))
            return $this->redirectBack(['error' => $this->champRepo->getErrors()]);

        // redirect back
        return $this->redirectRoute('admin.register.games', [$champId]);

    }

    public function destroy($champId, $competitionId)
    {
        $championship = $this->champRepo->find($champId);
        $competition = $championship->competitions->find($competitionId);

        $competition->delete();

        // redirect back
        return $this->redirectRoute('admin.register.games', [$champId]);
    }
}
