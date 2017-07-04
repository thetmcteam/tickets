<?php

namespace App\Contracts\Repositories;

interface NoteRepositoryInterface extends BaseRepositoryInterface
{
    public function deleteByComment(int $id);
}
