<?php

namespace App\Contracts\Repositories;

interface CommentRepositoryInterface extends BaseRepositoryInterface
{
    public function findByTicketId(int $id);
}
