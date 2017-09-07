<?php

namespace Champ\Billing\Bcash;

use Champ\Billing\Contracts\TransactionDataFormatter;
use Champ\Billing\TransactionData;

class BcashDataFormatter implements TransactionDataFormatter
{
    /**
     * receive an input ( generaly json ) and translate to a data pattern.
     *
     * @param mixed $input
     *
     * @return TransactionData
     */
    public function format($input)
    {
        $transaction = $input['transacao'];

        return new TransactionData(
            $transaction['id_transacao'],
            $transaction['data_transacao'],
            $transaction['data_credito'],
            $transaction['valor_original'],
            $transaction['valor_loja'],
            $transaction['meio_pagamento'],
            $transaction['status']
        );
    }
}
