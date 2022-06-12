<?php

namespace Tests\Feature;

use App\Models\Enseignant;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageEnseignantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_enseignant_list_in_enseignant_index_page()
    {
        $enseignant = Enseignant::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('enseignants.index');
        $this->see($enseignant->name);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Enseignant 1 name',
            'description' => 'Enseignant 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_enseignant()
    {
        $this->loginAsUser();
        $this->visitRoute('enseignants.index');

        $this->click(__('enseignant.create'));
        $this->seeRouteIs('enseignants.create');

        $this->submitForm(__('enseignant.create'), $this->getCreateFields());

        $this->seeRouteIs('enseignants.show', Enseignant::first());

        $this->seeInDatabase('enseignants', $this->getCreateFields());
    }

    /** @test */
    public function validate_enseignant_name_is_required()
    {
        $this->loginAsUser();

        // name empty
        $this->post(route('enseignants.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_enseignant_name_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // name 70 characters
        $this->post(route('enseignants.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_enseignant_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('enseignants.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Enseignant 1 name',
            'description' => 'Enseignant 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_enseignant()
    {
        $this->loginAsUser();
        $enseignant = Enseignant::factory()->create(['name' => 'Testing 123']);

        $this->visitRoute('enseignants.show', $enseignant);
        $this->click('edit-enseignant-'.$enseignant->id);
        $this->seeRouteIs('enseignants.edit', $enseignant);

        $this->submitForm(__('enseignant.update'), $this->getEditFields());

        $this->seeRouteIs('enseignants.show', $enseignant);

        $this->seeInDatabase('enseignants', $this->getEditFields([
            'id' => $enseignant->id,
        ]));
    }

    /** @test */
    public function validate_enseignant_name_update_is_required()
    {
        $this->loginAsUser();
        $enseignant = Enseignant::factory()->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('enseignants.update', $enseignant), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_enseignant_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $enseignant = Enseignant::factory()->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('enseignants.update', $enseignant), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_enseignant_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $enseignant = Enseignant::factory()->create(['name' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('enseignants.update', $enseignant), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_enseignant()
    {
        $this->loginAsUser();
        $enseignant = Enseignant::factory()->create();
        Enseignant::factory()->create();

        $this->visitRoute('enseignants.edit', $enseignant);
        $this->click('del-enseignant-'.$enseignant->id);
        $this->seeRouteIs('enseignants.edit', [$enseignant, 'action' => 'delete']);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('enseignants', [
            'id' => $enseignant->id,
        ]);
    }
}
