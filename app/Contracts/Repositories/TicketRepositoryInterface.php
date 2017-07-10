<?php

namespace App\Contracts\Repositories;

interface TicketRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllPaginated();
    public function findByAssignee(int $id);
    public function getAllPaginatedBy($query);
    public function updateStatus(int $id, int $status);
    public function updateAssignee(int $id, int $user);
    public function updatePriority(int $id, int $priority);
}
