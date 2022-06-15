<?php

namespace Tests\Unit\Policies;

use App\Models\Etudiant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class EtudiantPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_etudiant()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Etudiant));
    }

    /** @test */
    public function user_can_view_etudiant()
    {
        $user = $this->createUser();
        $etudiant = Etudiant::factory()->create();
        $this->assertTrue($user->can('view', $etudiant));
    }

    /** @test */
    public function user_can_update_etudiant()
    {
        $user = $this->createUser();
        $etudiant = Etudiant::factory()->create();
        $this->assertTrue($user->can('update', $etudiant));
    }

    /** @test */
    public function user_can_delete_etudiant()
    {
        $user = $this->createUser();
        $etudiant = Etudiant::factory()->create();
        $this->assertTrue($user->can('delete', $etudiant));
    }
}
