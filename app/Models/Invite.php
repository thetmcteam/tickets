<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invite extends Model
{
    use Notifiable;

    protected $keyType = 'string';
    protected $primaryKey = 'uuid';

    // The models fillable fields.
    protected $fillable = [
        'uuid', 'email', 'admin', 'expires_at'
    ];
}
