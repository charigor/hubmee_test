<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardPostsIndexTest extends TestCase
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
    public function test_dashboard_posts_index_page_access_for_auth_user(): void

    {

        $this->login();

        $response = $this->actingAs($this->user)->get($this->basePath);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_dashboard_posts_index_page_redirect_for_not_auth_user(): void
    {
        $response = $this->get($this->basePath);

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    /**
     * @return void
     */
    public function test_dashboard_posts_index_page_consist_empty_posts(): void
    {
        $this->login();
        $response = $this->get($this->basePath);

        $response->assertSee(__('No Posts'));
    }

    /**
     * @return void
     */
    public function test_dashboard_posts_index_page_consist_no_empty_posts(): void
    {
        $this->user->posts()->create(Post::factory()->create()->toArray());
        $this->login();
        $response = $this->get($this->basePath);

        $response->assertViewHas('posts', function($collect){
            return $collect->contains($this->user->posts->first());
        });
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
