<?php

namespace Tests\PhpFeature;

use App\Models\User;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_logout_requires_authentication()
    {
        $response = $this->get('/logout');

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function test_logout_destroys_session()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/logout');

        $response->assertStatus(302);
        $this->assertGuest();
    }
}
