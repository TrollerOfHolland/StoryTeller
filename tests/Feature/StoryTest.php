<?php

namespace Tests\Feature;

use App\Models\Story;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoryTest extends TestCase
{
    public function test_can_create_story()
    {
        $story = Story::factory()->create();

        $this->assertTrue($story->wasRecentlyCreated);
    }
}
