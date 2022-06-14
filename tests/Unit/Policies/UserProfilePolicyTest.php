<?php

namespace Tests\Unit\Policies;

use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class UserProfilePolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_user_profile()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new UserProfile));
    }

    /** @test */
    public function user_can_view_user_profile()
    {
        $user = $this->createUser();
        $userProfile = UserProfile::factory()->create();
        $this->assertTrue($user->can('view', $userProfile));
    }

    /** @test */
    public function user_can_update_user_profile()
    {
        $user = $this->createUser();
        $userProfile = UserProfile::factory()->create();
        $this->assertTrue($user->can('update', $userProfile));
    }

    /** @test */
    public function user_can_delete_user_profile()
    {
        $user = $this->createUser();
        $userProfile = UserProfile::factory()->create();
        $this->assertTrue($user->can('delete', $userProfile));
    }
}
