<?php namespace Champ\Billing\Contracts;

interface TransactionDataFormatter {

    /**
     * receive an input ( generaly json ) and translate to a data pattern
     *
     * @param  mixed $input
     * @return TransactionData
     */
    public function format($input);

}