<?php namespace Champ\Presenters;

use Carbon\Carbon;
use Champ\Championship\Championship;
use Champ\Join\Status;
use Champ\Traits\UserPrice;
use Laracasts\Presenter\Presenter;
use Michelf\Markdown;

class ChampionshipPresenter extends Presenter
{
    use UserPrice;

    /**
     * Return the date with diff for humans translated to pt-br.
     *
     * @return string
     */
    public function daysLeft()
    {
        // get the date based on brazilian time
        $now = Carbon::now('America/Sao_Paulo');

        // get the difference in days from now to the start of the event
        $days = $this->event_start->diffInDays($now);

        // check if the diff is zero, meaning the champ is today!
        if ($days == 0) {
            return 'Hoje';
        }

        // if is greater then one, then we have to plurarize the output.
        // the line put an s in our words
        $plural = ($days > 1) ? 's' : '';

        // finaly return the formatted date
        return "{$days} Dia{$plural} para o início do campeonato.";
    }

    /**
     * Return a piece of the description.
     *
     * @return string
     */
    public function shortDescription()
    {
        return substr($this->description, 0, 160).'...';
    }

    /**
     * Return a text transformed to markdown.
     *
     * @return string
     */
    public function markdownDescription()
    {
        return $this->getMarkdown()->defaultTransform($this->description);
    }

    /**
     * Return a clean description to the admin user.
     *
     * @return string
     */
    public function cleanDescription()
    {
        $description = $this->markdownDescription();

        return strip_tags($description);
    }

    /**
     * Instantiate a Markdown parser.
     *
     * @return Markdown
     */
    private function getMarkdown()
    {
        return new Markdown();
    }

    public function banner()
    {
        $stream = $this->stream;

        if ($this->started() && !empty($stream)) {
            return 'twitch';
        }

        return 'banner';
    }

    /**
     * Check if the championships is ocurring now.
     *
     * @return bool
     */
    public function started()
    {
        return Carbon::now()->gte($this->event_start);
    }

    // /**
    //  * Show the vacancy limit for the championship
    //  *
    //  * @return string
    //  */
    // public function slotsRemaining()
    // {
    //     if ($this->limit > 900000) return 'Sem limite';

    //     if ($this->trueLimit == 1) return '1 Vaga restantes';

    //     if ($this->limit > 1) return $this->limit . ' Vagas restantes';

    //     return 'Vagas esgotadas';
    // }

    /**
     * Show the quantity of games for a event.
     *
     * @return string
     */
    public function countCompetitions()
    {
        $count = $this->competitions->count();
        $text = $count.' jogo';

        if ($count > 1) {
            $text .= 's';
        }

        return $text;
    }

    public function lowestPrice()
    {
        $lowestPrice = $this->competitions->first()->price;

        foreach ($this->competitions as $competition) {
            if ($competition->price < $lowestPrice) {
                $lowestPrice = $competition->price;
            }
        }

        if ($lowestPrice == 0) {
            return '<span class="champ-free label label-success">Grátis!</span>';
        }

        return '<span class="label label-info">À partir de R$ '.number_format($lowestPrice, 2).'</span>';
    }

    public function totalPrice()
    {
        $totalPrice = 0;
        foreach ($this->joins as $join) {
            $totalPrice += $join->present()->totalPrice;
        }

        return number_format($totalPrice, 2);
    }

    public function totalConfirmedPrice()
    {
        $totalPrice = 0;
        foreach ($this->joins as $join) {
            $totalPrice += $join->present()->totalConfirmedPrice;
        }

        return number_format($totalPrice, 2);
    }

    public function totalPendentPrice()
    {
        $totalPrice = 0;
        foreach ($this->joins as $join) {
            $totalPrice += $join->present()->totalPendentPrice;
        }

        return number_format($totalPrice, 2);
    }

    public function getFeaturedCompetitors()
    {
        $nicks = [];
        foreach ($this->joins as $join) {
            if ($join->status_id == Status::APPROVED) {
                foreach ($join->items as $item) {
                    foreach ($item->nicks as $nick) {
                        $nicks[$nick->nick] = $nick->nick;
                    }
                }
            }
        }

        return $nicks;
    }
}
