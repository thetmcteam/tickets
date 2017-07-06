<?php

namespace App\Repositories;

use App\Models\Action;
use App\Contracts\Repositories\ActionRepositoryInterface;

class ActionRepository implements ActionRepositoryInterface
{
    private $action;

    public function __construct(Action $action)
    {
        $this->action = $action;
    }

    public function log(int $user, int $ticket, $action, array $data)
    {
        $this->action->create([
            'user' => $user,
            'ticket' => $ticket,
            'action' => $action,
            'data' => json_encode($data)
        ]);
    }
}
