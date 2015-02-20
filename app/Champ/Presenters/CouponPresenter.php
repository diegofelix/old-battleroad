<?php namespace Champ\Presenters;

use Laracasts\Presenter\Presenter;
use Champ\Championship\Coupon;

class CouponPresenter extends Presenter {

    /**
     * Present the price in a nice way
     *
     * @return string
     */
    public function userPrice()
    {
        return 'R$ ' . number_format($this->price, 2);
    }

}