<?php namespace Champ\Billing\Core;

interface NotificationListenerInterface {

    /**
     * This method will be called when the site receives a notification
     *
     * @param   $response
     * @return Response
     */
    public function notificationReceived($data);

    /**
     * When occurs an error, this method will be called
     *
     * @param   $error
     * @return Response
     */
    public function notificationError($error);

}