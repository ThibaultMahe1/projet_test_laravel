<?php

use App\Models\Univers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can be favorited and returns the users who favorited it', function () {
    $user = User::factory()->create();
    $univers = Univers::factory()->create();

    $user->favorites()->attach($univers->id);

    $univers->refresh();

    expect($univers->favoritedBy->contains('id', $user->id))->toBeTrue();
    expect($univers->favoritedBy->count())->toBe(1);
});
