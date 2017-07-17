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
}
