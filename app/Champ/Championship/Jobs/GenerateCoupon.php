<?php

namespace Battleroad\Champ\Championship\Jobs;

use Battleroad\Jobs\Job;
use Champ\Championship\Coupon;
use Champ\Championship\Repository;

class GenerateCoupon extends Job
{
    /**
     * @var int
     */
    public $championshipId;

    /**
     * @var string
     */
    public $code;

    /**
     * @var int
     */
    public $price;

    /**
     * Constructor.
     *
     * @param int    $championship_id
     * @param string $code
     * @param int    $price
     */
    public function __construct($championship_id, $code, $price)
    {
        $this->championshipId = $championship_id;
        $this->code = $code;
        $this->price = $price;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Repository $repository)
    {
        $coupon = Coupon::generate($this->championshipId, $this->code, $this->price);

        $repository->saveCoupon($coupon);

        return $coupon;
    }
}
