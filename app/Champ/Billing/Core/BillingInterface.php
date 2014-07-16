<?php namespace Champ\Billing\Core;

use Champ\Account\User;
use Champ\Championship\Championship;

interface BillingInterface {

    /**
     * Do the payment
     *
     * @param  PaymentObjectInterface $payment
     * @return mixed
     */
    public function pay(Championship $championship, User $user);

}