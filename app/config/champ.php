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

    'formats' => [
        // Round Robin
        1 => 'Conhecido aqui no Brasil como pontos corridos onde todos enfrentam todos, podem haver variantes.',
        // Double Elimination
        2 => 'Parecido com mata-mata, porém os jogadores que perderem a primeira vez vão para um série a parte, chamada de losers ( perdedores ). Lá ele terá mais uma chance.',
        // Single Elimination
        3 => 'É o famosos mata-mata, quem perder é eliminado.',
        // Swiss
        4 => 'Esse é um meio termo entre Double Elimination e Round Robin. Mais informações em http://battleroad.uservoice.com/knowledgebase'
    ],

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
        'Champ\Listeners\AdminNotificationListener',
        'Champ\Listeners\NewsletterListListener'
    ]
];