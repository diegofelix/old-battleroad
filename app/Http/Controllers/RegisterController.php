<?php

namespace Battleroad\Http\Controllers;

use Auth;
use Champ\Account\Events\UserSignedUp;
use Input;
use Champ\Account\Repositories\UserRepository;

class RegisterController extends BaseController
{
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

        event(new UserSignedUp($user));

        // and return him to the home
        return $this->redirectTo('/', ['message' => 'Parabéns, sua conta foi criada!']);
    }
}
