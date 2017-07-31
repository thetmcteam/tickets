<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function makeTicket()
    {
        return factory(\App\Models\Ticket::class)->create();
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
