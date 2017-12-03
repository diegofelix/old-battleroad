<?php

namespace Battleroad\Http\Middleware;

use Champ\Championship\Repository;
use Closure;

class ChampionshipOwner
{
    /**
     * Championship Repository.
     *
     * @var Repository
     */
    private $repository;

    /**
     * Class constructor.
     *
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->segment(3);

        $championship = $this->repository->find($id);

        if (!$championship->isOwner(auth()->id())) {
            app()->abort(404);
        }

        if (!auth()->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
