<?php

namespace Tests\Feature;

use App\Models\Etudiant;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageEtudiantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_etudiant_list_in_etudiant_index_page()
    {
        $etudiant = Etudiant::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('etudiants.index');
        $this->see($etudiant->name);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Etudiant 1 name',
            'description' => 'Etudiant 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_etudiant()
    {
        $this->loginAsUser();
        $this->visitRoute('etudiants.index');

        $this->click(__('etudiant.create'));
        $this->seeRouteIs('etudiants.create');

        $this->submitForm(__('etudiant.create'), $this->getCreateFields());

        $this->seeRouteIs('etudiants.show', Etudiant::first());

        $this->seeInDatabase('etudiants', $this->getCreateFields());
    }

    /** @test */
    public function validate_etudiant_name_is_required()
    {
        $this->loginAsUser();

        // name empty
        $this->post(route('etudiants.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_etudiant_name_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // name 70 characters
        $this->post(route('etudiants.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_etudiant_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('etudiants.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Etudiant 1 name',
            'description' => 'Etudiant 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_etudiant()
    {
        $this->loginAsUser();
        $etudiant = Etudiant::factory()->create(['name' => 'Testing 123']);

        $this->visitRoute('etudiants.show', $etudiant);
        $this->click('edit-etudiant-'.$etudiant->id);
        $this->seeRouteIs('etudiants.edit', $etudiant);

        $this->submitForm(__('etudiant.update'), $this->getEditFields());

        $this->seeRouteIs('etudiants.show', $etudiant);

        $this->seeInDatabase('etudiants', $this->getEditFields([
            'id' => $etudiant->id,
        ]));
    }

    /** @test */
    public function validate_etudiant_name_update_is_required()
    {
        $this->loginAsUser();
        $etudiant = Etudiant::factory()->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('etudiants.update', $etudiant), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_etudiant_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $etudiant = Etudiant::factory()->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('etudiants.update', $etudiant), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_etudiant_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $etudiant = Etudiant::factory()->create(['name' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('etudiants.update', $etudiant), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_etudiant()
    {
        $this->loginAsUser();
        $etudiant = Etudiant::factory()->create();
        Etudiant::factory()->create();

        $this->visitRoute('etudiants.edit', $etudiant);
        $this->click('del-etudiant-'.$etudiant->id);
        $this->seeRouteIs('etudiants.edit', [$etudiant, 'action' => 'delete']);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('etudiants', [
            'id' => $etudiant->id,
        ]);
    }
}
