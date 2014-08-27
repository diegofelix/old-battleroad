<?php namespace Champ\Presenters;

use Laracasts\Presenter\Presenter;
use Champ\Championship\Competition;
use Champ\Traits\UserPrice;

class CompetitionPresenter extends Presenter
{
    use UserPrice;

    /**
     * Show the limit of the competition, but if the championship limit is less then
     * the competition, show the championship limit
     *
     * @return int
     */
    public function trueLimit()
    {
        if ($this->championship->limit < $this->limit)
        {
            return $this->championship->limit;
        }
    }
}