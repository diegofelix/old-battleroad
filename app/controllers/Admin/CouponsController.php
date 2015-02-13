<?php namespace Admin;

use BaseController;
use Champ\Championship\Repositories\CouponRepositoryInterface;
use Champ\Services\KeyGen;
use Request;

class CouponsController extends BaseController {

    /**
     * KeyGen
     *
     * @var KeyGen
     */
    protected $keyGen;

    /**
     * Coupon Repository
     *
     * @var CouponRepositoryInterface
     */
    protected $couponRepository;

    public function __construct(
        CouponRepositoryInterface $couponRepository,
        KeyGen $keyGen
    ) {
        $this->couponRepository = $couponRepository;
        $this->keyGen = $keyGen;
    }

    /**
     * Show a view to generate the coupons
     *
     * @return Response
     */
    public function index()
    {
        return $this->view('admin.championships.coupons.index');
    }

    /**
     * Generate a coupon for the user
     *
     * @param  int $championshipId
     * @return Response
     */
    public function generate($championshipId)
    {
        $this->couponRepository->create([
            'championship_id' => $championshipId,
            'code' => $this->keyGen->make()
        ]);

        return $this->redirectRoute('admin.championships.coupons', $championshipId);
    }

}