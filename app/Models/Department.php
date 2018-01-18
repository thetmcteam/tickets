<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'department', 'id');
    }

    public function activate()
    {
        $this->update([
            'active' => 1
        ]);
    }

    public function deactivate()
    {
        $this->update([
            'active' => 0
        ]);
    }

    public function makePublic()
    {
        $this->update([
            'public' => 1
        ]);
    }

    public function makePrivate()
    {
        $this->update([
            'public' => 0
        ]);
    }

    public function getId(): int
    {
        return intval($this->id);
    }

    public function getName()
    {
        return $this->department;
    }

    public function getColor()
    {
        return $this->color;
    }
}
