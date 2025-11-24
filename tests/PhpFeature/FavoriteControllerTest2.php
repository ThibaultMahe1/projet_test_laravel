<?php

namespace Tests\PhpFeature;

use App\Models\Univers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoriteControllerTest2 extends TestCase
{
    use RefreshDatabase;

    public function test_toggle_favorite_requires_authentication()
    {
        $univers = Univers::factory()->create();

        $response = $this->post('/favorites/toggle', [
            'univers_id' => $univers->id,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_toggle_favorite_adds_and_removes_favorite()
    {
        $user = User::factory()->create();
        $univers = Univers::factory()->create();

        $this->actingAs($user);

        // Test adding to favorites
        $response = $this->post('/favorites/toggle', [
            'univers_id' => $univers->id,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'univers_id' => $univers->id,
        ]);

        // Test removing from favorites
        $response = $this->post('/favorites/toggle', [
            'univers_id' => $univers->id,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'univers_id' => $univers->id,
        ]);
    }
}
