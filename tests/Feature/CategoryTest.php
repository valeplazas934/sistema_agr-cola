<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_categories()
    {
        Category::factory()->count(3)->create();

        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $response = $this->get('/categories');
        $response->assertStatus(200);
    }

    public function test_user_can_create_category()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $response = $this->post('/categories', [
            'name' => 'Frutas',
            'description' => 'Categoría de frutas',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('categories', ['name' => 'Frutas']);
    }

    public function test_admin_can_edit_category()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create(['name' => 'Verduras']);

        $this->actingAs($admin);

        $response = $this->put("/categories/{$category->id}", [
            'name' => 'Verduras Modificadas',
            'description' => 'Modificado por admin',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('categories', ['name' => 'Verduras Modificadas']);
    }

    public function test_admin_can_delete_category()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();

        $this->actingAs($admin);

        $response = $this->delete("/categories/{$category->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_user_cannot_delete_category()
    {
        $user = User::factory()->create(['role' => 'user']);
        $category = Category::factory()->create();

        $this->actingAs($user);

        $response = $this->delete("/categories/{$category->id}");

        // Redirecciona porque no tiene permisos
        $response->assertStatus(403);
        $this->assertDatabaseHas('categories', ['id' => $category->id]);
    }
}