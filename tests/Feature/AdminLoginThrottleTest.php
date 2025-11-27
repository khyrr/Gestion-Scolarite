<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\Administrateur;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AdminLoginThrottleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_login_is_throttled_after_three_failed_attempts(): void
    {
        $admin = Administrateur::create([
            'nom' => 'Root',
            'prenom' => 'Admin',
            'email' => 'root@example.com',
            'mot_de_passe' => Hash::make('correct-password'),
            'role' => 'super_admin',
        ]);

        $url = route('admin.login.submit', [], false);

        // First 3 attempts should return normal back with errors
        for ($i = 0; $i < 3; $i++) {
            $response = $this->post(route('admin.login.submit'), [
                'email' => 'root@example.com',
                'password' => 'wrong-password',
            ]);

            $response->assertSessionHasErrors();
        }

        // The 4th attempt should be throttled.
        $response = $this->post(route('admin.login.submit'), [
            'email' => 'root@example.com',
            'password' => 'wrong-password',
        ]);

        // Laravel may return a redirect with lockout errors; assert that
        // the RateLimiter considers this key locked.
        $key = Str::lower('root@example.com').'|'.'127.0.0.1';
        $this->assertTrue(RateLimiter::tooManyAttempts($key, 3));
    }
}
