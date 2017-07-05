<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Ticket extends Model
{
    use SearchableTrait;

    protected $guarded = ['id'];
    protected $with = ['department', 'user', 'status', 'type', 'priority', 'assignee', 'comments'];

    // Whenever Ticket::search('query') is invoked it
    // will used the fields defined in this array
    // to search for a given query.
    protected $searchable = [
        'columns' => [
            'tickets.title' => 10,
            'types.type' => 10,
            'departments.department' => 10,
            'users.name' => 10,
            'priorities.priority' => 10,
            'statuses.status' => 10,
        ],
        'joins' => [
            'types' => ['tickets.type', 'types.id'],
            'departments' => ['tickets.department', 'departments.id'],
            'statuses' => ['tickets.status', 'statuses.id'],
            'priorities' => ['tickets.priority', 'priorities.id'],
            'users' => ['tickets.assignee', 'users.id'],
        ]
    ];

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user');
    }

    public function assignee()
    {
        return $this->hasOne(User::class, 'id', 'assignee');
    }

    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status');
    }

    public function type()
    {
        return $this->hasOne(Type::class, 'id', 'type');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'ticket', 'id');
    }

    public function priority()
    {
        return $this->hasOne(Priority::class, 'id', 'priority');
    }
}
