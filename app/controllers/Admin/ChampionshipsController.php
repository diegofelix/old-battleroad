<?php namespace Admin;

use Input;
use BaseController;
use Champ\Repositories\ChampionshipRepositoryInterface;

class ChampionshipsController extends BaseController {

    /**
     * Championship Repository
     *
     * @var Champ\Repositories\ChampionshipRepositoryInterface
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

    public function edit($id)
    {
        $championship = $this->champRepo->find($id);
        return $this->view('admin.championships.edit', compact('championship'));
    }

    /**
     * Update the championship's information, in this case, only description
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        if ( ! $this->champRepo->update($id, ['description' => Input::get('description')])) {
            return $this->redirectBack()->with('error', $this->champRepo->getErrors());
        }

        return $this->redirectRoute('admin.championships.show', [$id])
            ->with('message', 'Informações atualizadas!');
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
        return $this->redirectRoute('admin.championships.games.index', [$championship->id])
            ->with(['message' => 'Campeonato criado com sucesso!', 'show-tutorial' => true]);
    }

    /**
     * Publish a championship, but only if the championship have at least
     * one game
     *
     * @param  int $id
     * @return Response
     */
    public function publish($id)
    {
        $championship = $this->champRepo->find($id);

        // check the count of competitions
        if ($championship->competitions->count() > 0)
        {
            $this->champRepo->publish($id);

            return $this->redirectRoute('admin.championships.index', [$championship->id])
                ->with(['message' => 'Campeonato publicado!']);
        }
        else
        {
            return $this->redirectBack()
                ->with('error', 'Você precisa ter pelo menos uma competição pra publicar um campeonato.');
        }
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

    public function banner($id)
    {
        $championship = $this->champRepo->find($id);
        return $this->view('admin.championships.banner', compact('championship'));
    }
}