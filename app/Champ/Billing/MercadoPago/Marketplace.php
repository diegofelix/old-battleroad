<?php namespace Champ\Billing\MercadoPago;

class Marketplace {

    public function __construct($restClient = null)
    {
        $this->restClient = (is_null($restClient)) ? new MPRestClient() : $restClient;
    }

    /**
     * Get the authorization URl
     *
     * @param  string $redirectUrl
     * @return string
     */
    public function getAuthenticationUrl($redirectUrl)
    {
        $clientId = getenv('MERCADOLIVRE_CLIENT');
        return "https://auth.mercadolibre.com.ar/authorization?client_id={$clientId}&response_type=code&platform_id=mp&redirect_uri={$redirectUrl}";
    }

    /**
     * Get the seller access token
     *
     * @param  string $code
     * @param  string $redirectUrl
     * @return json
     */
    public function getSellerAccessToken($code, $redirectUrl)
    {
        $client_id      = getenv('MERCADOLIVRE_CLIENT');
        $client_secret  = getenv('MERCADOLIVRE_SECRET');

        $response = $this->restClient->post('/oauth/token', http_build_query([
                'grant_type'    => 'authorization_code',
                'client_id'     => $client_id,
                'client_secret' => $client_secret,
                'code'          => $code,
                'redirect_uri'  => $redirectUrl,
            ]),
            "application/x-www-form-urlencoded"
        );

        echo '<pre>';
        var_dump($response);

        return $this->getSellerRefreshToken($response['response']['refresh_token']);
    }

    /**
     * Get the seller refresh token
     *
     * @param  string $refreshToken
     * @return json
     */
    public function getSellerRefreshToken($refreshToken)
    {
        return $this->restClient->post('/oauth/token', http_build_query([
            'grant_type' => 'refresh_token',
            'client_id' => getenv('MERCADOLIVRE_CLIENT'),
            'client_secret' => getenv('MERCADOLIVRE_SECRET'),
            'refresh_token' => $refreshToken,
        ]), "application/x-www-form-urlencoded");
    }

}