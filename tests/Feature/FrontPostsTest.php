<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FrontPostsTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();

    }
    /**
     * A basic feature test example.
     */
    public function test_front_page_route(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /**
     * @return void
     */
    public function test_front_main_posts_page_consist_posts(): void
    {

        $this->user->posts()->create(Post::factory()->create()->toArray());

        $response = $this->get('/');

        $response->assertViewHas('posts', function($collect){
            return $collect->contains($this->user->posts->first());
        });
    }
}
