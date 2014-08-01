<?php

// Championships
Route::resource('championships', 'ChampionshipsController', ['only' => ['index', 'show']]);