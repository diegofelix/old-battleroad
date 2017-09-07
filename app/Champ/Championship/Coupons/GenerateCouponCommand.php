<?php

namespace Champ\Championship\Coupons;

class GenerateCouponCommand
{
    public $championshipId;
    public $code;
    public $price;

    /**
     * Constructor.
     *
     * @param int    $championship_id
     * @param string $code
     * @param int    $price
     */
    public function __construct($championship_id, $code, $price)
    {
        $this->championshipId = $championship_id;
        $this->code = $code;
        $this->price = $price;
    }
}
