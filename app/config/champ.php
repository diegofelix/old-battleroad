<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Champ rate
    |--------------------------------------------------------------------------
    |
    */
    'rate' => 9.0,

    /*
    |--------------------------------------------------------------------------
    | Event listeners
    |--------------------------------------------------------------------------
    |
    */
    'listeners' => [
        'Champ\Listeners\ChampionshipVacancyUpdater',
        'Champ\Listeners\CompetitionVacancyUpdater',
        'Champ\Listeners\NotificationListener'
    ]
];