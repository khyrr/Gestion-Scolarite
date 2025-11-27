<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\Enseignant;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class TeacherLoginThrottleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function teacher_login_is_throttled_after_five_failed_attempts(): void
    {
        $teacher = Enseignant::create([
            'prenom' => 'First',
            'nom' => 'Teacher',
            'email' => 'teacher2@example.com',
            'telephone' => '+222000001',
            'mot_de_passe' => Hash::make('correct'),
            'is_active' => true,
        ]);

        // First 5 attempts should fail normally
        for ($i = 0; $i < 5; $i++) {
            $this->post(route('enseignant.connexion.submit'), [
                'email' => 'teacher2@example.com',
                'password' => 'wrong',
            ])->assertSessionHasErrors();
        }

        // 6th attempt should be throttled - assert RateLimiter shows this key is locked
        $this->post(route('enseignant.connexion.submit'), [
            'email' => 'teacher2@example.com',
            'password' => 'wrong',
        ]);

        $key = Str::lower('teacher2@example.com').'|'.'127.0.0.1';
        $this->assertTrue(RateLimiter::tooManyAttempts($key, 5));
    }
}
