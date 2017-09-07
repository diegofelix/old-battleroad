<?php

namespace Champ\Presenters;

use Laracasts\Presenter\Presenter;
use Champ\Traits\UserPrice;
use Champ\Join\Status;

class JoinPresenter extends Presenter
{
    use UserPrice;

    public function simplifiedStatus()
    {
        $statuses = [Status::IN_PROGRESS, Status::APPROVED]; // paid statuses

        return (in_array($this->status_id, $statuses))
            ? 'paid'
            : 'pending';
    }

    public function totalPrice()
    {
        if ($this->status_id >= Status::DISPUTE) {
            return 0;
        }

        $price = 0;

        foreach ($this->items as $item) {
            $price += $item->price * 0.9;
        }

        return $price;
    }

    public function totalConfirmedPrice()
    {
        if (!in_array($this->status_id, [Status::APPROVED, Status::FINISHED])) {
            return 0;
        }

        $price = 0;

        foreach ($this->items as $item) {
            $price += $item->competition->original_price;
        }

        return $price;
    }

    public function totalPendentPrice()
    {
        if (!in_array($this->status_id, [Status::WAITING, Status::IN_PROGRESS])) {
            return 0;
        }

        $price = 0;

        foreach ($this->items as $item) {
            $price += $item->competition->original_price;
        }

        return $price;
    }

    /**
     * Show the user name or nick if applied.
     *
     * @return string
     */
    public function competitorName()
    {
        if ($this->nick) {
            return $this->nick;
        }

        return $this->user->name;
    }
}
