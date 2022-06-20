<?php

namespace Tests\Unit\Policies;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class MessagePolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_message()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Message));
    }

    /** @test */
    public function user_can_view_message()
    {
        $user = $this->createUser();
        $message = Message::factory()->create();
        $this->assertTrue($user->can('view', $message));
    }

    /** @test */
    public function user_can_update_message()
    {
        $user = $this->createUser();
        $message = Message::factory()->create();
        $this->assertTrue($user->can('update', $message));
    }

    /** @test */
    public function user_can_delete_message()
    {
        $user = $this->createUser();
        $message = Message::factory()->create();
        $this->assertTrue($user->can('delete', $message));
    }
}
