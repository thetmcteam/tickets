<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function notes()
    {
        return $this->hasMany(Note::class, 'id', 'ticket');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user');
    }
}
