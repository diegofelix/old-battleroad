<?php namespace Champ\Billing\Core;

use Champ\Join\Join;

interface PaymentListenerInterface
{
    /**
     * This method will be called when the user is allowed to pay.
     *
     * @param   $response
     *
     * @return Response
     */
    public function paymentAllowed($response, Join $join);

    /**
     * When occurs an error, this method will be called.
     *
     * @param   $error
     *
     * @return Response
     */
    public function paymentError($error);
}
