<?php
namespace Battleroad\Http\Controllers;

use Auth;
use View;
use Input;
use Laracasts\Commander\Events\DispatchableTrait;
use Champ\Account\Repositories\UserRepository;

class ProfileController extends BaseController
{
    /**
     * Profile Repository.
     *
     * @var Champ\Repositories\UserRepository
     */
    protected $userRepo;

    use DispatchableTrait;

    public function __construct(UserRepository $user)
    {
        $this->userRepo = $user;

        // checks if the user is logged in and inject the user context
        $this->beforeFilter('auth', ['except' => 'show']);

        // this methods can be view only if the user has no profile yet
        $this->beforeFilter('no_profile', ['only' => ['create', 'store']]);
    }

    /**
     * Show the profile for a user.
     *
     * @param string $username
     *
     * @return Response
     */
    public function show($username)
    {
        $user = $this->userRepo->getProfile($username);

        return View::make('profile.show', compact('user'));
    }

    /**
     * Show the create profile form.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('profile.create');
    }

    /**
     * Show the profile update form.
     *
     * This route is made to edit only your profile. In fact you can
     * access this route like /profile/blablabla/edit. I made this way
     * to not create any unecessary validations.
     *
     * @return Response
     */
    public function edit()
    {
        return $this->view('profile.edit');
    }

    /**
     * Updates the user profile.
     *
     * @return Response
     */
    public function update()
    {
        // check if the profile was created
        // if not, redirect the user back and show what happened
        if (!$profile = $this->userRepo->updateProfile(Auth::user()->id, Input::all())) {
            return $this->redirectBack(['error' => $this->userRepo->getErrors()]);
        }

        $this->dispatchEventsFor($profile);

        // if came here means profile was created
        // redirect him to your brand new profile and show a nice message =)
        return $this->redirectRoute('profile.show', [Auth::user()->username])
            ->with('message', 'Perfil Atualizado com sucesso!');
    }

    /**
     * Create a profile to a user.
     *
     * @return Reponse
     */
    public function store()
    {
        // check if the profile was created
        // if not, redirect the user back to the form and show what happened
        if (!$profile = $this->userRepo->createProfile(Auth::user()->id, Input::all())) {
            return $this->redirectBack(['error' => $this->userRepo->getErrors()]);
        }

        $this->dispatchEventsFor($profile);

        // if came here means everything gone ok
        // lets redirect the user and show a nice message =)
        return $this->redirectRoute('profile.show', Auth::user()->username)
            ->with('message', 'Perfil criado com sucesso!');
    }
}
