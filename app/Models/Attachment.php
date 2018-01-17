<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    /**
     * Guarded fields.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Eager loaded relationships.
     *
     * @var array
     */
    protected $with = ['user'];

    /**
     * User relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
