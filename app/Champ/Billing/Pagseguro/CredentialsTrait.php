<?php namespace Champ\Billing\Pagseguro;

use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Environments\Sandbox;

trait CredentialsTrait
{
    /**
     * Credentials.
     *
     * @var Credentials
     */
    protected $credentials;

    private function startupPagseguro()
    {
        $this->credentials = new Credentials(
            getenv('PAGSEGURO_EMAIL'),
            getenv('PAGSEGURO_TOKEN'),
            new Sandbox()
        );
    }
}
