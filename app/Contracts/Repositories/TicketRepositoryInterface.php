<?php

namespace App\Contracts\Repositories;

interface TicketRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllPaginated(int $page);
    public function getAllPaginatedByDepartment(int $id, int $page);
    public function updateStatus(int $id, int $status);
    public function updateAssignee(int $id, int $user);
    public function updatePriority(int $id, int $priority);
}
