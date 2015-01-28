<?php namespace Champ\Notifications;

interface ChampionshipPublished {

    /**
     * Notify a user when a championship is published
     *
     * @param  string $title
     * @param  string $body
     * @return mixed
     */
    public function notify($title, $body);

}