<?php namespace Champ\Social;

use Champ\Social\SocialDataReaderInterface;
use Champ\Social\SocialAuthenticatorListenerInterface;
use Champ\Account\Repositories\UserRepositoryInterface;
use App;

abstract class SocialAuthenticator {

    /**
     * Social User Data Reader
     *
     * @var Champ\Account\UserRepositoryInterface
     */
    protected $user;

    /**
     * Social User Data Reader
     *
     * @var Champ\Core\Social\SocialDataReaderInterface
     */
    protected $reader;

    /**
     * @var Champ\Social\SocialAuthenticatorListenerInterface
     */
    protected $listener;

    /**
     * Inject the data reader and the user repository
     */
    public function __construct(
        UserRepositoryInterface $user = null,
        SocialDataReaderInterface $reader = null
    )
    {
        $this->user = $user;
        $this->reader = $reader;
    }

    /**
     * Get the repository user data using oAuth
     *
     * @param Champ\Social\SocialAuthenticatorListenerInterface $listener
     * @param string $code
     * @return Response
     */
    public function authByCode(SocialAuthenticatorListenerInterface $listener, $code)
    {
        // cache the listener
        $this->listener = $listener;

        // get the social data from the code given
        $socialData = $this->reader->getDataFromCode($code);

        // get the user from the user repository
        $user = $this->user->getByEmail($socialData['email']);

        if ($user) {
            return $this->loginUser($user);
        }

        return $this->userNotFound($socialData);
    }

    /**
     * Use the listener to handle the user userFound
     *
     * @param  Champ\Account\User $user
     * @return Response
     */
    protected function loginUser($user)
    {
        if ($user->is_banned) {
            return $this->listener->userIsBanned($user);
        }

        return $this->listener->userFound($user);
    }

    /**
     * Use the listener to treat the user not found
     *
     * @param  array $googleData
     * @return Response
     */
    protected function userNotFound($googleData)
    {
        return $this->listener->userNotFound($googleData);
    }
}