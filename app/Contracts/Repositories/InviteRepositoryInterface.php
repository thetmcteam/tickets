<?php

namespace App\Contracts\Repositories;

interface InviteRepositoryInterface
{
    public function delete($uuid);
    public function findByUuid($uuid);
    public function create(array $data);
    public function existsForUuid($uuid);
    public function existsForEmail($email);
}
