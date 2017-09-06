<?php namespace Champ\Billing\Core;

use Champ\Join\Join;

interface BillingInterface
{
    /**
     * Do the payment.
     *
     * @param PaymentListenerInterface $payment
     * @param Join                     $join
     *
     * @return Response
     */
    public function invoice(Join $join, PaymentListenerInterface $listener);
}
