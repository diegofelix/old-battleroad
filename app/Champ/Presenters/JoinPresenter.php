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
}