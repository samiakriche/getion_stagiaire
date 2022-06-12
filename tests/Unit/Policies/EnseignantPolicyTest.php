<?php

namespace Tests\Unit\Policies;

use App\Models\Enseignant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class EnseignantPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_enseignant()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Enseignant));
    }

    /** @test */
    public function user_can_view_enseignant()
    {
        $user = $this->createUser();
        $enseignant = Enseignant::factory()->create();
        $this->assertTrue($user->can('view', $enseignant));
    }

    /** @test */
    public function user_can_update_enseignant()
    {
        $user = $this->createUser();
        $enseignant = Enseignant::factory()->create();
        $this->assertTrue($user->can('update', $enseignant));
    }

    /** @test */
    public function user_can_delete_enseignant()
    {
        $user = $this->createUser();
        $enseignant = Enseignant::factory()->create();
        $this->assertTrue($user->can('delete', $enseignant));
    }
}
