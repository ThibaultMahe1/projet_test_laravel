<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('logs out the user and redirects to home', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->get('/logout');

    $response->assertRedirect('/');
    $this->assertGuest();
});
