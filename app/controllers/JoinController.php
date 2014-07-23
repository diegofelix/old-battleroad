<?php

use Laracasts\Commander\CommandBus;
use Champ\Join\JoinCommand;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;
use Champ\Join\Repositories\JoinRepositoryInterface;

class JoinController extends BaseController
{
    /**
     * Championship Repository
     *
     * @var Champ\Championship\Repositories\ChampionshipRepositoryInterface
     */
    protected $champRepo;

    /**
     * Join Repository
     *
     * @var Champ\Join\Repositories\JoinRepositoryInterface
     */
    protected $joinRepo;

    /**
     * Command Bus
     *
     * @var Laracasts\Commander\CommandBus
     */
    protected $commandBus;

    public function __construct(
        ChampionshipRepositoryInterface $champRepo,
        JoinRepositoryInterface $joinRepo,
        CommandBus $commandBus
    )
    {
        $this->champRepo = $champRepo;
        $this->joinRepo = $joinRepo;
        $this->commandBus = $commandBus;
    }

    /**
     * Show a form to register to championship
     *
     * @param  int $id
     * @return Response
     */
    public function index($id)
    {
        $championship = $this->champRepo->find($id);

        return $this->view('join.index', compact('championship'));
    }

    /**
     * Subscribe the logged user to the championship
     *
     * @return Response
     */
    public function register()
    {
        $championship = $this->champRepo->find(Input::get('id'));

        $command = new JoinCommand(Auth::user(), $championship, Input::get('competitions'));

        $join = $this->commandBus->execute($command);

        // redirect the user to the location page.
        return $this->redirectRoute('join.show', [$join->id]);
    }

    /**
     * Show all Join data
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $join = $this->joinRepo->find($id);

        return $this->view('join.show', compact('join'));
    }
}