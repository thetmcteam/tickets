<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = ['id'];

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

    public function type()
    {
        return $this->hasOne(Type::class, 'id', 'type');
    }
}
