<?php namespace Admin\Registration;

use Auth;
use Input;
use BaseController;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;
use Champ\Championship\Registration\RegisterChampionshipCommand;

class RegisterController extends BaseRegistrationController {

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
            Input::get('location'),
            Input::get('event_start'),
            Input::file('image')
        );

        $championship = $this->execute($command);

        return $this->redirectRoute('admin.register.games', [$championship->id]);
    }

}