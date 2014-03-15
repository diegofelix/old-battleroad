<?php namespace Champ\Core\Social;

use Champ\Social\SocialDataReaderInterface;

abstract class SocialAuthenticator {

    /**
     * Social User Data Reader
     *
     * @var Champ\Core\Social\SocialDataReaderInterface
     */
    protected $reader;

    /**
     * Inject the data reader interface
     */
    public function __construct(SocialDataReaderInterface $reader = null)
    {
        $this->reader = $reader;
    }

    /**
     * Get the repository user data using Social credentials
     *
     * @param  string $code
     * @return Response
     */
    public function authByCode($code)
    {
        $user = App::make('Champ\Account\UserRepositoryInterface');

        $socialData = $this->reader->getDataFromCode($code);
        return $this->user->getByEmail($socialData['email']);
    }
}