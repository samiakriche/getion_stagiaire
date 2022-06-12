<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\DemandeStage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class DemandeStageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_demande_stage_has_name_link_attribute()
    {
        $demandeStage = DemandeStage::factory()->create();

        $title = __('app.show_detail_title', [
            'name' => $demandeStage->name, 'type' => __('demande_stage.demande_stage'),
        ]);
        $link = '<a href="'.route('demande_stages.show', $demandeStage).'"';
        $link .= ' title="'.$title.'">';
        $link .= $demandeStage->name;
        $link .= '</a>';

        $this->assertEquals($link, $demandeStage->name_link);
    }

    /** @test */
    public function a_demande_stage_has_belongs_to_creator_relation()
    {
        $demandeStage = DemandeStage::factory()->make();

        $this->assertInstanceOf(User::class, $demandeStage->creator);
        $this->assertEquals($demandeStage->creator_id, $demandeStage->creator->id);
    }
}
