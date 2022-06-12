<?php

namespace Tests\Unit\Policies;

use App\Models\DemandeStage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class DemandeStagePolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_demande_stage()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new DemandeStage));
    }

    /** @test */
    public function user_can_view_demande_stage()
    {
        $user = $this->createUser();
        $demandeStage = DemandeStage::factory()->create();
        $this->assertTrue($user->can('view', $demandeStage));
    }

    /** @test */
    public function user_can_update_demande_stage()
    {
        $user = $this->createUser();
        $demandeStage = DemandeStage::factory()->create();
        $this->assertTrue($user->can('update', $demandeStage));
    }

    /** @test */
    public function user_can_delete_demande_stage()
    {
        $user = $this->createUser();
        $demandeStage = DemandeStage::factory()->create();
        $this->assertTrue($user->can('delete', $demandeStage));
    }
}
