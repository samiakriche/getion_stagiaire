<?php

namespace Tests\Feature;

use App\Models\Message;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageMessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_message_list_in_message_index_page()
    {
        $message = Message::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('messages.index');
        $this->see($message->name);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Message 1 name',
            'description' => 'Message 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_message()
    {
        $this->loginAsUser();
        $this->visitRoute('messages.index');

        $this->click(__('message.create'));
        $this->seeRouteIs('messages.create');

        $this->submitForm(__('message.create'), $this->getCreateFields());

        $this->seeRouteIs('messages.show', Message::first());

        $this->seeInDatabase('messages', $this->getCreateFields());
    }

    /** @test */
    public function validate_message_name_is_required()
    {
        $this->loginAsUser();

        // name empty
        $this->post(route('messages.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_message_name_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // name 70 characters
        $this->post(route('messages.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_message_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('messages.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Message 1 name',
            'description' => 'Message 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_message()
    {
        $this->loginAsUser();
        $message = Message::factory()->create(['name' => 'Testing 123']);

        $this->visitRoute('messages.show', $message);
        $this->click('edit-message-'.$message->id);
        $this->seeRouteIs('messages.edit', $message);

        $this->submitForm(__('message.update'), $this->getEditFields());

        $this->seeRouteIs('messages.show', $message);

        $this->seeInDatabase('messages', $this->getEditFields([
            'id' => $message->id,
        ]));
    }

    /** @test */
    public function validate_message_name_update_is_required()
    {
        $this->loginAsUser();
        $message = Message::factory()->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('messages.update', $message), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_message_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $message = Message::factory()->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('messages.update', $message), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_message_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $message = Message::factory()->create(['name' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('messages.update', $message), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_message()
    {
        $this->loginAsUser();
        $message = Message::factory()->create();
        Message::factory()->create();

        $this->visitRoute('messages.edit', $message);
        $this->click('del-message-'.$message->id);
        $this->seeRouteIs('messages.edit', [$message, 'action' => 'delete']);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('messages', [
            'id' => $message->id,
        ]);
    }
}
