<?php

namespace App\Handlers\Notifications;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Ticket;
use App\Notifications\Comment;
use App\Contracts\NotificationHandlerInterface;

class CommentNotificationHandler implements NotificationHandlerInterface
{
    private $ticket;
    private $recipient;
    private $commentator;

    public function __construct(Ticket $ticket, User $recipient, User $commentator)
    {
        $this->ticket =  $ticket;
        $this->recipient = $recipient;
        $this->commentator = $commentator;
    }

    public function handleNotification(bool $queue = true)
    {
        if ($this->recipient->getId() === $this->commentator->getId()) {
            return;
        }

        $notification = new Comment($this->ticket, $this->commentator);

        if ($queue) {
            $notification->delay(Carbon::now()->addMinutes(1));
        }

        $this->recipient->notify($notification);
    }
}
