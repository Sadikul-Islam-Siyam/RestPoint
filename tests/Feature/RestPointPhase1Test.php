<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RestPointPhase1Test extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guests can access homepage.
     */
    public function test_guest_can_view_homepage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Where Flames', false);
        $response->assertSee('Never Die', false);
    }

    /**
     * Test guests can view list of games.
     */
    public function test_guest_can_view_game_library()
    {
        $game = Game::factory()->create([
            'name' => 'Elden Ring',
            'slug' => 'elden-ring',
            'genre' => 'Action RPG',
        ]);

        $response = $this->get('/games');
        $response->assertStatus(200);
        $response->assertSee('Elden Ring');
    }

    /**
     * Test guests can view a single game page.
     */
    public function test_guest_can_view_individual_game_page()
    {
        $game = Game::factory()->create([
            'name' => 'Cyberpunk 2077',
            'slug' => 'cyberpunk-2077',
            'genre' => 'Sci-Fi RPG',
        ]);

        $response = $this->get('/games/cyberpunk-2077');
        $response->assertStatus(200);
        $response->assertSee('Cyberpunk 2077');
    }

    /**
     * Test unauthorized users cannot view admin pages.
     */
    public function test_unauthenticated_user_cannot_access_admin_panel()
    {
        $response = $this->get('/admin/games');
        $response->assertRedirect('/login');
    }

    /**
     * Test regular members cannot view admin pages.
     */
    public function test_regular_user_cannot_access_admin_panel()
    {
        $user = User::factory()->create(['role' => 'member']);

        $response = $this->actingAs($user)->get('/admin/games');
        $response->assertStatus(403);
    }

    /**
     * Test admin role can access admin pages.
     */
    public function test_admin_can_access_admin_panel()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/games');
        $response->assertStatus(200);
    }
}
