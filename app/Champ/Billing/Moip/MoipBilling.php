<?php namespace Champ\Billing\Moip;

use Moip\Moip;
use Champ\Account\User;
use Champ\Championship\Championship;

class MoipBilling {

    /**
     * Moip class
     *
     * @var Moip\Moip
     */
    protected $moip;

    public function __construct(Moip $moip)
    {
        $this->moip = $moip;
    }

    /**
     * Do the payment with Moip
     *
     * @param  PaymentObjectInterface $payment
     * @return mixed
     */
    public function pay(Championship $championship, User $user)
    {
        // check if the env is production
        if (getenv('MOIP_ENV') == 'test')
        {
            $this->moip->setEnvironment('test');
        }

        $this->moip->setCredential(array(
            'key' => getenv('MOIP_KEY'),
            'token' => getenv('MOIP_TOKEN')
        ));

        $this->moip->setUniqueID(false);
        $this->moip->setValue($championship->price);
        $this->moip->setReason('Pagamento: ' . $championship->title);
        $this->moip->addComission(
            'Valor líquido',
            'diegoflx.oliveira@gmail.com',
            getenv('BILLING_COMISSION'),
            getenv('BILLING_PERCENT'),
            getenv('BILLING_RATE')
        );

        $this->moip->validate('Basic');
        $this->moip->send();

        return $this->moip->getAnswer();
    }

}