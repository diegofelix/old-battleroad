<?php

namespace Battleroad\Http\Middleware;

use Closure;
use Champ\Championship\Championship;
use Champ\Join\Repositories\JoinRepository;

class ChampionshipNotPublished
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

        if (Championship::checkPublished($id)) {
            session()->flash('error', 'Você não pode alterar um campeonato já publicado.');

            return redirect('/');
        }

        return $next($request);
    }
}
