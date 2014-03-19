<?php namespace Champ\Social;

use App;
use InvalidArgumentException;

class SocialFactory {

    public function create($provider)
    {
        switch ($provider) {
            case 'Facebook':
                return App::make('Champ\Social\Facebook\FacebookAuthenticator');
                break;
            case 'Google':
                return App::make('Champ\Social\Google\GoogleAuthenticator');
                break;
        }

        throw new InvalidArgumentException("Unsupported Social [$provider]");
    }

}