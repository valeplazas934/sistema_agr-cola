<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_login_and_redirects_to_home()
    {
        // Crear un usuario normal
        $user = User::factory()->create([
            'name' => 'valeria',
            'lastName' => 'plazas',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Simular el login
        $response = $this->post('/login', [
            'email' => 'user@example.com',
            'password' => 'password',
        ]);

        // Verifica que se haya autenticado correctamente
        $this->assertAuthenticatedAs($user);

        // Verifica la redirección
        $response->assertRedirect('/home');
    }

    #[Test]
    public function admin_can_login_and_redirects_to_admin_dashboard()
    {
        // Crear un usuario admin
        $admin = User::factory()->create([
            'name' => 'juan',
            'lastName' => 'perez',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Simular el login
        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        // Verifica que se haya autenticado correctamente
        $this->assertAuthenticatedAs($admin);

        // Verifica la redirección
        $response->assertRedirect('/admin/dashboard');
    }
}