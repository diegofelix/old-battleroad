<?php namespace Champ\Join;

class UpdateJoinCommand {

    public $id;
    public $price;
    public $statusId;
    public $moipCode;
    public $paymentMethod;
    public $paymentType;
    public $parcels;
    public $userEmail;
    public $cancelationId = null;

    public function __construct(
        $id,
        $price,
        $statusId,
        $moipCode,
        $paymentMethod,
        $paymentType,
        $parcels,
        $userEmail,
        $cancelationId = null
    )
    {
        $this->id = $id;
        $this->price = $price;
        $this->statusId = $statusId;
        $this->moipCode = $moipCode;
        $this->paymentMethod = $paymentMethod;
        $this->paymentType = $paymentType;
        $this->parcels = $parcels;
        $this->userEmail = $userEmail;
        $this->cancelationId = $cancelationId;
    }

}