<?php
namespace Battleroad\Http\Middleware;

use Closure;

class ChampionshipOwner
{
    /**
     * @var ChampiponshipRepository
     */
    private $championshipRepository;

    public function __construct(ChampiponshipRepository $championshipRepository)
    {
        $this->championshipRepository = $championshipRepository;
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
        $id = $requestt->segment(3);

        $championship = $this->championships->find($id);

        if (!$championship->isOwner(Auth::id())) {
            app()->abort(404);
        }

        if ($this->auth->check()) {
            return new redirect('/home');
        }

        return $next($request);
    }
}
