<?php namespace Admin;

use Auth;
use Input;
use BaseController;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;

class ChampionshipsController extends BaseController {

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
     * Show a list of Championships in desc date order
     *
     * @return Response
     */
    public function index()
    {
        $championships = $this->champRepo->getAllByUser(Auth::user()->id, ['user']);

        return $this->view('admin.championships.index', compact('championships'));
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

    public function edit()
    {
        dd('Updating');
    }

    /**
     * Show the banner of the championship
     *
     * @param  int $id
     * @return Response
     */
    public function banner($id)
    {
        $championship = $this->champRepo->find($id);
        return $this->view('admin.championships.banner', compact('championship'));
    }

    /**
     * Show all users that joined the championship
     *
     * @param  int $id
     * @return Response
     */
    public function users($id)
    {
        $championship = $this->champRepo->find($id, ['joins.user']);

        return $this->view('admin.championships.users', compact('championship'));
    }
}