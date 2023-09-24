<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FrontShowPostTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->has(Post::factory())->create();

    }
    /**
     * A basic feature test example.
     */
    public function test_front_page_route(): void
    {
        $post = $this->user->posts()->latest()->first();
        $response = $this->get('/post/'. $post->id);

        $response->assertStatus(200);
    }
    /**
     * @return void
     */
    public function test_front_main_posts_page_consist_posts(): void
    {

        $post = $this->user->posts()->latest()->first();

        $response = $this->get('/post/'. $post->id);

        $response->assertViewHas('post',$post);
    }
}
