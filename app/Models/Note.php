<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = ['id'];
    protected $with = ['user'];
    
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user');
    }
}
