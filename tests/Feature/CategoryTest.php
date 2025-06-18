<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_category()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->post('/categories', [
            'name' => 'Frutas',
            'description' => 'Categoría de frutas',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('categories', ['name' => 'Frutas']);
    }

    public function test_user_cannot_create_category()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $response = $this->post('/categories', [
            'name' => 'Verduras',
            'description' => 'Categoría de verduras',
        ]);

        $response->assertStatus(403); // o Redirect con error según el middleware
    }
}