<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class EtudiantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_etudiant_has_name_link_attribute()
    {
        $etudiant = Etudiant::factory()->create();

        $title = __('app.show_detail_title', [
            'name' => $etudiant->name, 'type' => __('etudiant.etudiant'),
        ]);
        $link = '<a href="'.route('etudiants.show', $etudiant).'"';
        $link .= ' title="'.$title.'">';
        $link .= $etudiant->name;
        $link .= '</a>';

        $this->assertEquals($link, $etudiant->name_link);
    }

    /** @test */
    public function a_etudiant_has_belongs_to_creator_relation()
    {
        $etudiant = Etudiant::factory()->make();

        $this->assertInstanceOf(User::class, $etudiant->creator);
        $this->assertEquals($etudiant->creator_id, $etudiant->creator->id);
    }
}
