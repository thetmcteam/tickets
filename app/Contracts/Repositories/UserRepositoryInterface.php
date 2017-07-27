<?php

namespace App\Contracts\Repositories;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
    public function activate(int $id);
    public function findByUsername($username);
    public function update(int $id, array $data);
    public function updatePassword(int $id, $password);
}
