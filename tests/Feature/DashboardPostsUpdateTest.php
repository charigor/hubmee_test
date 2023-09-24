<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardPostsUpdateTest extends TestCase
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
    public function test_dashboard_posts_update(): void
    {
        $this->user->posts()->create(Post::factory()->create()->toArray());

        $post = [
            'title' => fake()->word(2),
            'body' => fake()->text(500),
            'user_id' => $this->user->id
        ];

        $this->login();

        $response  = $this->actingAs($this->user)->put($this->basePath.'/'.$this->user->posts()->latest()->first()->id, $post);

        $response->assertStatus(302);

        $response->assertRedirect($this->basePath);

        $this->assertDatabaseHas('posts',$post);

        $lastPost = $this->user->posts()->latest()->first();

        $this->assertEquals($post['title'], $lastPost->title);

        $this->assertEquals($post['body'], $lastPost->body);

        $this->assertEquals($post['user_id'], $lastPost->user_id);
    }
    public function test_dashboard_posts_update_with_invalid_values(): void
    {
        $this->user->posts()->create(Post::factory()->create()->toArray());

        $post = [
            'title' => '',
            'body' => fake()->text(500),
            'user_id' => ''
        ];

        $this->login();

        $response  = $this->actingAs($this->user)->put($this->basePath.'/'.$this->user->posts()->latest()->first()->id, $post);

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
