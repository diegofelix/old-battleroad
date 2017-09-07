<?php

namespace Champ\Championship\Events;

use Champ\Championship\Coupon;

class CouponWasApplied
{
    public $coupon;

    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }
}
