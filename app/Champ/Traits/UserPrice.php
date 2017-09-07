<?php

namespace Champ\Traits;

trait UserPrice
{
    /**
     * Return the price for the user in a human format.
     *
     * @return float
     */
    public function userPrice()
    {
        if ($this->price == 0) {
            return '<span class="champ-free label label-success">Grátis!</span>';
        }

        return '<span class="label label-default">R$ '.number_format($this->price, 2).'</span>';
    }

    /**
     * Show the price in a numeric format.
     *
     * @return string
     */
    public function numericPrice()
    {
        return number_format($this->price, 2);
    }
}
