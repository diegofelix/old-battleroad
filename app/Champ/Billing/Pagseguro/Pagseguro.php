<?php namespace Champ\Billing\Pagseguro;

use Champ\Account\User;
use Champ\Championship\Championship;
use Champ\Join\Join;


// pagseguro
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Environments\Sandbox;
use PHPSC\PagSeguro\Customer\Customer;
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
    public function pay(Join $join)
    {
        try
        {
            $service = new CheckoutService($this->credentials);

            $checkout = $this->calculateTotalPrice($join, $service);

            $response = $service->checkout($checkout);

            return $response;
        }
        catch (Exception $error)
        {
           return $error->getMessage();
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
        if ($join->price)
        {
            $item = new Item(1, 'Entrada', $join->price);
            $checkout->addItem($item);

            foreach ($join->items as $item)
            {
                if ($item->price > 0)
                {
                    $checkout->addItem(new Item($item->id, $item->competition->game->name, $item->price));
                }
            }
        }

        return $checkout->getCheckout();
    }

}