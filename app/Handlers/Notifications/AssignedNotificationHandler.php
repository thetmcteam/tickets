<?php

namespace App\Handlers\Notifications;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Ticket;
use App\Notifications\Assigned;
use App\Contracts\NotificationHandlerInterface;

class AssignedNotificationHandler implements NotificationHandlerInterface
{
    private $ticket;
    private $recipient;
    private $assigner;

    public function __construct(Ticket $ticket, User $recipient, User $assigner)
    {
        $this->ticket =  $ticket;
        $this->assigner = $assigner;
        $this->recipient = $recipient;
    }

    public function handleNotification(bool $queue = true)
    {
        if ($this->recipient->getId() === $this->assigner->getId()) {
            return;
        }

        $notification = new Assigned($this->ticket, $this->assigner);

        if ($queue) {
            $notification->delay(Carbon::now()->addMinutes(1));
        }

        $this->recipient->notify($notification);
    }
}
