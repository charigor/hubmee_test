<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardPostsDeleteTest extends TestCase
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
    public function test_dashboard_posts_delete(): void
    {
        $this->user->posts()->create(Post::factory()->create()->toArray());
        $post = $this->user->posts()->latest()->first();

        $this->login();

        $response  = $this->actingAs($this->user)->delete($this->basePath.'/'.$post->id);

        $response->assertStatus(302);

        $response->assertRedirect($this->basePath);

        $this->assertDatabaseMissing('posts',$post->toArray());

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
