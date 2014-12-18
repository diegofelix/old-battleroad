<?php namespace Champ\Billing\Pagseguro;

use Champ\Account\User;
use Champ\Championship\Championship;
use Champ\Join\Join;
use Champ\Billing\Core\PaymentListenerInterface;
use Champ\Billing\Core\BillingInterface;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

class Pagseguro implements BillingInterface {

    use CredentialsTrait;

    protected $checkout;

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

    /**
     * Calculate the price for the championship
     *
     * @param  Join $join
     * @return void
     */
    private function calculateTotalPrice($join, $service)
    {
        $checkout = $service->createCheckoutBuilder();
        $checkout->setReference($join->id);
        $itemCounter = 1;

        // if ($join->price)
        // {
        //     $item = new Item($itemCounter++, 'Entrada', $join->price);
        //     $checkout->addItem($item);
        // }

        // if we dont have items to add, go back boy.
        if ( ! $join->items->count()) return $checkout->getCheckout();

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