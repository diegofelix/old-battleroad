<?php

namespace Battleroad\Http\Controllers;

use Auth;
use Champ\Join\InvalidChampionshipForCoupon;
use Champ\Join\Jobs\ApplyCoupon;
use Illuminate\Http\Request;
use Input;
use Laracasts\Commander\CommanderTrait;
use Champ\Championship\Exceptions\CouponNotFoundException;
use Champ\Championship\Exceptions\UserAlreadyHasDiscountException;

class CouponsController extends BaseController
{
    use CommanderTrait;

    /**
     * Receive a coupon code, process it and apply to the join.
     *
     * @param int     $joinId
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function apply($joinId, Request $request)
    {
        try {
            $this->dispatch(new ApplyCoupon(
                $request->user()->id,
                $joinId,
                $request->get('code')
            ));
        } catch (CouponNotFoundException $e) {
            return $this->redirectBack(['error' => 'Cupom inválido ou já utilizado.']);
        } catch (UserAlreadyHasDiscountException $e) {
            return $this->redirectBack(['error' => 'Você já aplicou um cupom para esse pagamento.']);
        } catch (InvalidChampionshipForCoupon $e) {
            return $this->redirectBack(['error' => 'Cupom inválido ou já utilizado.']);
        }

        // redirect the user to the location page.
        return $this->redirectRoute('join.show', [$joinId])
            ->with('message', 'Cupom Aplicado com sucesso!');
    }
}
