<?php namespace Champ\Listeners;

use Laracasts\Commander\Events\EventListener;
use Champ\Join\Events\JoinStatusChanged;
use Champ\Join\Events\UserJoined;
use Champ\Join\Events\JoinCancelled;
use Mail;

class NotificationListener extends EventListener {

    protected $notifiable = [
        3, // Paid
        7 // Canceled
    ];

    /**
     * Update the championship limit when a user join the championship
     *
     * @param  JoinStatusChanged $event
     * @return void
     */
    public function whenJoinStatusChanged(JoinStatusChanged $event)
    {
        $join = $event->join;

        $parameters = [
            'name' => $join->user->name,
            'championship' => $join->championship->name
        ];

        if (in_array($join->status_id, $this->notifiable))
        {
            Mail::send('emails.status_changed', $parameters, function($message) use ($join)
            {
                $message->to($join->user->email)->subject("O Status da sua inscrição mudou");
            });
        }
    }

    /**
     * Send a email to the user when the join was cancelled
     *
     * @param  UserJoined $event
     * @return void
     */
    public function whenJoinCancelled(JoinCancelled $event)
    {
        $join = $event->join;

        $parameters = [
            'name' => $join->user->name,
            'championship' => $join->championship->name,
            'join' => $join->id
        ];

        Mail::send('emails.join_cancelled', $parameters, function($message) use ($join)
        {
            $message->to($join->user->email)->subject("Sua inscrição foi cancelada.");
        });
    }

    /**
     * Send a email to the user when he join a championship
     *
     * @param  UserJoined $event
     * @return void
     */
    public function whenUserJoined(UserJoined $event)
    {
        $join = $event->join;

        $parameters = [
            'name' => $join->user->name,
            'championship' => $join->championship->name,
            'join' => $join->id
        ];

        Mail::send('emails.user_joined', $parameters, function($message) use ($join)
        {
            $message->to($join->user->email)->subject("Você tá dentro!");
        });
    }
}