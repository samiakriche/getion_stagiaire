<?php

namespace Tests\Unit\Policies;

use App\Models\Document;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class DocumentPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_document()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Document));
    }

    /** @test */
    public function user_can_view_document()
    {
        $user = $this->createUser();
        $document = Document::factory()->create();
        $this->assertTrue($user->can('view', $document));
    }

    /** @test */
    public function user_can_update_document()
    {
        $user = $this->createUser();
        $document = Document::factory()->create();
        $this->assertTrue($user->can('update', $document));
    }

    /** @test */
    public function user_can_delete_document()
    {
        $user = $this->createUser();
        $document = Document::factory()->create();
        $this->assertTrue($user->can('delete', $document));
    }
}
