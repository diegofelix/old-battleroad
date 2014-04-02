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
     * Return the date with diff for humans
     * E.g: 3 days from now
     *
     * @return string
     */
    public function days_left()
    {
        $now = \Carbon\Carbon::now('America/Sao_Paulo');
        $days = $this->resource->event_start->diffInDays($now);

        $plural = ($days > 1) ? 's' : '';

        return "<span>{$days} Dia{$plural}</span> restante{$plural}";
    }

    /**
     * Return a piece of the description
     *
     * @return string
     */
    public function short_description()
    {
        return substr($this->resource->description, 0, 160);
    }
}