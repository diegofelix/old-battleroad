<?php namespace Champ\Championship\Coupons;

use Champ\Forms\CreateCouponForm;

class GenerateCouponValidator {

    /**
     * Create Coupon Validator
     *
     * @var CreateCouponFormForm
     */
    protected $form;

    public function __construct(CreateCouponForm $form)
    {
        $this->form = $form;
    }

    /**
     * Validates the coupon creation
     *
     * @param  CreateCouponCommand $command
     * @return void
     */
    public function validate($command)
    {
        $this->form->validate([
            'championship_id' => $command->championshipId,
            'code' => $command->code,
            'price' => $command->price
        ]);
    }

}