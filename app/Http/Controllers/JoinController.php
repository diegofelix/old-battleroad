<?php

namespace Battleroad\Http\Controllers;

use Champ\Join\Jobs\Join as JoinJob;
use Champ\Championship\Repository;
use Illuminate\Http\Request;
use Champ\Join\Join;
use Champ\Join\Repositories\JoinRepository;

class JoinController extends BaseController
{
    /**
     * Championship Repository.
     *
     * @var Repository
     */
    protected $repository;

    /**
     * Join Repository.
     *
     * @var JoinRepository
     */
    protected $joinRepository;

    /**
     * Class constructor.
     *
     * @param Repository     $repository
     * @param JoinRepository $joinRepository
     */
    public function __construct(
        Repository $repository,
        JoinRepository $joinRepository
    ) {
        $this->repository = $repository;
        $this->joinRepository = $joinRepository;
    }

    /**
     * Show a form to register to championship.
     *
     * @param int $id
     *
     * @return Response
     */
    public function index($id)
    {
        $championship = $this->repository->find($id);

        return $this->view('join.index', compact('championship'));
    }

    /**
     * Subscribe the logged user to the championship.
     *
     * @return Response
     */
    public function register(Request $request)
    {
        $request->merge([
            'user' => auth()->user(),
            'championship' => $this->repository->find($request->get('id')),
        ]);

        $join = $this->dispatch(JoinJob::class);

        // redirect the user to the location page.
        return $this->redirectRoute('join.show', [$join->id]);
    }

    /**
     * Show all Join data.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $join = $this->findAJoinById($id);
        $token = $this->encodedFields($join);

        return $this->view('join.show', compact('join', 'token'));
    }

    /**
     * After the user paid for join, he will return back
     * here, with some information. So, show some helpful message =).
     *
     * @param int $id
     *
     * @return Response
     */
    public function returned($id)
    {
        // $join = $this->joinRepository->find($id);

        // $join->token = Input::get('id_transacao');

        // $this->joinRepository->save($join);

        return $this->redirectRoute('join.show', $id)
            ->with(['message' => 'Parabéns, você está quase confirmado no campeonato!']);
    }

    /**
     * Payment.
     *
     * @return Response
     */
    public function payment($id)
    {
        $join = $this->findAJoinById($id);

        return $this->billing->invoice($join, $this);
    }

    /**
     * This method will be called when the user is allowed to pay.
     *
     * @param   $response
     *
     * @return Response
     */
    public function paymentAllowed($response, Join $join)
    {
        $join->token = $response->getCode();

        $this->joinRepository->save($join);

        return $this->redirectTo($response->getRedirectionUrl());
    }

    /**
     * When occurs an error, this method will be called.
     *
     * @param   $error
     *
     * @return Response
     */
    public function paymentError($error)
    {
        return $this->redirectBack(['error' => $error]);
    }

    /**
     * Find a joined user by the join id.
     *
     * @param int $id
     *
     * @return Join
     */
    private function findAJoinById($id)
    {
        return $this->joinRepository->find($id, ['Championship', 'items.competition.game']);
    }

    private function encodedFields($join)
    {
        $fields = [
            'email_loja' => getenv('BCASH_ACCOUNT'),
            'id_pedido' => $join->id,
            'email' => $join->user->email,
            'nome' => str_replace(' ', '', $join->user->name),
            'email_dependente_1' => $join->championship->token,
            'valor_dependente_1' => $join->present()->totalPrice,
            'url_retorno' => route('join.returned', $join->id),
            'url_aviso' => route('bcash'),
        ];

        foreach ($join->items as $key => $item) {
            $count = $key + 1;

            $fields['produto_codigo_'.$count] = $item->id;
            $fields['produto_descricao_'.$count] = str_replace(' ', '', 'Inscrição: '.$item->competition->game->name);
            $fields['produto_qtde_'.$count] = 1;
            $fields['produto_valor_'.$count] = $item->price;
        }

        // sort by the key
        ksort($fields);

        $string = http_build_query($fields);

        // dd(md5($string.getenv('BCASH_TOKEN')));

        return md5($string.getenv('BCASH_TOKEN'));
    }
}
