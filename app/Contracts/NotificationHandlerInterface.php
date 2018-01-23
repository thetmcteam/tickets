<?php

namespace App\Contracts;

interface NotificationHandlerInterface
{
    public function handleNotification(bool $queue = true);
}
