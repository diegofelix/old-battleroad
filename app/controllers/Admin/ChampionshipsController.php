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
     * Show a form to edit a championship
     *
     * @param  int $id
     * @return Response
     */
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