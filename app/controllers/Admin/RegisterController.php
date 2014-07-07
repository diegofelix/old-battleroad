<?php namespace Admin;

use Input;
use BaseController;
use Champ\Repositories\ChampionshipRepositoryInterface;

class RegisterController extends BaseController{

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
     * Show the form to start registering a new Championship
     *
     * @return Response
     */
    public function index()
    {
        return $this->view('admin.register.index');
    }

    /**
     * Save the initial information about the championshipss
     *
     * @return Response
     */
    public function store()
    {
        if ( ! $championship =  $this->champRepo->create(Input::all()))
        {
            return $this->redirectBack()
                ->with('error', $this->champRepo->getErrors());
        }

        // redirect the user to the location page.
        return $this->redirectRoute('admin.register.location', [$championship->id]);
    }

    /**
     * Show a form to update the location for the championship
     *
     * @param  int $id
     * @return Response
     */
    public function location($id)
    {
        return $this->view('admin.register.location', compact('id'));
    }

    /**
     * Store the championship's location
     *
     * @return Response
     */
    public function storeLocation($id)
    {
        if ( ! $this->champRepo->saveLocation(Input::all()))
        {
            return $this->redirectBack()
                ->with('error', $this->champRepo->getErrors());
        }

        return $this->redirectRoute('admin.register.games.index', $id);
    }

    /**
     * Show all saved data to confirm to the user all steps before publish
     *
     * @param  int $id
     * @return Response
     */
    public function confirmation($id)
    {
        $championship = $this->champRepo->find($id);

        return $this->view('admin.register.confirmation', compact('championship'));
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

            return $this->redirectRoute('admin.championships.show', [$id])
                ->with('message', 'Campeonato publicado!');
        }
        else
        {
            return $this->redirectBack()
                ->with('error', 'Você precisa ter pelo menos uma competição pra publicar um campeonato.');
        }
    }

}