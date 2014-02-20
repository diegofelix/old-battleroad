<?php namespace Champ\Social;

interface SocialAuthenticatorListener {

    public function userFound($user);
    public function userIsBanned($user);

}