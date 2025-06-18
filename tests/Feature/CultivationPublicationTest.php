<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use App\Models\CultivationPublication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CultivationPublicationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear una categoría para todas las pruebas
        $this->category = Category::factory()->create();
    }

    public function test_normal_user_can_create_publication()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $response = $this->post('/cultivations', [
            'cropTitle' => 'Maíz',
            'cropContent' => 'Cultivo de maíz',
            'idUser' => $user->id,
            'idCategory' => $this->category->id,
            'creationDate' => now(),
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('cultivation_publications', ['cropTitle' => 'Maíz']);
    }

    public function test_user_can_view_all_publications()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        CultivationPublication::factory()->count(3)->create();
        $response = $this->get('/cultivations');
        $response->assertStatus(200);
    }

    public function test_user_can_edit_own_publication()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $publication = CultivationPublication::factory()->create([
            'idUser' => $user->id,
            'idCategory' => $this->category->id,
        ]);

        $response = $this->put("/cultivations/{$publication->id}", [
            'cropTitle' => 'Actualizado',
            'cropContent' => 'Contenido actualizado',
            'idCategory' => $this->category->id,
            'creationDate' => now(),
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('cultivation_publications', ['cropTitle' => 'Actualizado']);
    }

    public function test_user_cannot_edit_others_publication()
    {
        $user = User::factory()->create(['role' => 'user']);
        $otherUser = User::factory()->create(['role' => 'user']);

        $publication = CultivationPublication::factory()->create([
            'idUser' => $otherUser->id,
            'idCategory' => $this->category->id,
        ]);

        $this->actingAs($user);
        $response = $this->put("/cultivations/{$publication->id}", [
            'cropTitle' => 'Hackeado',
            'cropContent' => 'Intento no autorizado',
            'idCategory' => $this->category->id,
            'creationDate' => now(),
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_edit_any_publication()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $publication = CultivationPublication::factory()->create([
            'idCategory' => $this->category->id,
        ]);

        $this->actingAs($admin);
        $response = $this->put("/cultivations/{$publication->id}", [
            'cropTitle' => 'Admin editado',
            'cropContent' => 'Admin content',
            'idCategory' => $this->category->id,
            'creationDate' => now(),
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('cultivation_publications', ['cropTitle' => 'Admin editado']);
    }

    public function test_admin_can_delete_any_publication()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $publication = CultivationPublication::factory()->create();

        $this->actingAs($admin);
        $response = $this->delete("/cultivations/{$publication->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('cultivation_publications', ['id' => $publication->id]);
    }

    public function test_user_can_delete_own_publication()
    {
        $user = User::factory()->create(['role' => 'user']);
        $publication = CultivationPublication::factory()->create([
            'idUser' => $user->id,
            'idCategory' => $this->category->id,
        ]);

        $this->actingAs($user);
        $response = $this->delete("/cultivations/{$publication->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('cultivation_publications', ['id' => $publication->id]);
    }

    public function test_user_cannot_delete_others_publication()
    {
        $user = User::factory()->create(['role' => 'user']);
        $otherUser = User::factory()->create();
        $publication = CultivationPublication::factory()->create([
            'idUser' => $otherUser->id,
            'idCategory' => $this->category->id,
        ]);

        $this->actingAs($user);
        $response = $this->delete("/cultivations/{$publication->id}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('cultivation_publications', ['id' => $publication->id]);
    }
}