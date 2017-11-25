<?php

namespace Battleroad\Http\Middleware;

use Closure;
use Champ\Championship\Championship;

class NotJoinedYet
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
        // get the id of the intended championship
        $id = $request->segment(3);

        // if the url has no segment, then probaly is a post request
        if (empty($id)) {
            $id = $request->get('id');
        }

        // if came here with no id, then something is wrong.
        if (empty($id)) {
            return abort(404);
        }

        // get the last joined championship
        $joined = auth()->user()->getJoin($id);

        // if founded
        if ($joined) {
            $message = 'Você já está participando desse campeonato.';

            return redirect()->route('join.show', $joined->id)
                ->with('message', $message);
        }

        return $next($request);
    }
}
