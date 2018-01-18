<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    public function getId(): int
    {
        return intval($this->id);
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getName()
    {
        return $this->priority;
    }
}
