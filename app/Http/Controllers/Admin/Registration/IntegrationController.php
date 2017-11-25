<?php

namespace Battleroad\Http\Controllers\Admin\Registration;

use App;
use Input;
use Redirect;
use Request;

class IntegrationController extends BaseRegistrationController
{
    /**
     * Show a page to user integrate your billing account with the champ.
     *
     * @param int $id
     *
     * @return Response
     */
    public function index($id)
    {
        $championship = $this->repository->find($id);

        return $this->view('admin.register.integration', compact('championship'));
    }

    public function store($id)
    {
        $championship = $this->repository->find($id);

        $championship->token = Input::get('bcash_account');

        $this->repository->save($championship);

        return $this->redirectRoute('admin.register.confirmation', $championship->id);
    }

    public function login($id)
    {
        $currentUrl = Request::url();
        $mercadopago = $this->getMercadoPagoApi();

        if (!Input::has('code')) {
            return Redirect::to($mercadopago->getAuthenticationUrl($currentUrl));
        }

        $response = $mercadopago->getSellerAccessToken(Input::get('code'), $currentUrl);

        $championship = $this->repository->addRefreshToken($id, $response['response']['refresh_token']);

        return $this->view('admin.register.integration', compact('championship'));
    }

    /**
     * Get a mercado pago api instance.
     *
     * @return Champ\Billing\MercadoPago\Marketplace
     */
    public function getMercadoPagoApi()
    {
        return App::make('Champ\Billing\MercadoPago\Marketplace');
    }
}
