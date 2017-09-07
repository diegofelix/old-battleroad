<?php

namespace Battleroad\Http\Controllers;

use Auth;
use Input;
use Champ\Account\Repositories\UserRepository;
use Laracasts\Commander\Events\DispatchableTrait;

class RegisterController extends BaseController
{
    use DispatchableTrait;

    /**
     * User Repository.
     *
     * @var Champ\Account\Repositories\UserRepository
     */
    protected $userRepo;

    /**
     * Inject the user repo.
     */
    public function __construct(UserRepository $user)
    {
        $this->userRepo = $user;
    }

    /**
     * Show the registration for to the user.
     *
     * @return Response
     */
    public function index()
    {
        return $this->view('register.index');
    }

    /**
     * Register the user.
     *
     * @return Response
     */
    public function store()
    {
        if (!$user = $this->userRepo->create(Input::all())) {
            return $this->redirectBack(['error' => $this->userRepo->getErrors()]);
        }

        // authenticate the user immediatly
        Auth::loginUsingId($user->id);

        // when a user is registered, its fire various events
        // this method dispatch them
        $this->dispatchEventsFor($user);

        // and return him to the home
        return $this->redirectTo('/', ['message' => 'Parabéns, sua conta foi criada!']);
    }
}
