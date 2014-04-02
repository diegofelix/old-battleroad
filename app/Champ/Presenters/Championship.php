<?php namespace Champ\Presenters;

use McCool\LaravelAutoPresenter\BasePresenter;
use Champ\Championship\Championship as ChampionshipModel;

class Championship extends BasePresenter
{
    /**
     * Inject the Championship in the Presenter
     *
     * @param Championship $championship
     */
    public function __construct(ChampionshipModel $championship)
    {
        $this->resource = $championship;
    }

    /**
     * Return the date with diff for humans translated to pt-br
     *
     * @return string
     */
    public function days_left()
    {
        // get the date based on brazilian time
        $now = \Carbon\Carbon::now('America/Sao_Paulo');

        // get the difference in days from now to the start of the event
        $days = $this->resource->event_start->diffInDays($now);

        // check if the diff is zero, meaning the champi is today!
        if ($days == 0) return '<span>Hoje</span>';

        // if is greater then one, then we have to plurarize the output.
        // the line put an s in our words
        $plural = ($days > 1) ? 's' : '';

        // finaly return the formated date
        return "<span>{$days} Dia{$plural}</span> restante{$plural}";
    }

    /**
     * Return a piece of the description
     *
     * @return string
     */
    public function short_description()
    {
        return substr($this->resource->description, 0, 160) . '...' ;
    }
}