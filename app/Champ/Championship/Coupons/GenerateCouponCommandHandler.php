<?php namespace Champ\Championship\Coupons;

use Laracasts\Commander\CommandHandler;
use Champ\Championship\Coupon;
use Champ\Championship\Repositories\CouponRepository;

class GenerateCouponCommandHandler implements CommandHandler
{
    /**
     * Coupon Repository.
     *
     * @var CouponRepository
     */
    protected $couponRepository;

    public function __construct(CouponRepository $couponRepository)
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
