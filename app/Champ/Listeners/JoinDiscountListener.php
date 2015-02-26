<?php namespace Champ\Listeners;

use Laracasts\Commander\Events\EventListener;
use Champ\Championship\Events\CouponWasApplied;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Join\Repositories\ItemRepositoryInterface;

class JoinDiscountListener extends EventListener {

    /**
     * Join Repository
     *
     * @var JoinRepositoryInterface
     */
    protected $joinRepository;

    /**
     * Item Repository
     *
     * @var ItemRepositoryInterface
     */
    protected $itemRepository;

    /**
     * Constructor
     *
     * @param JoinRepositoryInterface $joinRepository
     */
    public function __construct(
        JoinRepositoryInterface $joinRepository,
        ItemRepositoryInterface $itemRepository
    )
    {
        $this->joinRepository = $joinRepository;
        $this->itemRepository = $itemRepository;
    }

    /**
     * Apply the discount in join
     *
     * @param  CouponWasApplied $coupon
     * @return void
     */
    public function whenCouponWasApplied(CouponWasApplied $coupon)
    {
        $join = $this->joinRepository->getByCoupon($coupon->coupon);

        // cache the coupon price
        $couponPrice = $coupon->coupon->price;

        foreach ($join->items as $item)
        {
            if ($couponPrice > 0)
            {
                if ($couponPrice < $item->price)
                {
                    $item->price -= $couponPrice;
                    $this->itemRepository->save($item);
                    break;
                }

                if ($couponPrice >= $item->price)
                {
                    $couponPrice -= $item->price;
                    $item->price = 0;
                    $this->itemRepository->save($item);
                }
            }
        }
    }
}
