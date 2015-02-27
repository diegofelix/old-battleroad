<?php namespace Champ\Join;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Join\Repositories\ItemRepositoryInterface;
use Champ\Championship\Repositories\CouponRepositoryInterface;
use Champ\Championship\Exceptions\CouponNotFoundException;
use Champ\Championship\Exceptions\UserAlreadyHasDiscountException;
use Champ\Join\Status;

class ApplyCouponCommandHandler implements CommandHandler {

    /**
     * Coupon Repository
     */
    protected $couponRepository;

    use DispatchableTrait;

    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function handle($command)
    {
        $coupon = $this->couponRepository->findByCode($command->code);

        $this->checkInvalidCoupon($coupon);

        $this->checkUserAlreadyHasDiscount($command, $coupon);

        $coupon->applyFor($command->joinId, $command->userId);

        $this->couponRepository->save($coupon);

        $this->dispatchEventsFor($coupon);

        return $coupon;
    }

    /**
     * Check if the user already had a coupon applied to the join
     *
     * @param  ApplyDiscountCommand $command
     * @param  Coupon $coupon
     * @return void
     */
    private function checkUserAlreadyHasDiscount($command, $coupon)
    {
        $coupon = $this->couponRepository->findByUserId($command->userId);

        if ($coupon && $coupon->join_id == $command->joinId)
        {
            throw new UserAlreadyHasDiscountException("The user already has a coupon applied.");
        }
    }

    /**
     * Check if is a valid coupon
     *
     * @param  Coupon $coupon
     * @return void
     */
    private function checkInvalidCoupon($coupon = null)
    {
        if ( ! $coupon) throw new CouponNotFoundException("Invalid Coupon Code.");
    }
}