<?php namespace Champ\Social;

interface SocialAuthenticatorListenerInterface
{
    /**
     * Login the user in case the user exists.
     *
     * @param Champ\Account\User $user
     *
     * @return Response
     */
    public function userFound($user);

    /**
     * Redirect the user to a signup page with some data already filled.
     *
     * @param array $data
     *
     * @return Response
     */
    public function userNotFound($data);

    /**
     * Treat the user banned.
     *
     * @param Champ\Account\User $user
     *
     * @return Response
     */
    public function userIsBanned($user);
}
