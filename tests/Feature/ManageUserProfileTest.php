<?php

namespace Tests\Feature;

use App\Models\UserProfile;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageUserProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_user_profile_list_in_user_profile_index_page()
    {
        $userProfile = UserProfile::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('user_profiles.index');
        $this->see($userProfile->name);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'UserProfile 1 name',
            'description' => 'UserProfile 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_user_profile()
    {
        $this->loginAsUser();
        $this->visitRoute('user_profiles.index');

        $this->click(__('user_profile.create'));
        $this->seeRouteIs('user_profiles.create');

        $this->submitForm(__('user_profile.create'), $this->getCreateFields());

        $this->seeRouteIs('user_profiles.show', UserProfile::first());

        $this->seeInDatabase('user_profiles', $this->getCreateFields());
    }

    /** @test */
    public function validate_user_profile_name_is_required()
    {
        $this->loginAsUser();

        // name empty
        $this->post(route('user_profiles.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_user_profile_name_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // name 70 characters
        $this->post(route('user_profiles.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_user_profile_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('user_profiles.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'UserProfile 1 name',
            'description' => 'UserProfile 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_user_profile()
    {
        $this->loginAsUser();
        $userProfile = UserProfile::factory()->create(['name' => 'Testing 123']);

        $this->visitRoute('user_profiles.show', $userProfile);
        $this->click('edit-user_profile-'.$userProfile->id);
        $this->seeRouteIs('user_profiles.edit', $userProfile);

        $this->submitForm(__('user_profile.update'), $this->getEditFields());

        $this->seeRouteIs('user_profiles.show', $userProfile);

        $this->seeInDatabase('user_profiles', $this->getEditFields([
            'id' => $userProfile->id,
        ]));
    }

    /** @test */
    public function validate_user_profile_name_update_is_required()
    {
        $this->loginAsUser();
        $user_profile = UserProfile::factory()->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('user_profiles.update', $user_profile), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_user_profile_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $user_profile = UserProfile::factory()->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('user_profiles.update', $user_profile), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_user_profile_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $user_profile = UserProfile::factory()->create(['name' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('user_profiles.update', $user_profile), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_user_profile()
    {
        $this->loginAsUser();
        $userProfile = UserProfile::factory()->create();
        UserProfile::factory()->create();

        $this->visitRoute('user_profiles.edit', $userProfile);
        $this->click('del-user_profile-'.$userProfile->id);
        $this->seeRouteIs('user_profiles.edit', [$userProfile, 'action' => 'delete']);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('user_profiles', [
            'id' => $userProfile->id,
        ]);
    }
}
