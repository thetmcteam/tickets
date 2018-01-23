<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Reply extends Notification implements ShouldQueue
{
    use Queueable;

    private $ticket;
    private $replier;

    public function __construct(Ticket $ticket, User $replier)
    {
        $this->ticket = $ticket;
        $this->replier = $replier;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = trans('ticket.notifications.reply.message', [
            'user' => $this->replier->name
        ]);

        return (new MailMessage)
            ->subject(trans('ticket.notifications.reply.subject'))
            ->line($message)
            ->action(trans('ticket.notifications.reply.action'), url('/tickets/'. $this->ticket->id));
    }
}
