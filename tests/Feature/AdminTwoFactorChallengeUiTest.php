<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrateur;
use App\Services\TwoFactorService;
use Illuminate\Support\Facades\Hash;

class AdminTwoFactorChallengeUiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function challenge_page_has_improved_layout_and_recovery_toggle()
    {
        $admin = Administrateur::create([
            'nom' => 'UI',
            'prenom' => 'Tester',
            'email' => 'ui-challenge@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'admin',
            'two_factor_enabled' => true,
            'two_factor_secret' => TwoFactorService::generateSecret(16),
        ]);

        $this->actingAs($admin, 'admin')
            ->withSession(['admin_2fa_pending' => true])
            ->get(route('admin.2fa.challenge'))
            ->assertStatus(200)
            ->assertSee('auth-form')
            ->assertSee('otp-input')
            ->assertSee('recovery-link')
            ->assertSee('auth-title')
            ->assertSee('btn-primary')
            // ensure large aside/branding copy is not present to keep UI minimal
            ->assertDontSee('Secure your account')
            ->assertDontSee('g-2fa-brand');
    }
}
