<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function makeTicket()
    {
        $type = factory(\App\Models\Type::class)->create();
        $status = factory(\App\Models\Status::class)->create();
        $department = factory(\App\Models\Department::class)->create();

        return factory(\App\Models\Ticket::class)->create([
            'department' => $type->id,
            'status' => $status->id,
            'type' => $type->id,
        ]);
    }

    protected function makeBasicUser()
    {
        return factory(\App\Models\User::class)->create([
            'admin' => 0
        ]);
    }

    protected function makeAdminUser()
    {
        return factory(\App\Models\User::class)->create([
            'admin' => 1
        ]);
    }
}
