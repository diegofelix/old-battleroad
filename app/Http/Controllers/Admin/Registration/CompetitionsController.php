<?php

namespace Battleroad\Http\Controllers\Admin\Registration;

use Champ\Championship\Repository;
use Input;

class CompetitionsController extends BaseRegistrationController
{
    /**
     * Championship Repository.
     *
     * @var Champ\Championship\Repositories\ChampionshipRepository
     */
    protected $championships;

    /**
     * Game Repository.
     *
     * @var Champ\Championship\Repositories\GameRepository
     */
    protected $gameRepo;

    public function __construct(Repository $championshipRepository)
    {
        $this->championships = $championshipRepository;
    }

    /**
     * Show a list of Games for the championship given.
     *
     * @param int $champId
     *
     * @return Response
     */
    public function index($champId)
    {
        $championship = $this->championships->find($champId, ['competitions']);
        $games = $this->championships->getGamesDropdown();
        $formats = $this->championships->getFormatsDropdown();
        $platforms = $this->championships->getPlatformsDropdown();

        return $this->view('admin.register.games.index', compact('championship', 'games', 'formats', 'platforms'));
    }

    /**
     * Show a form to create a new competition.
     *
     * @param int $champId
     *
     * @return Response
     */
    public function create($champId)
    {
        $championship = $this->championships->find($champId, ['competitions']);
        $games = $this->gameRepo->dropdown();
        $formats = $this->formatRepo->dropdown();
        $platforms = $this->platformRepo->dropdown();

        return $this->view('admin.register.games.create', compact('championship', 'games', 'formats', 'platforms'));
    }

    /**
     * Attach a game to a competition.
     *
     * @param int $champId
     *
     * @return Response
     */
    public function store($champId)
    {
        // get the necessary inputs
        $input = Input::only('game_id', 'platform_id', 'format_id', 'players', 'price', 'start');

        // if the user setted a competition limit
        if (!Input::get('limit_switch') && Input::get('limit')) {
            $input['limit'] = Input::get('limit');
        }

        // create the championship
        if (!$this->championships->createCompetition($champId, $input)) {
            return $this->redirectBack(['error' => $this->championships->getErrors()]);
        }

        // redirect back
        return $this->redirectRoute('admin.register.games', [$champId]);
    }

    public function destroy($champId, $competitionId)
    {
        $championship = $this->championships->find($champId);
        $competition = $championship->competitions->find($competitionId);

        $competition->delete();

        // redirect back
        return $this->redirectRoute('admin.register.games', [$champId]);
    }
}
