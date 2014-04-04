<?php namespace Admin;

use Auth;
use Input;
use BaseController;
use Champ\Repositories\ChampionshipRepositoryInterface;

class ChampionshipsController extends BaseController {

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
     * Show a list of Championships in desc date order
     *
     * @return Response
     */
    public function index()
    {
        $championships = $this->champRepo->all(['user']);

        return $this->view('admin.championships.index', compact('championships'));
    }

    /**
     * Show a Create Form for a Championship
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('admin.championships.create');
    }

    /**
     * Save the championship
     *
     * @return Response
     */
    public function store()
    {
        if ( ! $championship =  $this->champRepo->create(Input::all())) {
            return $this->redirectBack()->with('error', $this->champRepo->getErrors());
        }

        // after the championship is created, we redirect to his page, there, the user can
        // add games and define prices and etc.
        return $this->redirectRoute('admin.championships.show', [$championship->id])
            ->with(['message' => 'Campeonato criado, agora só falta adicionar os jogos pro seu campeonato =)']);
    }

    /**
     * Manage the championship
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $championship = $this->champRepo->find($id);
        return $this->view('admin.championships.show', compact('championship'));
    }
}