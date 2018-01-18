<?php

namespace App\Contracts\Repositories;

interface TicketRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllPaginated();
    public function findByAssignee(int $id);
    public function getAllPaginatedBy(array $data);
    public function updateStatus(int $id, int $status);
    public function updateAssignee(int $id, int $user);
    public function updatePriority(int $id, int $priority);
    public function updateDepartment(int $id, int $department);
}
