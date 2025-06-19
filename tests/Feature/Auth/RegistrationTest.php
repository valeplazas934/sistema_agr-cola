<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Providers\RouteServiceProvider;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        Notification::fake();
        Event::fake();

        $response = $this->post('/register', [
            'name' => 'valeria',
            'lastName' => 'plazas',
            'email' => 'user@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user', // ← añade si tu base de datos lo necesita
        ]);

        $user = User::where('email', 'user@example.com')->first();
        $this->assertNotNull($user);

        $user->markEmailAsVerified();

        $this->assertTrue(Hash::check('password', $user->password));

        Auth::login($user);
        $this->assertAuthenticatedAs($user);

        $response->assertRedirect('/register');
    }
}