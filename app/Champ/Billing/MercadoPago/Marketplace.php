<?php namespace Champ\Billing\MercadoPago;

use Champ\Join\Join;
use Champ\Billing\Core\PaymentListenerInterface;

class Marketplace
{
    public function __construct($restClient = null)
    {
        $this->restClient = (is_null($restClient)) ? new MPRestClient() : $restClient;
    }

    /**
     * Get the authorization URl.
     *
     * @param string $redirectUrl
     *
     * @return string
     */
    public function getAuthenticationUrl($redirectUrl)
    {
        $clientId = getenv('MERCADOLIVRE_CLIENT');

        return "https://auth.mercadolivre.com.br/authorization?client_id={$clientId}&response_type=code&platform_id=mp&redirect_uri={$redirectUrl}";
    }

    /**
     * Get the seller access token.
     *
     * @param string $code
     * @param string $redirectUrl
     *
     * @return json
     */
    public function getSellerAccessToken($code, $redirectUrl)
    {
        $client_id = getenv('MERCADOLIVRE_CLIENT');
        $client_secret = getenv('MERCADOLIVRE_SECRET');

        return $this->restClient->post('/oauth/token', http_build_query([
                'grant_type' => 'authorization_code',
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'code' => $code,
                'redirect_uri' => $redirectUrl,
            ]),
            'application/x-www-form-urlencoded'
        );
    }

    public function getAccessToken()
    {
        $client_id = getenv('MERCADOLIVRE_CLIENT');
        $client_secret = getenv('MERCADOLIVRE_SECRET');

        $response = $this->restClient->post('/oauth/token', http_build_query([
                'grant_type' => 'client_credentials',
                'client_id' => $client_id,
                'client_secret' => $client_secret,
            ]),
            'application/x-www-form-urlencoded'
        );

        return $response['response']['access_token'];
    }

    /**
     * Get the seller refresh token.
     *
     * @param string $refreshToken
     *
     * @return json
     */
    public function getSellerRefreshToken($championship)
    {
        // get a new access token based on the previous refresh token
        $response = $this->restClient->post('/oauth/token', http_build_query([
            'grant_type' => 'refresh_token',
            'client_id' => getenv('MERCADOLIVRE_CLIENT'),
            'client_secret' => getenv('MERCADOLIVRE_SECRET'),
            'refresh_token' => $championship->refresh_token,
        ]), 'application/x-www-form-urlencoded');

        // save the new refresh token for the future
        $championship->refresh_token = $response['response']['refresh_token'];
        $championship->save();

        // return the new access token
        return $response['response']['access_token'];
    }

    public function createTestUser()
    {
        $access_token = $this->getAccessToken();

        $payment_info = $this->restClient->post('/users/test_user?access_token='.$access_token, ['site_id' => 'MLB']);

        return $payment_info;
    }

    /**
     * Do the payment with Moip.
     *
     * @param PaymentObjectInterface $payment
     *
     * @return mixed
     */
    public function invoice(Join $join, PaymentListenerInterface $listener)
    {
        // instantiate an array with the items and the total price for transaction
        $items = [];
        $totalPrice = 0;

        // pass for all competitions that has a price and add to the "cart"
        foreach ($join->items as $item) {
            if ($item->price > 0) {
                $items[] = [
                    'title' => $item->competition->game->name,
                    'description' => $item->competition->game->name,
                    'quantity' => 1,
                    'unit_price' => $item->price,
                    'currency_id' => 'BRL',
                ];

                $totalPrice += $item->price;
            }
        }

        // @todo
        // calculate the fixed amount to totalprice

        $preference = [
            'items' => $items,
            'marketplace_fee' => 2.29,
        ];

        $response = $this->createPreference($preference, $join);

        return $listener->paymentAllowed($response, $join);
    }

    /**
     * Calculate the price for the championship.
     *
     * @param Join $join
     */
    private function calculateTotalPrice($join, $service)
    {
        $checkout = $service->createCheckoutBuilder();
        $checkout->setReference($join->id);
        $itemCounter = 1;

        if ($join->price) {
            $item = new Item($itemCounter++, 'Entrada', $join->price);
            $checkout->addItem($item);
        }

        // if we dont have items to add, go back boy.
        if (!$join->count()) {
            return $checkout->getCheckout();
        }

        // pass through all items and add to the checkout.
        foreach ($join->items as $item) {
            if ($item->price > 0) {
                $checkout->addItem(new Item($itemCounter++, $item->competition->game->name, $item->price));
            }
        }

        return $checkout->getCheckout();
    }

    /**
     * Get information for specific payment.
     *
     * @param int $id
     *
     * @return array(json)
     */
    public function getPayment($id, $token)
    {
        $access_token = $this->getSellerRefreshToken($token);

        $uri_prefix = $this->sandbox ? '/sandbox' : '';

        $payment_info = $this->restClient->get($uri_prefix.'/collections/notifications/'.$id.'?access_token='.$access_token);

        return $payment_info;
    }

    public function getHistory($championship)
    {
        $access_token = $this->getSellerRefreshToken($championship);

        $payment_info = $this->restClient->get('/mercadopago_account/movements/search?access_token='.$access_token.'&type=income&offset=0&limit=10');

        return $payment_info;
    }

    /**
     * Get information for specific authorized payment.
     *
     * @param id
     *
     * @return array(json)
     */
    public function getAuthorizedPayment($id, $token)
    {
        $access_token = $this->getSellerRefreshToken($token);

        $authorized_payment_info = $this->restClient->get('/authorized_payments/'.$id.'?access_token='.$access_token);

        return $authorized_payment_info;
    }

    /**
     * Refund accredited payment.
     *
     * @param int $id
     *
     * @return array(json)
     */
    public function refundPayment($id, $token)
    {
        $access_token = $this->getSellerRefreshToken($token);

        $refund_status = array(
            'status' => 'refunded',
        );

        $response = $this->restClient->put('/collections/'.$id.'?access_token='.$access_token, $refund_status);

        return $response;
    }

    /**
     * Cancel pending payment.
     *
     * @param int $id
     *
     * @return array(json)
     */
    public function cancelPayment($id, $token)
    {
        $access_token = $this->getSellerRefreshToken($token);

        $cancel_status = array(
            'status' => 'cancelled',
        );

        $response = $this->restClient->put('/collections/'.$id.'?access_token='.$access_token, $cancel_status);

        return $response;
    }

    /**
     * Create a checkout preference.
     *
     * @param array $preference
     *
     * @return array(json)
     */
    public function createPreference($preference, $join)
    {
        $access_token = $this->getSellerRefreshToken($join->championship);

        $preference_result = $this->restClient->post('/checkout/preferences?access_token='.$access_token, $preference);

        return $preference_result;
    }

    /**
     * Update a checkout preference.
     *
     * @param string $id
     * @param array  $preference
     *
     * @return array(json)
     */
    public function updatePreference($id, $preference, $token)
    {
        $access_token = $this->getSellerRefreshToken($token);

        $preference_result = $this->restClient->put("/checkout/preferences/{$id}?access_token=".$access_token, $preference);

        return $preference_result;
    }

    /**
     * Get a checkout preference.
     *
     * @param string $id
     *
     * @return array(json)
     */
    public function getPreference($id, $token)
    {
        $access_token = $this->getSellerRefreshToken($token);

        $preference_result = $this->restClient->get("/checkout/preferences/{$id}?access_token=".$access_token);

        return $preference_result;
    }
}
