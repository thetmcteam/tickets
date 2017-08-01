<?php

namespace App\Contracts\Repositories;

interface DepartmentRepositoryInterface
{
    public function all();
    public function findById(int $id);
    public function create(array $data);
    public function deactivate(int $id);
    public function activate(int $id);
    public function makePublic(int $id);
    public function makePrivate(int $id);
}
