<?php

namespace Battleroad\Http\Controllers;

use Laracasts\Commander\CommanderTrait;
use Champ\Championship\Exceptions\CouponNotFoundException;
use Champ\Championship\Exceptions\UserAlreadyHasDiscountException;
use Champ\Join\ApplyCouponCommand;

class CouponsController extends BaseController
{
    use CommanderTrait;

    /**
     * Receive a coupon code, process it and apply to the join.
     *
     * @return Response
     */
    public function apply($joinId)
    {
        $input = Input::all();
        $input['user_id'] = Auth::user()->id;
        $input['join_id'] = $joinId;

        try {
            $this->execute(ApplyCouponCommand::class, $input);
        } catch (CouponNotFoundException $e) {
            return $this->redirectBack(['error' => 'Cupon inválido ou já utilizado.']);
        } catch (UserAlreadyHasDiscountException $e) {
            return $this->redirectBack(['error' => 'Você já aplicou um cupon para esse pagamento.']);
        }

        // redirect the user to the location page.
        return $this->redirectRoute('join.show', [$joinId])
            ->with('message', 'Cupom Aplicado com sucesso!');
    }
}
