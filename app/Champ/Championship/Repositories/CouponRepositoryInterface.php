<?php namespace Champ\Championship\Repositories;

use Champ\Repositories\Core\RepositoryInterface;
use Champ\Championship\Coupon;

interface CouponRepositoryInterface {

    /**
     * Saves a Coupon
     *
     * @param  Coupon $coupon
     * @return boolean
     */
    public function save(Coupon $coupon);

    /**
     * Creates a Coupon and assing it to a championship
     *
     * @param  array $data
     * @return Model
     */
    public function create($data);
}