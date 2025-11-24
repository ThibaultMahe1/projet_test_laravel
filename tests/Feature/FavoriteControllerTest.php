<?php

use App\Models\Univers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->univers = Univers::factory()->create();
});

it('adds a favorite when toggled and removes when toggled again', function () {
    $this->actingAs($this->user);

    $response = $this->post(route('favorites.toggle'), ['univers_id' => $this->univers->id]);
    $response->assertJson(['status' => 'added']);

    $this->assertDatabaseHas('favorites', [
        'user_id' => $this->user->id,
        'univers_id' => $this->univers->id,
    ]);

    $response = $this->post(route('favorites.toggle'), ['univers_id' => $this->univers->id]);
    $response->assertJson(['status' => 'removed']);

    $this->assertDatabaseMissing('favorites', [
        'user_id' => $this->user->id,
        'univers_id' => $this->univers->id,
    ]);
});
