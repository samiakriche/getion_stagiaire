<?php

namespace Tests\Unit\Policies;

use App\Models\Encadrant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class EncadrantPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_encadrant()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Encadrant));
    }

    /** @test */
    public function user_can_view_encadrant()
    {
        $user = $this->createUser();
        $encadrant = Encadrant::factory()->create();
        $this->assertTrue($user->can('view', $encadrant));
    }

    /** @test */
    public function user_can_update_encadrant()
    {
        $user = $this->createUser();
        $encadrant = Encadrant::factory()->create();
        $this->assertTrue($user->can('update', $encadrant));
    }

    /** @test */
    public function user_can_delete_encadrant()
    {
        $user = $this->createUser();
        $encadrant = Encadrant::factory()->create();
        $this->assertTrue($user->can('delete', $encadrant));
    }
}
