<?php namespace Champ\Billing\Moip;

use Moip\Moip;
use Champ\Championship\Championship;
use Champ\Join\Join;

class MoipBilling
{
    /**
     * Moip class.
     *
     * @var Moip\Moip
     */
    protected $moip;

    public function __construct(Moip $moip)
    {
        $this->moip = $moip;
    }

    /**
     * Do the payment with Moip.
     *
     * @param PaymentObjectInterface $payment
     *
     * @return mixed
     */
    public function pay(Join $join)
    {
        $this->startupMoip($join);

        // create our id
        $this->moip->setReason('Pagamento: '.$join->championship->title);
        $this->moip->setUniqueID('BTR'.$join->id);

        // set the messages and prices
        $this->calculateTotalPrice($join);

        // generate model
        $this->moip->validate('Basic');
        $this->moip->send();

        return $this->moip->getAnswer();
    }

    private function startupMoip($join)
    {
        // check if the env is production
        if (getenv('MOIP_ENV') == 'test') {
            $this->moip->setEnvironment('test');
        }

        $this->moip->setCredential(array(
            'key' => getenv('MOIP_KEY'),
            'token' => getenv('MOIP_TOKEN'),
        ));
    }

    /**
     * Calculate the price for the championship.
     *
     * @param Join $join
     */
    private function calculateTotalPrice($join)
    {
        $total = 0;

        if ($join->price) {
            // add the current price
            $total = $join->price;
            // set the first message
            $this->moip->addMessage('Entrada: '.$join->championship->name);
        }

        foreach ($join->items as $item) {
            if ($item->price > 0) {
                $this->moip->addMessage('Inscrição: '.$item->competition->game->name);
                $total += $item->price;
            }
        }

        $this->moip->setValue($total);
    }
}
