<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardPostsStoreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @return void
     */
    private string $basePath = '/dashboard';
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
     * @return void
     */
    public function test_dashboard_posts_store(): void
    {
        $post = [
            'title' => fake()->word,
            'body' => fake()->text(500),
            'user_id' => $this->user->id
        ];
        $this->login();

        $response  = $this->actingAs($this->user)->post($this->basePath, $post);

        $response->assertStatus(302);

        $response->assertRedirect($this->basePath);

        $this->assertDatabaseHas('posts',$post);

        $lastPost = Post::latest()->first();

        $this->assertEquals($post['title'], $lastPost->title);

        $this->assertEquals($post['body'], $lastPost->body);

        $this->assertEquals($post['user_id'], $lastPost->user_id);
    }

    public function test_dashboard_posts_store_with_invalid_values(): void
    {
        $post = [
            'title' => '',
            'body' => fake()->text(500),
            'user_id' => ''
        ];

        $this->login();

        $response  = $this->actingAs($this->user)->post($this->basePath, $post);

        $response->assertStatus(302);

        $response->assertInvalid(['title','user_id']);

    }
    /**
     * @return void
     */
    private function login(): void
    {
        $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);
    }
}
