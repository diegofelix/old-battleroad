<?php

namespace Battleroad\Http\Middleware;

use Closure;
use Champ\Championship\Championship;

class ChampionshipPublished
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

        if (!Championship::checkPublished($id)) {
            session()->flash('error', 'Esse campeonato ainda não foi publicado, termine de registra-lo.');

            return redirect()->route('admin.register.games');
        }

        return $next($request);
    }
}
