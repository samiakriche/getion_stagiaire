<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Enseignant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class EnseignantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_enseignant_has_name_link_attribute()
    {
        $enseignant = Enseignant::factory()->create();

        $title = __('app.show_detail_title', [
            'name' => $enseignant->name, 'type' => __('enseignant.enseignant'),
        ]);
        $link = '<a href="'.route('enseignants.show', $enseignant).'"';
        $link .= ' title="'.$title.'">';
        $link .= $enseignant->name;
        $link .= '</a>';

        $this->assertEquals($link, $enseignant->name_link);
    }

    /** @test */
    public function a_enseignant_has_belongs_to_creator_relation()
    {
        $enseignant = Enseignant::factory()->make();

        $this->assertInstanceOf(User::class, $enseignant->creator);
        $this->assertEquals($enseignant->creator_id, $enseignant->creator->id);
    }
}
