<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function testActivateUser()
    {
        $user = $this->makeAdminUser();
        $response = $this->actingAs($user)->post("/api/users/{$user->id}/activate");
        $response->assertStatus(200);
        $response->assertJson(['message' => 'user activated.']);
    }

    public function testDeactivateUser()
    {
        $user = $this->makeAdminUser();
        $response = $this->actingAs($user)->post("/api/users/{$user->id}/deactivate");
        $response->assertStatus(200);
        $response->assertJson(['message' => 'user deactivated.']);
    }

    public function testUpdateUserPassword()
    {
        $user = $this->makeAdminUser();
        $response = $this->actingAs($user)->put("/api/users/{$user->id}/password", ['password' => 'secret']);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'user updated.']);
    }

    public function testUpdateUserNotFoundPassword()
    {
        $user = $this->makeAdminUser();
        $response = $this->actingAs($user)->put("/api/users/0/password", ['password' => 'secret']);
        $response->assertStatus(404);
    }
}
