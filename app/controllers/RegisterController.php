<?php

use Champ\Account\Repositories\UserRepositoryInterface;

class RegisterController extends BaseController {

    /**
     * User Repository
     *
     * @var Champ\Account\Repositories\UserRepositoryInterface
     */
    protected $userRepo;

    /**
     * Inject the user repo
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->userRepo = $user;
    }

    /**
     * Show the registration for to the user
     *
     * @return Response
     */
    public function index()
    {
        return $this->view('register.index');
    }

    /**
     * Register the user
     *
     * @return Response
     */
    public function store()
    {
        if ( ! $user = $this->userRepo->create(Input::all())) {
            return $this->redirectBack(['error' => $this->userRepo->getErrors()]);
        }

        // authenticate the user immediatly
        Auth::loginUsingId($user->id);

        // and return him to the home
        return $this->redirectTo('/', ['message' => 'Parabéns, sua conta foi criada!']);
    }

}