<?php

namespace App\Contracts\Repositories;

interface ActionRepositoryInterface
{
    public function findByTicket(int $id);
    public function log(int $user, int $ticket, $action, array $data);
}
