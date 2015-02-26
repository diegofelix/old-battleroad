<?php namespace Champ\Join;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Join\Repositories\ItemRepositoryInterface;
use Champ\Championship\Repositories\CouponRepositoryInterface;
use Champ\Championship\Exceptions\CouponNotFoundException;
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

        if ( ! $coupon) throw new CouponNotFoundException("Invalid Coupon Code.");

        $coupon->applyFor($command->joinId, $command->userId);

        $this->couponRepository->save($coupon);

        $this->dispatchEventsFor($coupon);

        return $coupon;
    }
}