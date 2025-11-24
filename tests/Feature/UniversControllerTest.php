<?php

use App\Models\Univers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('index displays list of univers', function () {
    Univers::factory()->count(3)->create();

    $response = $this->get('/');

    $response->assertOk();
    $response->assertViewHas('list');
});

it('store saves a new univers with uploaded files', function () {
    Storage::fake('public');

    $user = App\Models\User::factory()->create();

    $image = UploadedFile::fake()->image('fond.jpg')->size(8000);
    $logo = UploadedFile::fake()->image('logo.png')->size(8000);

    $data = [
        'nom' => 'Mon Univers',
        'description' => 'Description',
        'img_fond' => $image,
        'logo' => $logo,
        'couleur_principal' => '#ffffff',
        'couleur_secondaire' => '#000000',
    ];

    $response = $this->actingAs($user)->post('/univers', $data);

    $response->assertRedirect('/');

    Storage::disk('public')->assertExists('image/'.$image->hashName());
    Storage::disk('public')->assertExists('image/'.$logo->hashName());

    $this->assertTrue(App\Models\Univers::where('nom', 'Mon Univers')->exists());
});
