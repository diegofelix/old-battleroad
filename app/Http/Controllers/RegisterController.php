<?php
namespace Battleroad\Http\Controllers;

use Champ\Account\Repositories\UserRepositoryInterface;
use Laracasts\Commander\Events\DispatchableTrait;

class RegisterController extends BaseController {

    /**
     * User Repository
     *
     * @var Champ\Account\Repositories\UserRepositoryInterface
     */
    protected $userRepo;

    use DispatchableTrait;

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
        if ( ! $user = $this->userRepo->create(Input::all()))
        {
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