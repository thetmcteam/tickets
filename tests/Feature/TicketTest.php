<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TicketTest extends TestCase
{
    use DatabaseMigrations;

    public function testDeleteTicketIsNotFound()
    {
        $user = $this->makeAdminUser();
        $response = $this->actingAs($user)->delete('/api/tickets/0');
        $response->assertStatus(404);
    }

    public function testDeleteTicket()
    {
        $this->makeTicket();
        $user = $this->makeAdminUser();
        $response = $this->actingAs($user)->delete('/api/tickets/1');
        $response->assertStatus(200);
        $response->assertJson(['message' => 'ticket successfully removed.']);
    }

    public function testDeleteTicketUnauthorized()
    {
        $user = $this->makeBasicUser();
        $response = $this->actingAs($user)->delete('/api/tickets/1');
        $response->assertStatus(401);
    }

    public function testUpdateTicketDepartmentNotFound()
    {
        $user = $this->makeAdminUser();
        $response = $this->actingAs($user)->put('/api/tickets/0/department', ['department' => 1]);
        $response->assertStatus(404);
    }

    public function testUpdateTicketDepartmentUnauthorized()
    {
        $user = $this->makeBasicUser();
        $response = $this->actingAs($user)->put('/api/tickets/1/department', ['department' => 1]);
        $response->assertStatus(401);
    }

    public function testUpdateTicketDepartmenet()
    {
        $this->makeTicket();
        $user = $this->makeAdminUser();
        $department = factory(\App\Models\Department::class)->create();
        $response = $this->actingAs($user)->put('/api/tickets/1/department', ['department' => $department->id]);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'ticket updated.']);
    }

    public function testUpdateTicketType()
    {
        $this->makeTicket();
        $user = $this->makeAdminUser();
        $type = factory(\App\Models\Type::class)->create();
        $response = $this->actingAs($user)->put('/api/tickets/1/type', ['type' => $type->id]);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'ticket updated.']);
    }

    public function testUpdateTicketAssignee()
    {
        $this->makeTicket();
        $user = $this->makeAdminUser();
        $response = $this->actingAs($user)->put('/api/tickets/1/assignee', ['assignee' => $user->id]);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'ticket updated.']);
    }

    public function testUpdateTicketPriority()
    {
        $this->makeTicket();
        $user = $this->makeAdminUser();
        $priority = factory(\App\Models\Priority::class)->create();
        $response = $this->actingAs($user)->put('/api/tickets/1/priority', ['priority' => $priority->id]);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'ticket updated.']);
    }

    public function testUpdateTicketStatus()
    {
        $this->makeTicket();
        $user = $this->makeAdminUser();
        $status = factory(\App\Models\Status::class)->create();
        $response = $this->actingAs($user)->put('/api/tickets/1/status', ['status' => $status->id]);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'ticket updated.']);
    }

    private function makeTicket()
    {
        factory(\App\Models\Ticket::class)->create();
    }
}
