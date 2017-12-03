<?php

namespace Battleroad\Http\Controllers\Admin\Registration;

use Champ\Championship\Repository;
use Input;

class CompetitionsController extends BaseRegistrationController
{
    /**
     * Championship Repository.
     *
     * @var Repository
     */
    protected $repository;

    /**
     * Class constructor.
     *
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
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
        $championship = $this->repository->find($champId, ['competitions']);
        $games = $this->repository->getGamesDropdown();
        $formats = $this->repository->getFormatsDropdown();
        $platforms = $this->repository->getPlatformsDropdown();

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
        $championship = $this->repository->find($champId, ['competitions']);
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
        if (!$this->repository->createCompetition($champId, $input)) {
            return $this->redirectBack(['error' => $this->repository->getErrors()]);
        }

        // redirect back
        return $this->redirectRoute('admin.register.games', [$champId]);
    }

    public function destroy($champId, $competitionId)
    {
        $championship = $this->repository->find($champId);
        $competition = $championship->competitions->find($competitionId);

        $competition->delete();

        // redirect back
        return $this->redirectRoute('admin.register.games', [$champId]);
    }
}
