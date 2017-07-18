<?php

namespace App\Contracts\Repositories;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
    public function findByUsername($username);
}
