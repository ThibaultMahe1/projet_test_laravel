<?php

namespace Tests\PhpFeature;

use App\Models\Univers;
use App\Models\User;
use Tests\TestCase;

class FavoriteControllerTest extends TestCase
{
    public function test_toggle_favorite_requires_authentication()
    {
        $univers = Univers::factory()->create();

        $response = $this->post('/favorites/toggle', [
            'univers_id' => $univers->id,
        ]);

        $response->assertRedirect('/');
    }

    public function test_toggle_favorite_adds_and_removes_favorite()
    {
        $user = User::factory()->create();
        $univers = Univers::factory()->create();

        // Test adding to favorites
        $response = $this->actingAs($user)
            ->post('/favorites/toggle', [
                'univers_id' => $univers->id,
            ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'univers_id' => $univers->id,
        ]);

        // Test removing from favorites
        $response = $this->actingAs($user)
            ->post('/favorites/toggle', [
                'univers_id' => $univers->id,
            ]);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'univers_id' => $univers->id,
        ]);
    }
}
