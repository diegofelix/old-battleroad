<?php namespace Champ\Billing;

use Config;

class TransactionData
{
    /**
     * Transaction ID.
     *
     * @var string
     */
    public $transactionId;

    /**
     * Date when the transaction occour.
     *
     * @var string
     */
    public $transactionDate;

    /**
     * Date when the user will receive the money.
     *
     * @var string
     */
    public $creditDate;

    /**
     * The price paid by the competitor.
     *
     * @var string
     */
    public $originalPrice;

    /**
     * The price after we apply our rates.
     * This is not the billing service price, its our price with the rate applied.
     *
     * @var string
     */
    public $priceAfterTaxes;

    /**
     * A string with the payment method given for the billing service.
     *
     * @var string
     */
    public $paymentMethod;

    /**
     * A string with the status given for the billing service.
     *
     * @var string
     */
    public $status;

    public function __construct($transactionId, $transactionDate, $creditDate, $originalPrice, $priceAfterTaxes, $paymentMethod, $status)
    {
        $this->transactionId = $transactionId;
        $this->transactionDate = $transactionDate;
        $this->creditDate = $creditDate;
        $this->originalPrice = $originalPrice;
        $this->priceAfterTaxes = $priceAfterTaxes;
        $this->paymentMethod = $paymentMethod;
        $this->status = $status;

        //$this->priceAfterTaxes = number_format(apply_comission($this->originalPrice, Config::get('champ.rate')), 2);
    }
}
