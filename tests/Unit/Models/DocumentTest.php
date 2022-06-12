<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Document;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class DocumentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_document_has_name_link_attribute()
    {
        $document = Document::factory()->create();

        $title = __('app.show_detail_title', [
            'name' => $document->name, 'type' => __('document.document'),
        ]);
        $link = '<a href="'.route('documents.show', $document).'"';
        $link .= ' title="'.$title.'">';
        $link .= $document->name;
        $link .= '</a>';

        $this->assertEquals($link, $document->name_link);
    }

    /** @test */
    public function a_document_has_belongs_to_creator_relation()
    {
        $document = Document::factory()->make();

        $this->assertInstanceOf(User::class, $document->creator);
        $this->assertEquals($document->creator_id, $document->creator->id);
    }
}
