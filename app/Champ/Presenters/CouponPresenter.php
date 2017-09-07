<?php

namespace Champ\Presenters;

use Laracasts\Presenter\Presenter;

class CouponPresenter extends Presenter
{
    /**
     * Present the price in a nice way.
     *
     * @return string
     */
    public function userPrice()
    {
        return 'R$ '.number_format($this->price, 2);
    }
}
