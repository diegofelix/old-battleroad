<?php
namespace Battleroad\Http\Controllers\Admin;

use Input;
use Champ\Services\KeyGen;
use Laracasts\Commander\CommanderTrait;
use Battleroad\Http\Controllers\BaseController;
use Champ\Championship\Coupons\GenerateCouponCommand;
use Champ\Championship\Repositories\CouponRepositoryInterface;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;

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
     * @var Champ\Championship\Repositories\ChampionshipRepositoryInterface
     */
    protected $championshipRepository;

    /**
     * Coupon Repository.
     *
     * @var CouponRepositoryInterface
     */
    protected $couponRepository;

    public function __construct(
        ChampionshipRepositoryInterface $championshipRepository,
        CouponRepositoryInterface $couponRepository,
        KeyGen $keyGen
    ) {
        $this->championshipRepository = $championshipRepository;
        $this->couponRepository = $couponRepository;
        $this->keyGen = $keyGen;
    }

    /**
     * Show a view to generate the coupons.
     *
     * @return Response
     */
    public function index($id)
    {
        $championship = $this->championshipRepository->find($id);

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
        $coupon = $this->couponRepository->find(Input::get('id'));

        // a little verification to check if the user is the owner
        if ($coupon->championship_id == $id && empty($coupon->user_id)) {
            $this->couponRepository->delete($coupon);
        }

        return $this->redirectBack(['message' => 'Cupon excluído com sucesso!']);
    }
}
