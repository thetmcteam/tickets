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

    private $user;
    private $ticket;
    private $replier;
    private $content;

    public function __construct(User $user, Ticket $ticket, User $replier, $content)
    {
        $this->user = $user;
        $this->ticket = $ticket;
        $this->replier = $replier;
        $this->content = $content;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = sprintf('Hey %s, %s posted a reply to your ticket (%s).',
            $this->user->name,
            $this->replier->name,
            $this->ticket->title
        );

        return (new MailMessage)
            ->subject('Someone replied to your ticket.')
            ->line($message)
            ->action('View Ticket', url('/tickets/'. $this->ticket->id))
            ->line($this->content);
    }
}
