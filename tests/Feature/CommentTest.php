<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreateComment()
    {
        $ticket = $this->makeTicket();
        $user = $this->makeBasicUser();
        
        $response = $this->actingAs($user)->post('/api/comments', [
            'ticket' => $ticket->id,
            'user' => $user->id,
            'content' => 'test'
        ]);
        
        $response->assertStatus(200);
        $response->assertJson(['message' => 'comment created.']);
    }

    public function testDeleteComment()
    {
        $ticket = $this->makeTicket();
        $user = $this->makeAdminUser();
        
        $comment = factory(\App\Models\Comment::class)->create([
            'ticket' => $ticket->id,
            'user' => $user->id
        ]);
        
        $response = $this->actingAs($user)->delete("/api/comments/{$comment->id}");
        $response->assertStatus(200);
        $response->assertJson(['message' => 'comment deleted.']);
    }

    public function testDeleteCommentUnauthorized()
    {
        $user = $this->makeBasicUser();
        $response = $this->actingAs($user)->delete("/api/comments/0");
        $response->assertStatus(401);
    }

    public function testDeleteCommentNotFound()
    {
        $user = $this->makeAdminUser();
        $response = $this->actingAs($user)->delete('/api/comments/0');
        $response->assertStatus(404);
    }
}
