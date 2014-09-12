<?php

// Route::get('teste', function(){
//     // $mp = new MP("327781618675455", "nTpwgusnAxp7P3bjmDGlVHqbxcOXVI7x");

//     // $accessToken = $mp->get_access_token();

//     // print_r ($accessToken);
//     $YOUR_APP_ID = 327781618675455;
//     return Redirect::to('https://auth.mercadolibre.com.ar/authorization?client_id=' . $YOUR_APP_ID . '&response_type=code&platform_id=mp');

//     // TG-540f30d1e4b06521771f2f3c
// //     curl -H "Accept: application/json" -H "Content-type: application/x-www-form-urlencoded" -X POST -d \
// // "grant_type=authorization_code&client_id=327781618675455&client_secret=nTpwgusnAxp7P3bjmDGlVHqbxcOXVI7x&code=TG-540f30d1e4b06521771f2f3c&redirect_uri=MARKETPLACE_REDIRECT_URI" \
// // "https://api.mercadolibre.com/oauth/token" --cacert cacert.pem -3
// });

View::composer('championships.partials.filters', 'Champ\Composers\CompetitionFilterComposer');

// pass through all files in the folder app/routes/ and require here
foreach (File::allFiles(__DIR__.'/routes') as $partial)
{
    require_once $partial->getPathname();
}