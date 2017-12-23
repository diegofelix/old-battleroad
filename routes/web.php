<?php

// view composers
View::composer('championships.partials.filters', 'Champ\Composers\CompetitionFilterComposer');
View::composer('partials._admin_sidebar', 'Champ\Composers\ChampionshipComposer');

require 'admin.php';
require 'championship.php';
require 'join.php.php';
require 'pages.php.php';
require 'register.php.php';
require 'user.php';
