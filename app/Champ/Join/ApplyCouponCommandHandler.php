<?php

namespace Champ\Join;

use Champ\Championship\Repository;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Champ\Championship\Exceptions\CouponNotFoundException;
use Champ\Championship\Exceptions\UserAlreadyHasDiscountException;

class ApplyCouponCommandHandler implements CommandHandler
{
    /**
     * Coupon Repository.
     */
    protected $championships;

    use DispatchableTrait;

    public function __construct(Repository $championshipRepository)
    {
        $this->championships = $championshipRepository;
    }

    public function handle($command)
    {
        $coupon = $this->championships->findCouponByCode($command->code);

        $this->checkInvalidCoupon($coupon);

        $this->checkUserAlreadyHasDiscount($command, $coupon);

        $coupon->applyFor($command->joinId, $command->userId);

        $this->championships->saveCoupon($coupon);

        $this->dispatchEventsFor($coupon);

        return $coupon;
    }

    /**
     * Check if the user already had a coupon applied to the join.
     *
     * @param ApplyDiscountCommand $command
     * @param Coupon               $coupon
     */
    private function checkUserAlreadyHasDiscount($command, $coupon)
    {
        $coupon = $this->championships->findCouponByUserId($command->userId);

        if ($coupon && $coupon->join_id == $command->joinId) {
            throw new UserAlreadyHasDiscountException('The user already has a coupon applied.');
        }
    }

    /**
     * Check if is a valid coupon.
     *
     * @param Coupon $coupon
     */
    private function checkInvalidCoupon($coupon = null)
    {
        if (!$coupon) {
            throw new CouponNotFoundException('Invalid Coupon Code.');
        }
    }
}
