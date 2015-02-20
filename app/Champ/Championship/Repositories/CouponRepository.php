<?php namespace Champ\Championship\Repositories;

use Champ\Repositories\Core\AbstractRepository;
use Champ\Championship\Coupon;

class CouponRepository implements CouponRepositoryInterface {

    public function __construct(Coupon $model)
    {
        $this->model = $model;
    }

    /**
     * Saves a Coupon
     *
     * @param  Coupon $coupon
     * @return boolean
     */
    public function save(Coupon $coupon)
    {
        return $coupon->save();
    }

    /**
     * Creates a coupon an assign it to a championship
     *
     * @param  array $data
     * @return Model
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * Find a coupon by its id
     *
     * @param  int $id
     * @return Model
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Delete a Coupon
     *
     * @param  Coupon $coupon
     * @return boolean
     */
    public function delete(Coupon $coupon)
    {
        return $coupon->delete();
    }
}