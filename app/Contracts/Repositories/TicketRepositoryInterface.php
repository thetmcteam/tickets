<?php

namespace App\Contracts\Repositories;

interface TicketRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllPaginated(int $page);
}
