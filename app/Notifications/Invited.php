<?php

namespace App\Notifications;

use App\Models\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Application;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Invited extends Notification implements ShouldQueue
{
    use Queueable;

    private $invite;
    private $appName;

    public function __construct(Invite $invite, $appName)
    {
        $this->invite = $invite;
        $this->appName = $appName;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $appName = $this->appName;

        return (new MailMessage)
            ->subject("You've been invited to join $appName.")
            ->line("You've been invited to join $appName, click the link below to get started. This invite will expire in 24 hours.")
            ->action('Create Account', url('/invite?token='.$this->invite->uuid));
    }
}
