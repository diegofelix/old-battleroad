<?php
namespace Battleroad\Http\Middleware;

use Closure;

class NoProfile
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
        if (auth()->user()->profile) {
            return redirect('/');
        }

        return $next($request);
    }
}
