<?php

// view composers
View::composer('championships.partials.filters', 'Champ\Composers\CompetitionFilterComposer');
View::composer('partials._admin_sidebar', 'Champ\Composers\ChampionshipComposer');

require 'admin.php';
require 'championship.php';
require 'join.php';
require 'pages.php';
require 'register.php';
require 'user.php';
