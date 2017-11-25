<?php

namespace Champ\Championship\Coupons;

use Champ\Championship\Repository;
use Laracasts\Commander\CommandHandler;
use Champ\Championship\Coupon;

class GenerateCouponCommandHandler implements CommandHandler
{
    /**
     * Championship Repository.
     *
     * @var Repository
     */
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function handle($command)
    {
        $coupon = Coupon::generate($command->championshipId, $command->code, $command->price);

        $this->repository->saveCoupon($coupon);

        return $coupon;
    }
}
