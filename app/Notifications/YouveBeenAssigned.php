<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class YouveBeenAssigned extends Notification implements ShouldQueue
{
    use Queueable;

    private $ticket;
    private $assigner;
    private $assignee;

    public function __construct(Ticket $ticket, User $assignee, User $assigner)
    {
        $this->ticket = $ticket;
        $this->assigner = $assigner;
        $this->assignee = $assignee;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = sprintf('Hello %s, %s has assigned this ticket to you. (%s)',
            $this->assignee->name,
            $this->assigner->name,
            $this->ticket->title
        );

        return (new MailMessage)
            ->line('You\'ve been assigned to a ticket.')
            ->subject('You\'ve been assigned to a ticket.')
            ->action('View Ticket', url('/tickets/' . $this->ticket->id))
            ->line($message);
    }
}
