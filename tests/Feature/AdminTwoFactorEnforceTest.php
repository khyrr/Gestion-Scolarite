<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrateur;
use App\Services\TwoFactorService;
use Illuminate\Support\Facades\Hash;

class AdminTwoFactorEnforceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_with_2fa_enabled_cannot_access_dashboard_before_passing_challenge()
    {
        $secret = TwoFactorService::generateSecret(16);

        $admin = Administrateur::create([
            'nom' => 'Enforce',
            'prenom' => 'Tester',
            'email' => 'enforce@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'admin',
            'two_factor_enabled' => true,
            'two_factor_secret' => $secret,
        ]);

        $this->actingAs($admin, 'admin')
            ->get(route('admin.dashboard'))
            ->assertRedirect(route('admin.2fa.challenge'));
    }

    /** @test */
    public function admin_cannot_hit_other_admin_routes_before_passing_2fa()
    {
        $secret = TwoFactorService::generateSecret(16);

        $admin = Administrateur::create([
            'nom' => 'Enforce',
            'prenom' => 'Tester',
            'email' => 'enforce2@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'admin',
            'two_factor_enabled' => true,
            'two_factor_secret' => $secret,
        ]);

        $this->actingAs($admin, 'admin')
            ->get(route('admin.classes.index'))
            ->assertRedirect(route('admin.2fa.challenge'));
    }
}
