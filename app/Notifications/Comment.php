<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Comment extends Notification implements ShouldQueue
{
    use Queueable;

    private $ticket;
    private $commentator;

    public function __construct(Ticket $ticket, User $commentator)
    {
        $this->ticket = $ticket;
        $this->commentator = $commentator;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = trans('ticket.notifications.comment.message', [
            'user' => $this->commentator->name
        ]);

        return (new MailMessage)
            ->subject(trans('ticket.notifications.comment.subject'))
            ->line($message)
            ->action(trans('ticket.notifications.comment.action'), url('/tickets/' . $this->ticket->id));
    }
}
