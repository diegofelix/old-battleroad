<?php
namespace Battleroad\Http\Controllers;

use Champ\Social\SocialAuthenticatorListenerInterface;
use Champ\Account\Repositories\UserRepository;
use Champ\Social\SocialFactory;
use Laracasts\Commander\Events\DispatchableTrait;

class AuthController extends BaseController implements SocialAuthenticatorListenerInterface
{
    /**
     * User Repository.
     *
     * @var Champ\Account\Repositories\UserRepository
     */
    protected $userRepo;

    /**
     * Social Factory.
     *
     * @var Champ\Social\SocialFactory
     */
    protected $social;

    use DispatchableTrait;

    public function __construct(
        UserRepository $user,
        SocialFactory $social)
    {
        $this->userRepo = $user;
        $this->social = $social;
    }

    /**
     * Handle the Authentication from Google.
     *
     * @return Response
     */
    public function google()
    {
        return $this->auth('Google');
    }

    /**
     * Handle the Authentication from Facebook.
     *
     * @return Response
     */
    public function facebook()
    {
        return $this->auth('Facebook');
    }

    /**
     * User found listener used in the SocialAuth.
     *
     * @param Champ\Account\User $user
     *
     * @return Response
     */
    public function userFound($user)
    {
        Auth::loginUsingId($user->id);

        return $this->redirectIntended('/');
    }

    /**
     * User is Banned
     * This method also can be used in the SocialAuth.
     *
     * @param Champ\Account\User $user
     *
     * @return Response
     */
    public function userIsBanned($user)
    {
        return \App::abort(404);
        //dd($user);
    }

    /**
     * User Not Found Listener used in the SocialAuth.
     *
     * @param array data
     *
     * @return Response
     */
    public function userNotFound($data)
    {
        $user = $this->userRepo->createBySocialAuth($data);

        // when a user signed up we fire an event
        // here we release every event
        $this->dispatchEventsFor($user);

        return $this->userFound($user);
    }

    protected function auth($serviceName)
    {
        if (Input::has('code')) {
            return $this->social->create($serviceName)->authByCode($this, Input::get('code'));
        }

        // redirect to the facebook oAuth
        return $this->redirectTo((string) OAuth::consumer($serviceName)->getAuthorizationUri());
    }
}
