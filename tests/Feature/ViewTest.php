<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ViewTest extends TestCase
{
    public function test_welcome_screen_can_be_rendered()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    public function test_gyik_screen_can_be_rendered()
    {
        $response = $this->get('/gyik');

        $response->assertStatus(200);
    }

    public function test_dashboard_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_notice_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/notice');

        $response->assertStatus(200);
    }

    public function test_all_books_screen_can_be_rendered()
    {
        $response = $this->get(route('books.index'));

        $response->assertStatus(200);
    }

    public function test_owned_books_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('books.show', $user->id));

        $response->assertStatus(200);
    }

    public function test_create_book_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('books.create'));

        $response->assertStatus(200);
    }

    public function test_all_stories_screen_can_be_rendered()
    {
        $response = $this->get(route('stories.index'));

        $response->assertStatus(200);
    }

    public function test_owned_stories_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('stories.show', $user->id));

        $response->assertStatus(200);
    }

    public function test_create_story_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('stories.create'));

        $response->assertStatus(200);
    }

}
