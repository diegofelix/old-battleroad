<?php

Route::get('teste', function(){
    Mail::send('emails.test', [], function($message)
    {
        $message->to('honor0v@gmail.com')->subject('Testando Email');
    });
});

View::composer('championships.partials.filters', 'Champ\Composers\CompetitionFilterComposer');

// pass through all files in the folder app/routes/ and require here
foreach (File::allFiles(__DIR__.'/routes') as $partial)
{
    require_once $partial->getPathname();
}