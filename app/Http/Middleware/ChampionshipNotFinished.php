<?php

namespace Battleroad\Http\Middleware;

use Closure;
use Champ\Championship\Championship;
use Champ\Join\Repositories\JoinRepository;

class ChampionshipNotFinished
{
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

        if (Championship::checkFinished($id)) {
            session()->flash('error', 'Esse campeonato já aconteceu ou está em andamento, você não pode mais participar.');

            return redirect()->route('championships.show', $id);
        }

        return $next($request);
    }
}
