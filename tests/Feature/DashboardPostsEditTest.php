<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardPostsEditTest extends TestCase
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
        $this->user = User::factory()->has(Post::factory())->create();
    }

    /**
     * @return void
     */
    public function test_dashboard_posts_edit_page_access_for_auth_user(): void
    {
        $this->login();

        $response = $this->actingAs($this->user)->get($this->basePath.'/'.$this->user->posts->first()->id.'/edit');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_dashboard_posts_edit_page_redirect_for_not_auth_user(): void
    {
        $response = $this->get($this->basePath.'/'.$this->user->posts->first()->id.'/edit');

        $response->assertStatus(302);
    }
    public function test_dashboard_posts_edit_page_has_correct_values(): void
    {

        $this->login();

        $response = $this->actingAs($this->user)->get($this->basePath.'/'.$this->user->posts->first()->id.'/edit');

        $response->assertStatus(200);
        $response->assertViewHas('post',$this->user->posts->first());
        $response->assertViewHas('users');
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
