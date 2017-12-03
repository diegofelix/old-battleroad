<?php

namespace Champ\Join;

use Champ\Championship\Repository;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Champ\Championship\Exceptions\CouponNotFoundException;
use Champ\Championship\Exceptions\UserAlreadyHasDiscountException;

class ApplyCouponCommandHandler implements CommandHandler
{
    use DispatchableTrait;

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
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function handle($command)
    {
        $coupon = $this->repository->findCouponByCode($command->code);

        $this->checkInvalidCoupon($coupon);

        $this->checkUserAlreadyHasDiscount($command, $coupon);

        $coupon->applyFor($command->joinId, $command->userId);

        $this->repository->saveCoupon($coupon);

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
        $coupon = $this->repository->findCouponByUserId($command->userId);

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
