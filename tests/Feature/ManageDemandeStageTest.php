<?php

namespace Tests\Feature;

use App\Models\DemandeStage;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageDemandeStageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_demande_stage_list_in_demande_stage_index_page()
    {
        $demandeStage = DemandeStage::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('demande_stages.index');
        $this->see($demandeStage->name);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'DemandeStage 1 name',
            'description' => 'DemandeStage 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_demande_stage()
    {
        $this->loginAsUser();
        $this->visitRoute('demande_stages.index');

        $this->click(__('demande_stage.create'));
        $this->seeRouteIs('demande_stages.create');

        $this->submitForm(__('demande_stage.create'), $this->getCreateFields());

        $this->seeRouteIs('demande_stages.show', DemandeStage::first());

        $this->seeInDatabase('demande_stages', $this->getCreateFields());
    }

    /** @test */
    public function validate_demande_stage_name_is_required()
    {
        $this->loginAsUser();

        // name empty
        $this->post(route('demande_stages.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_demande_stage_name_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // name 70 characters
        $this->post(route('demande_stages.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_demande_stage_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('demande_stages.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'DemandeStage 1 name',
            'description' => 'DemandeStage 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_demande_stage()
    {
        $this->loginAsUser();
        $demandeStage = DemandeStage::factory()->create(['name' => 'Testing 123']);

        $this->visitRoute('demande_stages.show', $demandeStage);
        $this->click('edit-demande_stage-'.$demandeStage->id);
        $this->seeRouteIs('demande_stages.edit', $demandeStage);

        $this->submitForm(__('demande_stage.update'), $this->getEditFields());

        $this->seeRouteIs('demande_stages.show', $demandeStage);

        $this->seeInDatabase('demande_stages', $this->getEditFields([
            'id' => $demandeStage->id,
        ]));
    }

    /** @test */
    public function validate_demande_stage_name_update_is_required()
    {
        $this->loginAsUser();
        $demande_stage = DemandeStage::factory()->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('demande_stages.update', $demande_stage), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_demande_stage_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $demande_stage = DemandeStage::factory()->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('demande_stages.update', $demande_stage), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_demande_stage_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $demande_stage = DemandeStage::factory()->create(['name' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('demande_stages.update', $demande_stage), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_demande_stage()
    {
        $this->loginAsUser();
        $demandeStage = DemandeStage::factory()->create();
        DemandeStage::factory()->create();

        $this->visitRoute('demande_stages.edit', $demandeStage);
        $this->click('del-demande_stage-'.$demandeStage->id);
        $this->seeRouteIs('demande_stages.edit', [$demandeStage, 'action' => 'delete']);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('demande_stages', [
            'id' => $demandeStage->id,
        ]);
    }
}
