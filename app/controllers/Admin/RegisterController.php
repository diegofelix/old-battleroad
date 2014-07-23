<?php namespace Admin;

use Auth;
use Input;
use BaseController;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;
use Laracasts\Commander\CommandBus;
use Champ\Championship\Registration\RegisterChampionshipCommand;

class RegisterController extends BaseController
{
    /**
     * Championship Repository
     *
     * @var Champ\Championship\Repositories\ChampionshipRepositoryInterface
     */
    protected $champRepo;

    /**
     * Command Bus
     *
     * @var Laracasts\Commander\CommandBus
     */
    protected $commandBus;

    public function __construct(
        ChampionshipRepositoryInterface $champRepo,
        CommandBus $commandBus
    )
    {
        $this->champRepo = $champRepo;
        $this->commandBus = $commandBus;
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
        $command = new RegisterChampionshipCommand(
            Auth::user()->id,
            Input::get('name'),
            Input::get('description'),
            Input::get('event_start'),
            Input::file('image')
        );

        $championship = $this->commandBus->execute($command);

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