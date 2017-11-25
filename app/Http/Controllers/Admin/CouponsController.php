<?php

namespace Battleroad\Http\Controllers\Admin;

use Input;
use Champ\Services\KeyGen;
use Laracasts\Commander\CommanderTrait;
use Battleroad\Http\Controllers\BaseController;
use Champ\Championship\Coupons\GenerateCouponCommand;
use Champ\Championship\Repositories\CouponRepository;
use Champ\Championship\Repository;

class CouponsController extends BaseController
{
    use CommanderTrait;

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
     * @param int $championshipId
     *
     * @return Response
     */
    public function generate($championshipId)
    {
        $input = [
            'championship_id' => $championshipId,
            'code' => $this->keyGen->make(),
            'price' => Input::get('price'),
        ];

        $this->execute(GenerateCouponCommand::class, $input);

        return $this->redirectRoute('admin.championships.coupons', $championshipId);
    }

    /**
     * Delete a coupon if this coupon has no user.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $coupon = $this->repository->findCoupon(Input::get('id'));

        // a little verification to check if the user is the owner
        if ($coupon->championship_id == $id && empty($coupon->user_id)) {
            $this->repository->deleteCoupon($coupon);
        }

        return $this->redirectBack(['message' => 'Cupon excluído com sucesso!']);
    }
}
