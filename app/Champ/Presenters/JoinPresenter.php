<?php namespace Champ\Presenters;

use Laracasts\Presenter\Presenter;
use Champ\Traits\UserPrice;

class JoinPresenter extends Presenter
{
    use UserPrice;

    public function simplifiedStatus()
    {
        $statuses = [3,4]; // paid statuses

        return (in_array($this->status_id, $statuses))
            ? 'paid'
            : 'pending';
    }

    public function totalPrice()
    {
        if ($this->status_id >= 5) return 0;

        $price = 0;

        foreach ($this->items as $item)
        {
            $price += $item->competition->original_price;
        }

        return $price;
    }

    public function totalConfirmedPrice()
    {
        if ( ! in_array($this->status_id, [3,4])) return 0;

        $price = 0;

        foreach ($this->items as $item)
        {
            $price += $item->competition->original_price;
        }

        return $price;
    }

    public function totalPendentPrice()
    {
        if ( ! in_array($this->status_id, [1,2])) return 0;

        $price = 0;

        foreach ($this->items as $item)
        {
            $price += $item->competition->original_price;
        }

        return $price;
    }
}