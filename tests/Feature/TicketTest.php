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
        $ticket = $this->makeTicket();
        $user = $this->makeAdminUser();
        $response = $this->actingAs($user)->delete("/api/tickets/{$ticket->id}");
        $response->assertStatus(200);
        $response->assertJson(['message' => 'ticket removed.']);
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
        $ticket = $this->makeTicket();
        $user = $this->makeAdminUser();
        $department = factory(\App\Models\Department::class)->create();
        $response = $this->actingAs($user)->put("/api/tickets/{$ticket->id}/department", ['department' => $department->id]);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'ticket updated.']);
    }

    public function testUpdateTicketType()
    {
        $ticket = $this->makeTicket();
        $user = $this->makeAdminUser();
        $type = factory(\App\Models\Type::class)->create();
        $response = $this->actingAs($user)->put("/api/tickets/{$ticket->id}/type", ['type' => $type->id]);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'ticket updated.']);
    }

    public function testUpdateTicketAssignee()
    {
        $ticket = $this->makeTicket();
        $user = $this->makeAdminUser();
        $response = $this->actingAs($user)->put("/api/tickets/{$ticket->id}/assignee", ['assignee' => $user->id]);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'ticket updated.']);
    }

    public function testUpdateTicketPriority()
    {
        $ticket = $this->makeTicket();
        $user = $this->makeAdminUser();
        $priority = factory(\App\Models\Priority::class)->create();
        $response = $this->actingAs($user)->put("/api/tickets/{$ticket->id}/priority", ['priority' => $priority->id]);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'ticket updated.']);
    }

    public function testUpdateTicketStatus()
    {
        $ticket = $this->makeTicket();
        $user = $this->makeAdminUser();
        $status = factory(\App\Models\Status::class)->create();
        $response = $this->actingAs($user)->put("/api/tickets/{$ticket->id}/status", ['status' => $status->id]);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'ticket updated.']);
    }
}
