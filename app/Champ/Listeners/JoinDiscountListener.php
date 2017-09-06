<?php namespace Champ\Listeners;

use Laracasts\Commander\Events\EventListener;
use Champ\Championship\Events\CouponWasApplied;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Join\Repositories\ItemRepositoryInterface;
use Champ\Join\Status;

class JoinDiscountListener extends EventListener
{
    /**
     * Join Repository.
     *
     * @var JoinRepositoryInterface
     */
    protected $joinRepository;

    /**
     * Item Repository.
     *
     * @var ItemRepositoryInterface
     */
    protected $itemRepository;

    /**
     * Constructor.
     *
     * @param JoinRepositoryInterface $joinRepository
     */
    public function __construct(
        JoinRepositoryInterface $joinRepository,
        ItemRepositoryInterface $itemRepository
    ) {
        $this->joinRepository = $joinRepository;
        $this->itemRepository = $itemRepository;
    }

    /**
     * Apply the discount in join.
     *
     * @param CouponWasApplied $coupon
     */
    public function whenCouponWasApplied(CouponWasApplied $coupon)
    {
        $join = $this->joinRepository->getByCoupon($coupon->coupon);

        $this->applyDiscountOnItems($join, $coupon);

        // if after apply the discount the join change to free
        // then we need to confirm the user imediatly
        if ($join->isFree()) {
            $join->changeStatus(Status::APPROVED);
            $this->joinRepository->save($join);
        }
    }

    /**
     * Apply the discount on items in the join.
     *
     * @param Joim   $join
     * @param Coupon $coupon
     */
    private function applyDiscountOnItems($join, $coupon)
    {
        $couponPrice = $coupon->coupon->price;

        foreach ($join->items as $item) {
            if ($couponPrice > 0) {
                if ($couponPrice < $item->price) {
                    $item->price -= $couponPrice;
                    $this->itemRepository->save($item);
                    break;
                }

                if ($couponPrice >= $item->price) {
                    $couponPrice -= $item->price;
                    $item->price = 0;
                    $this->itemRepository->save($item);
                }
            }
        }
    }
}
