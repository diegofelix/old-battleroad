<?php

Route::get('teste', function(){
    $mercadopago = App::make('Champ\Billing\MercadoPago\Marketplace');

    if ( ! Input::has('code'))
    {
        return Redirect::to($mercadopago->getAuthenticationUrl('http://champaholic.dev/teste'));
    }

    $response = $mercadopago->getSellerAccessToken(Input::get('code'), 'http://champaholic.dev/teste');

    var_dump($response);
});












Route::get('http', function(){

    $token = "APP_USR-327781618675455-091914-2ef4bd8d7e1267220db0c64636e0c3bb__L_I__-92389140";

    $http = App::make('GuzzleHttp\Client');

    $response = $http->post('https://api.mercadolibre.com/checkout/preferences?access_token=' . $token, [
    // $response = $http->post('http://httpbin.org/post', [
    // $response = $http->post('http://192.168.1.123:8081', [
        'body' => [
            "items" => array(
                array(
                    "title" => "Title of what you are paying for",
                    "currency_id" => "BRL",
                    "category_id" => "Category",
                    "quantity" => 1,
                    "unit_price" => 10.2
                )
            ),
            "marketplace_fee" => 2.29
        ],
        'headers' => [
            'Accept' => 'application/json',
            'Content-type' => 'application/x-www-form-urlencoded',
            'User-Agent' => "MercadoPago PHP SDK v 0.2.1",
        ],
        // 'cert' => "/var/www/answer-stack/vendor/mercadopago/sdk/lib/cacert.pem"
        'verify' => false
    ]);

    dd($response);
});

Route::get('outro', function(){

    $token = "APP_USR-327781618675455-091707-62976329491b6d89fe6ad42932a92b42__B_L__-92389140";
    $refresh_token = "TG-54196e9be4b070d967cb95f2";

    $response = MPRestClient::post("/checkout/preferences?access_token=" . $token,  array(
        "items" => array(
            array(
                "title" => "Title of what you are paying for",
                "currency_id" => "BRL",
                "category_id" => "Category",
                "quantity" => 1,
                "unit_price" => 10.2
            )
        ),
        "marketplace_fee" => 2.29
    ));

    $url = $response['response']['sandbox_init_point'];

    return Redirect::to($url);

});

Route::get('refresh', function(){
    $app_id = "327781618675455";
    $app_secret = "nTpwgusnAxp7P3bjmDGlVHqbxcOXVI7x";
    $response = MPRestClient::post('/oauth/token', http_build_query([
        'grant_type' => 'refresh_token',
        'client_id' => $app_id,
        'client_secret' => $app_secret,
        'refresh_token' => 'TG-541893d0e4b0450be4c41a6f',
    ]), "application/x-www-form-urlencoded");

    dd($response);
});

Route::get('teste_working', function(){
    $app_id = "327781618675455";
    $app_secret = "nTpwgusnAxp7P3bjmDGlVHqbxcOXVI7x";

    if ( ! Input::has('code'))
    {
        return Redirect::to('https://auth.mercadolivre.com.br/authorization?client_id=' . $app_id . '&response_type=code&platform_id=mp');
    }

    $response = MPRestClient::post('/oauth/token', http_build_query([
        'grant_type' => 'authorization_code',
        'client_id' => $app_id,
        'client_secret' => $app_secret,
        'code' => Input::get('code'),
        'redirect_uri' => 'http://champaholic.dev/teste'
    ]), "application/x-www-form-urlencoded");

    dd($response);
});

View::composer('championships.partials.filters', 'Champ\Composers\CompetitionFilterComposer');

// pass through all files in the folder app/routes/ and require here
foreach (File::allFiles(__DIR__.'/routes') as $partial)
{
    require_once $partial->getPathname();
}