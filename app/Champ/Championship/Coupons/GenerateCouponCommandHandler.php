<?php namespace Champ\Championship\Coupons;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Champ\Championship\Coupon;
use Champ\Championship\Repositories\CouponRepositoryInterface;

class GenerateCouponCommandHandler implements CommandHandler {

    /**
     * Coupon Repository
     *
     * @var CouponRepositoryInterface
     */
    protected $couponRepository;

    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function handle($command)
    {
        $coupon = Coupon::generate($command->championshipId, $command->code, $command->price);

        $this->couponRepository->save($coupon);

        return $coupon;
    }

}