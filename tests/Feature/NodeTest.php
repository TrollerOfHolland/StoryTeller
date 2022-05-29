<?php

namespace Tests\Feature;

use App\Models\Node;
use App\Models\Story;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NodeTest extends TestCase
{
    public function test_can_create_node()
    {
        $story = Story::factory()->create();
        $node = Node::create([
            'story_id' => $story->id,
        ]);

        $this->assertTrue($story->wasRecentlyCreated);
        $this->assertTrue($node->wasRecentlyCreated);
    }

    public function test_can_update_node()
    {
        $story = Story::factory()->create();
        $node = Node::create([
            'story_id' => $story->id,
        ]);

        $this->assertTrue($story->wasRecentlyCreated);
        $this->assertTrue($node->wasRecentlyCreated);

        $node['content'] = 'dummy text';
        $node->update();
        $this->assertTrue($node->wasChanged());
    }
}
