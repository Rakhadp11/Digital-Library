<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
    }

    public function test_admin_can_authenticate_using_the_login_screen(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@gmail.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticated('backend');
        $response->assertRedirect(RouteServiceProvider::ADMIN_HOME);
    }

    public function test_admin_can_not_authenticate_with_invalid_password(): void
    {
        $this->post('/admin/login', [
            'email' => 'admin@gmail.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
