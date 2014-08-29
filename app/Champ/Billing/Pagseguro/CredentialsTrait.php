<?php namespace Champ\Billing\Pagseguro;

use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Environments\Sandbox;

trait CredentialsTrait {

    /**
     * Credentials
     *
     * @var Credentials
     */
    protected $credentials;

    private function startupPagseguro()
    {
        $this->credentials = new Credentials(
            'diegoflx.oliveira@gmail.com',
            'B36A4ADF9F7E4B58A82E26D2D8AA4BBD',
            new Sandbox()
        );
    }

}