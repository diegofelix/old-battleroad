<?php namespace Champ\Join;

class ApplyCouponCommand {

    public $userId;
    public $joinId;
    public $code;

    public function __construct($user_id, $join_id, $code)
    {
        $this->userId = $user_id;
        $this->joinId = $join_id;
        $this->code = $code;
    }

}