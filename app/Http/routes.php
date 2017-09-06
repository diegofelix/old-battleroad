<?php

// view composers
View::composer('championships.partials.filters', 'Champ\Composers\CompetitionFilterComposer');
View::composer('partials._admin_sidebar', 'Champ\Composers\ChampionshipComposer');
// View::composer('admin.championships.games.index', 'Champ\Composers\ChampionshipComposer');
// View::composer('admin.championships.coupons.index', 'Champ\Composers\ChampionshipComposer');
// View::composer('admin.championships.transaction', 'Champ\Composers\ChampionshipComposer');

// pass through all files in the folder app/routes/ and require here
foreach (File::allFiles(__DIR__.'/routes') as $partial)
{
    require $partial->getPathname();
}
