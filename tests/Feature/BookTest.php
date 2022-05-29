<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{

    public function test_can_create_book()
    {
        $book = Book::factory()->create();

        $this->assertTrue($book->wasRecentlyCreated);
    }

}
