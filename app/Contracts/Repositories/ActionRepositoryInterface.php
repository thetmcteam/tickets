<?php

namespace App\Contracts\Repositories;

interface ActionRepositoryInterface
{
    public function log(int $user, int $ticket, $action, array $data);
}
