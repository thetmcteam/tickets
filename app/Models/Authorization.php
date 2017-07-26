<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $with = ['department'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department', 'id');
    }
}
