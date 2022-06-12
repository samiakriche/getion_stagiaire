<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Encadrant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class EncadrantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_encadrant_has_name_link_attribute()
    {
        $encadrant = Encadrant::factory()->create();

        $title = __('app.show_detail_title', [
            'name' => $encadrant->name, 'type' => __('encadrant.encadrant'),
        ]);
        $link = '<a href="'.route('encadrants.show', $encadrant).'"';
        $link .= ' title="'.$title.'">';
        $link .= $encadrant->name;
        $link .= '</a>';

        $this->assertEquals($link, $encadrant->name_link);
    }

    /** @test */
    public function a_encadrant_has_belongs_to_creator_relation()
    {
        $encadrant = Encadrant::factory()->make();

        $this->assertInstanceOf(User::class, $encadrant->creator);
        $this->assertEquals($encadrant->creator_id, $encadrant->creator->id);
    }
}
