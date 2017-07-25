<?php

namespace App\Traits;

use Uuid;

trait GeneratesUuid
{
    public static function boot()
    {
        parent::boot();

        self::creating(function ($instance) {
            $instance->{$instance->getKeyName()} = (string) Uuid::generate();
        });
    }
}
