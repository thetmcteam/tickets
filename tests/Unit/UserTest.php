<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Department;
use App\Models\Authorization;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function testGetViewableDepartments()
    {
        $this->actingAs(
            $user = $this->makeBasicUser()
        );

        $departments = factory(Department::class, 5)->create([
            'public' => 1
        ]);

        $viewableDepartments = $user->getViewableDepartments();
        $this->assertEquals($viewableDepartments, $departments->map(function ($department) {
            return $department->id;
        })->toArray());
    }

    public function testUserAuthorizedDepartments()
    {
        $this->actingAs(
            $user = $this->makeBasicUser()
        );

        $departments = factory(Department::class, 5)->create([
            'public' => 0
        ]);

        foreach ($departments as $department) {
            Authorization::create([
                'user' => $user->id,
                'department' => $department->id
            ]);
        }

        $authorizedDepartments = $user->getAuthorizedDepartments();
        $this->assertEquals($authorizedDepartments, $departments->map(function ($department) {
            return $department->id;
        })->toArray());
    }
}
