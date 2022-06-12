<?php

namespace Tests\Feature;

use App\Models\Encadrant;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageEncadrantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_encadrant_list_in_encadrant_index_page()
    {
        $encadrant = Encadrant::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('encadrants.index');
        $this->see($encadrant->name);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Encadrant 1 name',
            'description' => 'Encadrant 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_encadrant()
    {
        $this->loginAsUser();
        $this->visitRoute('encadrants.index');

        $this->click(__('encadrant.create'));
        $this->seeRouteIs('encadrants.create');

        $this->submitForm(__('encadrant.create'), $this->getCreateFields());

        $this->seeRouteIs('encadrants.show', Encadrant::first());

        $this->seeInDatabase('encadrants', $this->getCreateFields());
    }

    /** @test */
    public function validate_encadrant_name_is_required()
    {
        $this->loginAsUser();

        // name empty
        $this->post(route('encadrants.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_encadrant_name_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // name 70 characters
        $this->post(route('encadrants.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_encadrant_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('encadrants.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Encadrant 1 name',
            'description' => 'Encadrant 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_encadrant()
    {
        $this->loginAsUser();
        $encadrant = Encadrant::factory()->create(['name' => 'Testing 123']);

        $this->visitRoute('encadrants.show', $encadrant);
        $this->click('edit-encadrant-'.$encadrant->id);
        $this->seeRouteIs('encadrants.edit', $encadrant);

        $this->submitForm(__('encadrant.update'), $this->getEditFields());

        $this->seeRouteIs('encadrants.show', $encadrant);

        $this->seeInDatabase('encadrants', $this->getEditFields([
            'id' => $encadrant->id,
        ]));
    }

    /** @test */
    public function validate_encadrant_name_update_is_required()
    {
        $this->loginAsUser();
        $encadrant = Encadrant::factory()->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('encadrants.update', $encadrant), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_encadrant_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $encadrant = Encadrant::factory()->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('encadrants.update', $encadrant), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_encadrant_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $encadrant = Encadrant::factory()->create(['name' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('encadrants.update', $encadrant), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_encadrant()
    {
        $this->loginAsUser();
        $encadrant = Encadrant::factory()->create();
        Encadrant::factory()->create();

        $this->visitRoute('encadrants.edit', $encadrant);
        $this->click('del-encadrant-'.$encadrant->id);
        $this->seeRouteIs('encadrants.edit', [$encadrant, 'action' => 'delete']);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('encadrants', [
            'id' => $encadrant->id,
        ]);
    }
}
