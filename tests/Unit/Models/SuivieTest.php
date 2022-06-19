<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Suivie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class SuivieTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_suivie_has_name_link_attribute()
    {
        $suivie = Suivie::factory()->create();

        $title = __('app.show_detail_title', [
            'name' => $suivie->name, 'type' => __('suivie.suivie'),
        ]);
        $link = '<a href="'.route('suivies.show', $suivie).'"';
        $link .= ' title="'.$title.'">';
        $link .= $suivie->name;
        $link .= '</a>';

        $this->assertEquals($link, $suivie->name_link);
    }

    /** @test */
    public function a_suivie_has_belongs_to_creator_relation()
    {
        $suivie = Suivie::factory()->make();

        $this->assertInstanceOf(User::class, $suivie->creator);
        $this->assertEquals($suivie->creator_id, $suivie->creator->id);
    }
}
