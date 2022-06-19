<?php

namespace Tests\Unit\Policies;

use App\Models\Suivie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class SuiviePolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_suivie()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Suivie));
    }

    /** @test */
    public function user_can_view_suivie()
    {
        $user = $this->createUser();
        $suivie = Suivie::factory()->create();
        $this->assertTrue($user->can('view', $suivie));
    }

    /** @test */
    public function user_can_update_suivie()
    {
        $user = $this->createUser();
        $suivie = Suivie::factory()->create();
        $this->assertTrue($user->can('update', $suivie));
    }

    /** @test */
    public function user_can_delete_suivie()
    {
        $user = $this->createUser();
        $suivie = Suivie::factory()->create();
        $this->assertTrue($user->can('delete', $suivie));
    }
}
