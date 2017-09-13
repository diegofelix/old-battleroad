<?php

namespace Battleroad\Http\Middleware;

use Closure;
use Champ\Championship\Championship;
use Champ\Join\Repositories\JoinRepository;

class HasCompetition
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
        $id = $request->get('id');

        if (!$request->has('competitions') || sizeof($request->get('competitions')) <= 0) {
            $message = "Você precisa selecionar ao menos um jogo do campeonato.";

            return redirect()->route('join.create', $id)
                ->with('error', $message);
        }

        return $next($request);
    }
}
