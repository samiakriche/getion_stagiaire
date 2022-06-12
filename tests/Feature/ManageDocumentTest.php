<?php

namespace Tests\Feature;

use App\Models\Document;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageDocumentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_document_list_in_document_index_page()
    {
        $document = Document::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('documents.index');
        $this->see($document->name);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Document 1 name',
            'description' => 'Document 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_document()
    {
        $this->loginAsUser();
        $this->visitRoute('documents.index');

        $this->click(__('document.create'));
        $this->seeRouteIs('documents.create');

        $this->submitForm(__('document.create'), $this->getCreateFields());

        $this->seeRouteIs('documents.show', Document::first());

        $this->seeInDatabase('documents', $this->getCreateFields());
    }

    /** @test */
    public function validate_document_name_is_required()
    {
        $this->loginAsUser();

        // name empty
        $this->post(route('documents.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_document_name_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // name 70 characters
        $this->post(route('documents.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_document_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('documents.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Document 1 name',
            'description' => 'Document 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_document()
    {
        $this->loginAsUser();
        $document = Document::factory()->create(['name' => 'Testing 123']);

        $this->visitRoute('documents.show', $document);
        $this->click('edit-document-'.$document->id);
        $this->seeRouteIs('documents.edit', $document);

        $this->submitForm(__('document.update'), $this->getEditFields());

        $this->seeRouteIs('documents.show', $document);

        $this->seeInDatabase('documents', $this->getEditFields([
            'id' => $document->id,
        ]));
    }

    /** @test */
    public function validate_document_name_update_is_required()
    {
        $this->loginAsUser();
        $document = Document::factory()->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('documents.update', $document), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_document_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $document = Document::factory()->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('documents.update', $document), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_document_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $document = Document::factory()->create(['name' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('documents.update', $document), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_document()
    {
        $this->loginAsUser();
        $document = Document::factory()->create();
        Document::factory()->create();

        $this->visitRoute('documents.edit', $document);
        $this->click('del-document-'.$document->id);
        $this->seeRouteIs('documents.edit', [$document, 'action' => 'delete']);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('documents', [
            'id' => $document->id,
        ]);
    }
}
