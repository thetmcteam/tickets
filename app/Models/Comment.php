<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];
    protected $with = ['notes', 'user'];
    
    public function notes()
    {
        return $this->hasMany(Note::class, 'comment', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user');
    }
}
