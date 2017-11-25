<?php

namespace Battleroad\Http\Middleware;

use Champ\Championship\Repository;
use Closure;

class ChampionshipOwner
{
    /**
     * @var Repository
     */
    private $championships;

    public function __construct(Repository $championshipRepository)
    {
        $this->championships = $championshipRepository;
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

        $championship = $this->championships->find($id);

        if (!$championship->isOwner(auth()->id())) {
            app()->abort(404);
        }

        if (!auth()->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
