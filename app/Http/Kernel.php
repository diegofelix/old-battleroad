<?php

namespace Battleroad\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Battleroad\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Battleroad\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Battleroad\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Battleroad\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \Battleroad\Http\Middleware\RedirectIfAuthenticated,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'championship_owner' => \Battleroad\Http\Middleware\ChampionshipOwner::class,
        'join_owner' => \Battleroad\Http\Middleware\JoinOwner::class,
        'no_profile' => \Battleroad\Http\Middleware\NoProfile::class,
        'championship_not_published' => \Battleroad\Http\Middleware\ChampionshipNotPublished::class,
        'championship_published' => \Battleroad\Http\Middleware\ChampionshipPublished::class,
        'championship_not_finished' => \Battleroad\Http\Middleware\ChampionshipNotFinished::class,
        'not_joined_yet' => \Battleroad\Http\Middleware\NotJoinedYet::class,
        'has_competition' => \Battleroad\Http\Middleware\HasCompetition::class,
    ];
}
