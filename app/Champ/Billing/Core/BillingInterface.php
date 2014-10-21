<?php namespace Champ\Billing\Core;

use Champ\Account\User;
use Champ\Join\Join;
use Champ\Billing\Core\PaymentListenerInterface;

interface BillingInterface {

    /**
     * Do the payment
     *
     * @param  PaymentListenerInterface $payment
     * @param  Join $join
     * @return Response
     */
    public function invoice(Join $join, PaymentListenerInterface $listener);

}