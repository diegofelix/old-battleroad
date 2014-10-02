<?php namespace Admin\Registration;

use App;
use Input;
use Redirect;
use Request;

class IntegrationController extends BaseRegistrationController {

    /**
     * Show a page to user integrate your billing account with the champ
     *
     * @param  int $id
     * @return Response
     */
    public function index($id)
    {
        $championship = $this->championshipRepository->find($id);

        return $this->view('admin.register.integration', compact('championship'));
    }

    public function login()
    {
        $currentUrl = Request::url();

        $mercadopago = App::make('Champ\Billing\MercadoPago\Marketplace');

        if ( ! Input::has('code'))
        {
            return Redirect::to($mercadopago->getAuthenticationUrl($currentUrl));
        }

        $response = $mercadopago->getSellerAccessToken(Input::get('code'), $currentUrl);

        var_dump($response);
    }
}