<?php namespace Champ\Billing\Pagseguro;

use PHPSC\PagSeguro\Purchases\Subscriptions\Locator as SubscriptionLocator;
use PHPSC\PagSeguro\Purchases\Transactions\Locator as TransactionLocator;

class NotificationHandler
{
    use CredentialsTrait;

    public function __construct()
    {
        $this->startupPagseguro();
    }

    public function handle($command)
    {
        try {
            $service = $command->notificationType == 'preApproval'
                ? new SubscriptionLocator($this->credentials)
                : new TransactionLocator($this->credentials);

            return $service->getByNotification($command->notificationCode);
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }
}
