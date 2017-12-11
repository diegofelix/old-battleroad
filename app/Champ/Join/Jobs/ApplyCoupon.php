<?php
namespace Champ\Join\Jobs;

use Battleroad\Jobs\Job;
use Champ\Championship\Coupon;
use Champ\Championship\Exceptions\CouponNotFoundException;
use Champ\Championship\Exceptions\UserAlreadyHasDiscountException;
use Champ\Championship\Repository;
use Champ\Join\Join;
use Champ\Join\InvalidChampionshipForCoupon;
use Illuminate\Contracts\Bus\SelfHandling;

class ApplyCoupon extends Job implements SelfHandling
{
    /**
     * @var int
     */
    public $userId;

    /**
     * @var int
     */
    public $joinId;

    /**
     * @var string
     */
    public $code;

    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @param int    $userId
     * @param int    $joinId
     * @param string $code
     */
    public function __construct($userId, $joinId, $code)
    {
        $this->userId = $userId;
        $this->joinId = $joinId;
        $this->code = $code;
        $this->repository = app(Repository::class);
    }

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $coupon = $this->repository->findCouponByCode($this->code);

        $this->validateCoupon($coupon);

        $coupon->applyFor($this->joinId, $this->userId);

        $this->repository->saveCoupon($coupon);

        return $coupon;
    }

    /**
     * Do some validations in the given coupon.
     *
     *
     * @param Coupon|null $coupon
     *
     * @throws CouponNotFoundException
     * @throws InvalidChampionshipForCoupon
     * @throws UserAlreadyHasDiscountException
     */
    private function validateCoupon(Coupon $coupon = null)
    {
        $this->checkInvalidCoupon($coupon);

        $this->checkCouponCanBeApplied($coupon);

        $this->checkUserAlreadyHasDiscount();
    }

    /**
     * Check if the user already had a coupon applied to the join.
     *
     * @throws UserAlreadyHasDiscountException
     */
    private function checkUserAlreadyHasDiscount()
    {
        $coupon = $this->repository->getCouponsForUsedInJoin($this->userId, $this->joinId);

        if ($coupon) {
            throw new UserAlreadyHasDiscountException('The user already has a coupon applied.');
        }
    }

    /**
     * Check if is a valid coupon.
     *
     * @param Coupon|null $coupon
     *
     * @throws CouponNotFoundException
     */
    private function checkInvalidCoupon($coupon = null)
    {
        if (!$coupon) {
            throw new CouponNotFoundException('Invalid Coupon Code.');
        }
    }

    /**
     * Check if the coupon can be applied to this join.
     *
     * @param Coupon $coupon
     *
     * @throws InvalidChampionshipForCoupon
     */
    private function checkCouponCanBeApplied(Coupon $coupon = null)
    {
        $join = Join::find($this->joinId);

        if ($coupon->championship_id != $join->championship_id) {
            throw new InvalidChampionshipForCoupon(
                'This coupon belongs to another championship.'
            );
        }
    }
}
