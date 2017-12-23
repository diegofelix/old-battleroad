<?php

namespace Battleroad\Http\Controllers\Admin;

use Battleroad\Champ\Championship\Jobs\GenerateCoupon;
use Illuminate\Http\Request;
use Champ\Services\KeyGen;
use Battleroad\Http\Controllers\BaseController;
use Champ\Championship\Repository;

class CouponsController extends BaseController
{
    /**
     * KeyGen.
     *
     * @var KeyGen
     */
    protected $keyGen;

    /**
     * Championship Repository.
     *
     * @var Repository
     */
    protected $repository;

    /**
     * Class constructor.
     *
     * @param Repository $repository
     * @param KeyGen     $keyGen
     */
    public function __construct(Repository $repository, KeyGen $keyGen)
    {
        $this->repository = $repository;
        $this->keyGen = $keyGen;
    }

    /**
     * Show a view to generate the coupons.
     *
     * @return Response
     */
    public function index($id)
    {
        $championship = $this->repository->find($id);

        return $this->view('admin.championships.coupons.index', compact('championship'));
    }

    /**
     * Generate a coupon for the user.
     *
     * @param int     $championshipId
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generate($championshipId, Request $request)
    {
        $this->dispatch(new GenerateCoupon(
            $championshipId,
            $this->keyGen->make(),
            $request->get('price')
        ));

        return $this->redirectRoute('admin.championships.coupons', $championshipId);
    }

    /**
     * Delete a coupon if this coupon has no user.
     *
     * @param int     $id
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Request $request)
    {
        $coupon = $this->repository->findCoupon($request->get('id'));

        // a little verification to check if the user is the owner
        if ($coupon->championship_id == $id && empty($coupon->user_id)) {
            $this->repository->deleteCoupon($coupon);
        }

        return $this->redirectBack(['message' => 'Cupon excluído com sucesso!']);
    }
}
