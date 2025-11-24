<?php

namespace Tests\PhpFeature;

use App\Models\Univers;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UniversControllerTest extends TestCase
{
    public function test_index_displays_all_univers()
    {
        // Crée quelques univers de test
        $univers = Univers::factory()->count(3)->create();

        $response = $this->get('/');

        $response->assertStatus(200);
        foreach ($univers as $univ) {
            $response->assertSee($univ->nom);
        }
    }

    public function test_create_form_requires_authentication()
    {
        $response = $this->get('/univers/create');

        $response->assertRedirect('/');
    }

    public function test_store_creates_new_univers()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $imageFile = UploadedFile::fake()->image('univers.jpg')->size(8000); // 8KB
        $logoFile = UploadedFile::fake()->image('logo.jpg')->size(8000); // 8KB

        $data = [
            'nom' => 'Nouvel Univers',
            'description' => 'Description de test',
            'img_fond' => $imageFile,
            'logo' => $logoFile,
            'couleur_principal' => '#FF0000',
            'couleur_secondaire' => '#00FF00',
        ];

        $response = $this->actingAs($user)
            ->post('/univers', $data);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('univers', [
            'nom' => 'Nouvel Univers',
            'description' => 'Description de test',
            'couleur_principal' => '#FF0000',
            'couleur_secondaire' => '#00FF00',
        ]);

        Storage::disk('public')->assertExists('image/'.$imageFile->hashName());
        Storage::disk('public')->assertExists('image/'.$logoFile->hashName());
    }

    public function test_show_displays_univers_details()
    {
        $univers = Univers::factory()->create();

        $response = $this->get('/univers/'.$univers->id);

        $response->assertStatus(200);
        $response->assertSee($univers->nom);
        $response->assertSee($univers->description);
    }

    public function test_edit_form_requires_authentication()
    {
        $univers = Univers::factory()->create();

        $response = $this->get('/univers/'.$univers->id.'/edit');

        $response->assertRedirect('/');
    }

    public function test_update_modifies_univers()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $univers = Univers::factory()->create();

        $imageFile = UploadedFile::fake()->image('new_univers.jpg')->size(8000); // 8KB
        $logoFile = UploadedFile::fake()->image('new_logo.jpg')->size(8000); // 8KB

        $data = [
            'nom' => 'Univers Modifié',
            'description' => 'Nouvelle description',
            'img_fond' => $imageFile,
            'logo' => $logoFile,
            'couleur_principal' => '#0000FF',
            'couleur_secondaire' => '#FFFF00',
        ];

        $response = $this->actingAs($user)
            ->patch('/univers/'.$univers->id, $data);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('univers', [
            'id' => $univers->id,
            'nom' => 'Univers Modifié',
            'description' => 'Nouvelle description',
            'couleur_principal' => '#0000FF',
            'couleur_secondaire' => '#FFFF00',
        ]);

        Storage::disk('public')->assertExists('image/'.$imageFile->hashName());
        Storage::disk('public')->assertExists('image/'.$logoFile->hashName());
    }

    public function test_destroy_requires_admin_role()
    {
        $user = User::factory()->create(['admin' => false]);
        $univers = Univers::factory()->create();

        $response = $this->actingAs($user)
            ->delete('/univers/'.$univers->id);

        $response->assertStatus(403);

        $this->assertDatabaseHas('univers', ['id' => $univers->id]);
    }

    public function test_destroy_deletes_univers_as_admin()
    {
        Storage::fake('public');

        $admin = User::factory()->create(['admin' => true]);
        $univers = Univers::factory()->create([
            'img_fond' => 'image/test.jpg',
            'logo' => 'image/logo.jpg',
        ]);

        Storage::disk('public')->put('image/test.jpg', 'test content');
        Storage::disk('public')->put('image/logo.jpg', 'logo content');

        $response = $this->actingAs($admin)
            ->delete('/univers/'.$univers->id);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('univers', ['id' => $univers->id]);
        Storage::disk('public')->assertMissing('image/test.jpg');
        Storage::disk('public')->assertMissing('image/logo.jpg');
    }
}
