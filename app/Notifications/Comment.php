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

    private $user;
    private $ticket;
    private $content;
    private $commenter;

    public function __construct(User $user, Ticket $ticket, User $commenter, $content)
    {
        $this->user = $user;
        $this->ticket = $ticket;
        $this->content = $content;
        $this->commenter = $commenter;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = sprintf('Hello %s, %s posted a comment on your reply. (%s)',
            $this->user->name,
            $this->commenter->name,
            $this->ticket->title
        );

        return (new MailMessage)
            ->subject('Someone commented on your reply.')
            ->line($message)
            ->action('View Ticket', url('/tickets/' . $this->ticket->id))
            ->line($this->content);
    }
}
