<?php namespace Champ\Join;

use Illuminate\Support\MessageBag;

class UserAlreadyJoinedException extends \Exception {

    /**
     * @var mixed
     */
    protected $errors;

    /**
     * @param string $error
     */
    function __construct($error)
    {
        $this->errors = new MessageBag(['email' => $error]);

        parent::__construct($error);
    }

    /**
     * Get form validation errors
     *
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

}