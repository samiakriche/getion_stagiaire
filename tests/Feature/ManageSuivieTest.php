<?php

namespace Tests\Feature;

use App\Models\Suivie;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageSuivieTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_suivie_list_in_suivie_index_page()
    {
        $suivie = Suivie::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('suivies.index');
        $this->see($suivie->name);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Suivie 1 name',
            'description' => 'Suivie 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_suivie()
    {
        $this->loginAsUser();
        $this->visitRoute('suivies.index');

        $this->click(__('suivie.create'));
        $this->seeRouteIs('suivies.create');

        $this->submitForm(__('suivie.create'), $this->getCreateFields());

        $this->seeRouteIs('suivies.show', Suivie::first());

        $this->seeInDatabase('suivies', $this->getCreateFields());
    }

    /** @test */
    public function validate_suivie_name_is_required()
    {
        $this->loginAsUser();

        // name empty
        $this->post(route('suivies.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_suivie_name_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // name 70 characters
        $this->post(route('suivies.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_suivie_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('suivies.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Suivie 1 name',
            'description' => 'Suivie 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_suivie()
    {
        $this->loginAsUser();
        $suivie = Suivie::factory()->create(['name' => 'Testing 123']);

        $this->visitRoute('suivies.show', $suivie);
        $this->click('edit-suivie-'.$suivie->id);
        $this->seeRouteIs('suivies.edit', $suivie);

        $this->submitForm(__('suivie.update'), $this->getEditFields());

        $this->seeRouteIs('suivies.show', $suivie);

        $this->seeInDatabase('suivies', $this->getEditFields([
            'id' => $suivie->id,
        ]));
    }

    /** @test */
    public function validate_suivie_name_update_is_required()
    {
        $this->loginAsUser();
        $suivie = Suivie::factory()->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('suivies.update', $suivie), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_suivie_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $suivie = Suivie::factory()->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('suivies.update', $suivie), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_suivie_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $suivie = Suivie::factory()->create(['name' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('suivies.update', $suivie), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_suivie()
    {
        $this->loginAsUser();
        $suivie = Suivie::factory()->create();
        Suivie::factory()->create();

        $this->visitRoute('suivies.edit', $suivie);
        $this->click('del-suivie-'.$suivie->id);
        $this->seeRouteIs('suivies.edit', [$suivie, 'action' => 'delete']);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('suivies', [
            'id' => $suivie->id,
        ]);
    }
}
