<?php namespace Champ\Join;

class UpdateJoinCommand {

    public $notificationType;
    public $notificationCode;

    public function __construct($notificationType, $notificationCode)
    {
        $this->notificationType = $notificationType;
        $this->notificationCode = $notificationCode;
    }

}