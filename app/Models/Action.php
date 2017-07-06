<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $with = ['user'];
    protected $guarded = ['id'];
    
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user');
    }
}
