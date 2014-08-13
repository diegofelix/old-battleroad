<?php namespace Champ\Presenters;

use Laracasts\Presenter\Presenter;
use Champ\Championship\Competition;
use Champ\Traits\UserPrice;

class CompetitionPresenter extends Presenter {
    use UserPrice;
}