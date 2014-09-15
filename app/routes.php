<?php

Route::get('outro', function(){

    $response = MPRestClient::post("/checkout/preferences?access_token=" . 'APP_USR-327781618675455-091512-dd9bb9d0fcc54fd5f878ce936d2ae799__C_K__-92389140',  array(
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

Route::get('teste', function(){
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