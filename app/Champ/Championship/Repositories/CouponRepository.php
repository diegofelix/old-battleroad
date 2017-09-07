<?php namespace Champ\Championship\Repositories;

use Champ\Championship\Coupon;

class CouponRepository
{
    public function __construct(Coupon $model)
    {
        $this->model = $model;
    }

    /**
     * Saves a Coupon.
     *
     * @param Coupon $coupon
     *
     * @return bool
     */
    public function save(Coupon $coupon)
    {
        return $coupon->save();
    }

    /**
     * Creates a coupon an assign it to a championship.
     *
     * @param array $data
     *
     * @return Model
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * Find a coupon by its id.
     *
     * @param int $id
     *
     * @return Model
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Delete a Coupon.
     *
     * @param Coupon $coupon
     *
     * @return bool
     */
    public function delete(Coupon $coupon)
    {
        return $coupon->delete();
    }

    /**
     * Get a coupon by its code and checks if the coupon is able to be used.
     *
     * @param string $code
     *
     * @return Coupon
     */
    public function findByCode($code)
    {
        return $this->model->whereCode($code)
            ->whereNull('user_id')
            ->first();
    }

    /**
     * Find a Coupon by User Id.
     *
     * @param int $userId
     *
     * @return Coupon
     */
    public function findByUserId($userId)
    {
        return $this->model->whereUserId($userId)->first();
    }
}
