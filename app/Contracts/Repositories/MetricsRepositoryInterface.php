<?php

namespace App\Contracts\Repositories;

interface MetricsRepositoryInterface
{
    public function getTicketCountsByType();
    public function getTicketCountsByDepartment();
}
