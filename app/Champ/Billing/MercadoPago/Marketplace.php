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
        return "https://auth.mercadolivre.com.br/authorization?client_id={$clientId}&response_type=code&platform_id=mp&redirect_uri={$redirectUrl}";
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

        return $this->restClient->post('/oauth/token', http_build_query([
                'grant_type'    => 'authorization_code',
                'client_id'     => $client_id,
                'client_secret' => $client_secret,
                'code'          => $code,
                'redirect_uri'  => $redirectUrl,
            ]),
            "application/x-www-form-urlencoded"
        );
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


    /**
     * Get information for specific payment
     *
     * @param int $id
     * @return array(json)
     */
    public function getPayment($id, $token)
    {
        $access_token = $this->getSellerRefreshToken($token);

        $uri_prefix = $this->sandbox ? "/sandbox" : "";

        $payment_info = $this->restClient->get($uri_prefix."/collections/notifications/" . $id . "?access_token=" . $access_token);

        return $payment_info;
    }

    /**
     * Get information for specific authorized payment
     *
     * @param id
     * @return array(json)
    */
    public function getAuthorizedPayment($id, $token)
    {
        $access_token = $this->getSellerRefreshToken($token);

        $authorized_payment_info = $this->restClient->get("/authorized_payments/" . $id . "?access_token=" . $access_token);

        return $authorized_payment_info;
    }

    /**
     * Refund accredited payment
     *
     * @param int $id
     * @return array(json)
     */
    public function refundPayment($id, $token)
    {
        $access_token = $this->getSellerRefreshToken($token);

        $refund_status = array(
            "status" => "refunded"
        );

        $response = $this->restClient->put("/collections/" . $id . "?access_token=" . $access_token, $refund_status);

        return $response;
    }

    /**
     * Cancel pending payment
     *
     * @param int $id
     * @return array(json)
     */
    public function cancelPayment($id, $token)
    {
        $access_token = $this->getSellerRefreshToken($token);

        $cancel_status = array(
            "status" => "cancelled"
        );

        $response = $this->restClient->put("/collections/" . $id . "?access_token=" . $access_token, $cancel_status);

        return $response;
    }

    /**
     * Create a checkout preference
     *
     * @param array $preference
     * @return array(json)
     */
    public function createPreference($preference, $token)
    {
        $access_token = $this->getSellerRefreshToken($token);

        $preference_result = $this->restClient->post("/checkout/preferences?access_token=" . $access_token, $preference);

        return $preference_result;
    }

    /**
     * Update a checkout preference
     *
     * @param string $id
     * @param array $preference
     * @return array(json)
     */
    public function updatePreference($id, $preference, $token)
    {
        $access_token = $this->getSellerRefreshToken($token);

        $preference_result = $this->restClient->put("/checkout/preferences/{$id}?access_token=" . $access_token, $preference);

        return $preference_result;
    }

    /**
     * Get a checkout preference
     *
     * @param string $id
     * @return array(json)
     */
    public function getPreference($id, $token)
    {
        $access_token = $this->getSellerRefreshToken($token);

        $preference_result = $this->restClient->get("/checkout/preferences/{$id}?access_token=" . $access_token);

        return $preference_result;
    }
}