<?php

use App\Models\Univers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('update replaces files and updates model when provided', function () {
    Storage::fake('public');

    $admin = User::factory()->create(['admin' => 1]);

    // existing univers with files
    $univers = Univers::factory()->create([
        'img_fond' => 'image/old_fond.jpg',
        'logo' => 'image/old_logo.png',
    ]);

    Storage::disk('public')->put('image/old_fond.jpg', 'old');
    Storage::disk('public')->put('image/old_logo.png', 'old');

    $newImage = UploadedFile::fake()->image('newfond.jpg')->size(8000);
    $newLogo = UploadedFile::fake()->image('newlogo.png')->size(8000);

    $data = [
        'nom' => 'Updated Name',
        'description' => 'Updated',
        'img_fond' => $newImage,
        'logo' => $newLogo,
        'couleur_principal' => '#111111',
        'couleur_secondaire' => '#222222',
    ];

    $response = $this->actingAs($admin)->patch('/univers/'.$univers->id, $data);

    $response->assertRedirect('/');

    // old files removed
    Storage::disk('public')->assertMissing('image/old_fond.jpg');
    Storage::disk('public')->assertMissing('image/old_logo.png');

    // new files exist
    Storage::disk('public')->assertExists('image/'.$newImage->hashName());
    Storage::disk('public')->assertExists('image/'.$newLogo->hashName());

    $this->assertDatabaseHas('univers', ['id' => $univers->id, 'nom' => 'Updated Name']);
});

it('destroy deletes univers and removes files when user is admin', function () {
    Storage::fake('public');

    $admin = User::factory()->create(['admin' => 1]);

    $univers = Univers::factory()->create([
        'img_fond' => 'image/to_delete.jpg',
        'logo' => 'image/to_delete_logo.png',
    ]);

    Storage::disk('public')->put('image/to_delete.jpg', 'content');
    Storage::disk('public')->put('image/to_delete_logo.png', 'content');

    $response = $this->actingAs($admin)->delete('/univers/'.$univers->id);

    $response->assertRedirect('/');

    $this->assertDatabaseMissing('univers', ['id' => $univers->id]);

    Storage::disk('public')->assertMissing('image/to_delete.jpg');
    Storage::disk('public')->assertMissing('image/to_delete_logo.png');
});
