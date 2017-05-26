<?php

namespace App\Contracts\Repositories;

interface BaseRepositoryInterface
{
    public function findById(int $id);
    public function create(array $data);
    public function delete(int $id);
}
