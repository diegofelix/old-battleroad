<?php

namespace Battleroad\Providers;

use Champ\Account\Events\UserChangedProfile;
use Champ\Account\Events\UserSignedUp;
use Champ\Championship\Events\ChampionshipFinished;
use Champ\Championship\Events\ChampionshipPublished;
use Champ\Championship\Events\CouponWasApplied;
use Champ\Join\Events\JoinCancelled;
use Champ\Join\Events\JoinStatusChanged;
use Champ\Join\Events\UserJoined;
use Champ\Listeners\ChampionshipVacancyUpdater;
use Champ\Listeners\CompetitionVacancyUpdater;
use Champ\Listeners\JoinDiscountListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CouponWasApplied::class => [
            JoinDiscountListener::class,
        ],
        UserJoined::class => [
            ChampionshipVacancyUpdater::class,
            CompetitionVacancyUpdater::class,
            'Champ\Listeners\NotificationListener@whenUserJoined',
        ],
        JoinStatusChanged::class => [
            'Champ\Listeners\NotificationListener@whenJoinStatusChanged',
        ],
        JoinCancelled::class => [
            'Champ\Listeners\NotificationListener@whenJoinCancelled',
        ],
        ChampionshipPublished::class => [
            'Champ\Listeners\AdminNotificationListener@whenChampionshipPublished',
        ],
        ChampionshipFinished::class => [
            'Champ\Listeners\AdminNotificationListener@whenChampionshipFinished',
        ],
        UserChangedProfile::class => [],
        UserSignedUp::class => [],
    ];
}
