<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_profile_has_name_link_attribute()
    {
        $userProfile = UserProfile::factory()->create();

        $title = __('app.show_detail_title', [
            'name' => $userProfile->name, 'type' => __('user_profile.user_profile'),
        ]);
        $link = '<a href="'.route('user_profiles.show', $userProfile).'"';
        $link .= ' title="'.$title.'">';
        $link .= $userProfile->name;
        $link .= '</a>';

        $this->assertEquals($link, $userProfile->name_link);
    }

    /** @test */
    public function a_user_profile_has_belongs_to_creator_relation()
    {
        $userProfile = UserProfile::factory()->make();

        $this->assertInstanceOf(User::class, $userProfile->creator);
        $this->assertEquals($userProfile->creator_id, $userProfile->creator->id);
    }
}
