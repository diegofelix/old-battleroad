<?php namespace Champ\Join;

use Champ\Forms\ApplyCouponForm;

class ApplyCouponValidator {

    /**
     * Apply Coupon Validator
     *
     * @var ApplyCouponForm
     */
    protected $form;

    public function __construct(ApplyCouponForm $form)
    {
        $this->form = $form;
    }

    public function validate($command)
    {
        $this->form->validate([
            'price' => $command->price
        ]);
    }

}