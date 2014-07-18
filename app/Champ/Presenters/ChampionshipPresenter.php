<?php namespace Champ\Presenters;

use Laracasts\Presenter\Presenter;
use Champ\Championship\Championship;
use Config;

class ChampionshipPresenter extends Presenter
{
    /**
     * Return the date with diff for humans translated to pt-br
     *
     * @return string
     */
    public function daysLeft()
    {
        // get the date based on brazilian time
        $now = \Carbon\Carbon::now('America/Sao_Paulo');

        // get the difference in days from now to the start of the event
        $days = $this->event_start->diffInDays($now);

        // check if the diff is zero, meaning the champ is today!
        if ($days == 0) return 'Hoje';

        // if is greater then one, then we have to plurarize the output.
        // the line put an s in our words
        $plural = ($days > 1) ? 's' : '';

        // finaly return the formatted date
        return "{$days} Dia{$plural} restante{$plural}";
    }

    /**
     * Return a piece of the description
     *
     * @return string
     */
    public function shortDescription()
    {
        return substr($this->description, 0, 160) . '...' ;
    }
}