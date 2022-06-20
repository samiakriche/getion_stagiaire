<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_message_has_name_link_attribute()
    {
        $message = Message::factory()->create();

        $title = __('app.show_detail_title', [
            'name' => $message->name, 'type' => __('message.message'),
        ]);
        $link = '<a href="'.route('messages.show', $message).'"';
        $link .= ' title="'.$title.'">';
        $link .= $message->name;
        $link .= '</a>';

        $this->assertEquals($link, $message->name_link);
    }

    /** @test */
    public function a_message_has_belongs_to_creator_relation()
    {
        $message = Message::factory()->make();

        $this->assertInstanceOf(User::class, $message->creator);
        $this->assertEquals($message->creator_id, $message->creator->id);
    }
}
