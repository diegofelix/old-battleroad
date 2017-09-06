<?php namespace Champ\Championship\Repositories;

use Champ\Championship\Coupon;

interface CouponRepositoryInterface
{
    /**
     * Saves a Coupon.
     *
     * @param Coupon $coupon
     *
     * @return bool
     */
    public function save(Coupon $coupon);

    /**
     * Creates a Coupon and assing it to a championship.
     *
     * @param array $data
     *
     * @return Model
     */
    public function create($data);

    /**
     * Get a coupon by its code.
     *
     * @param string $code
     *
     * @return Coupon
     */
    public function findByCode($code);

    /**
     * Find a Coupon by User Id.
     *
     * @param int $userId
     *
     * @return Coupon
     */
    public function findByUserId($userId);
}
