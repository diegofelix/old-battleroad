<?php namespace Champ\Billing\Pagseguro;

use Champ\Account\User;
use Champ\Championship\Championship;
use Champ\Join\Join;
use Champ\Billing\Core\PaymentListenerInterface;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Environments\Sandbox;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

class Pagseguro {

    protected $checkout;
    protected $credentials;

    public function __construct()
    {
        $this->startupPagseguro();
    }

    /**
     * Do the payment with Moip
     *
     * @param  PaymentObjectInterface $payment
     * @return mixed
     */
    public function invoice(Join $join, PaymentListenerInterface $listener)
    {
        try
        {
            $service = new CheckoutService($this->credentials);

            $checkout = $this->calculateTotalPrice($join, $service);

            $response = $service->checkout($checkout);

            return $listener->paymentAllowed($response, $join);
        }
        catch (Exception $error)
        {
            $error = $error->getMessage();
            return $listener->errorOnPayment($error);
        }
    }

    private function startupPagseguro()
    {
        $this->credentials = new Credentials(
            'diegoflx.oliveira@gmail.com',
            'B36A4ADF9F7E4B58A82E26D2D8AA4BBD',
            new Sandbox()
        );
    }

    /**
     * Calculate the price for the championship
     *
     * @param  Join $join
     * @return void
     */
    private function calculateTotalPrice($join, $service)
    {
        $checkout = $service->createCheckoutBuilder();
        $itemCounter = 1;

        if ($join->price)
        {
            $item = new Item($itemCounter++, 'Entrada', $join->price);
            $checkout->addItem($item);
        }

        // if we dont have items to add, go back boy.
        if ( ! $join->count()) return $checkout->getCheckout();

        // pass through all items and add to the checkout.
        foreach ($join->items as $item)
        {
            if ($item->price > 0)
            {
                $checkout->addItem(new Item($itemCounter++, $item->competition->game->name, $item->price));
            }
        }

        return $checkout->getCheckout();
    }

}