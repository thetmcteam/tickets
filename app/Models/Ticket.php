<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user');
    }

    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status');
    }
}
