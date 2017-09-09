<?php

namespace Battleroad\Http\Middleware;

use Closure;
use Champ\Championship\Repositories\ChampionshipRepository;

class ChampionshipOwner
{
    /**
     * @var ChampiponshipRepository
     */
    private $championships;

    public function __construct(ChampionshipRepository $championshipRepository)
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
