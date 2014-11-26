<?php

return [

    'admin_email' => 'diegoflx.oliveira@gmail.com',

    /*
    |--------------------------------------------------------------------------
    | Champ rate
    |--------------------------------------------------------------------------
    |
    | This tax is used to acomplish how much the site will take for
    | every transaction in the site. For example:
    |
    | A Championship that the organizer want to receive 20.
    | the price that will be showed to the user will be 22. Because 10% of 22
    | is 2 ( for the site and payment system ) and 20 will be sent to the
    | organizer.
    |
    */
    'rate' => 10.0, // percentual

    /**
     * Time limit to let user pay for the championships before the championship start
     * So if the championship start in 10/02/2015, the users can pay until x days before.
     */
    'payday_limit' => 1,

    /*
    |--------------------------------------------------------------------------
    | Event listeners
    |--------------------------------------------------------------------------
    |
    */
    'listeners' => [
        'Champ\Listeners\ChampionshipVacancyUpdater',
        'Champ\Listeners\CompetitionVacancyUpdater',
        'Champ\Listeners\NotificationListener',
        'Champ\Listeners\AdminNotificationListener'
    ]
];