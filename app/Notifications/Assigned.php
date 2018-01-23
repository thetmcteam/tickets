<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Assigned extends Notification implements ShouldQueue
{
    use Queueable;

    private $ticket;
    private $assigner;

    public function __construct(Ticket $ticket, User $assigner)
    {
        $this->ticket = $ticket;
        $this->assigner = $assigner;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = sprintf(trans('ticket.notifications.assigned.message', [
            'user' => $this->assigner->name
        ]));

        return (new MailMessage)
            ->subject(trans('ticket.notifications.assigned.subject'))
            ->line($message)
            ->action(trans('ticket.notifications.assigned.action'), url('/tickets/' . $this->ticket->id));
    }
}
