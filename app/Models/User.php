<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id'];
    protected $hidden = ['password', 'remember_token'];

    public function getImage()
    {
        if (empty($this->image)) {
            return asset('/images/profile.jpg');
        }

        return $this->image;
    }

    public function isAdmin()
    {
        return (bool) $this->admin;
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

    public function authorizations()
    {
        return $this->hasMany(Authorization::class, 'user', 'id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'user', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'user', 'id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'user', 'id');
    }
}
