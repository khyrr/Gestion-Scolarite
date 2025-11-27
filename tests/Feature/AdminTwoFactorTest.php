<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrateur;
use App\Services\TwoFactorService;

class AdminTwoFactorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_setup_and_enable_2fa(): void
    {
        $admin = Administrateur::create([
            'nom' => 'Two',
            'prenom' => 'Factor',
            'email' => 'twofa@example.com',
            'mot_de_passe' => bcrypt('password123'),
            'role' => 'super_admin',
        ]);

        $this->actingAs($admin, 'admin')
            ->get(route('admin.2fa.setup'))
            ->assertStatus(200)
            ->assertSee('secret');

        $secret = $admin->fresh()->two_factor_secret;
        $code = TwoFactorService::generateCode($secret);

        $this->actingAs($admin, 'admin')
            ->post(route('admin.2fa.enable'), ['code' => $code])
            ->assertRedirect(route('admin.dashboard'));

        $this->assertTrue($admin->fresh()->two_factor_enabled);
    }

    /** @test */
    public function admin_with_2fa_enabled_is_redirected_to_challenge_for_dashboard(): void
    {
        $admin = Administrateur::create([
            'nom' => 'Two',
            'prenom' => 'Factor',
            'email' => 'twofa2@example.com',
            'mot_de_passe' => bcrypt('password123'),
            'role' => 'super_admin',
            'two_factor_secret' => TwoFactorService::generateSecret(),
            'two_factor_enabled' => true,
        ]);

        $this->actingAs($admin, 'admin')
            ->get(route('admin.dashboard'))
            ->assertRedirect(route('admin.2fa.challenge'));

        // Now post the correct code and expect successful redirect to dashboard
        $code = TwoFactorService::generateCode($admin->two_factor_secret);

        $this->actingAs($admin, 'admin')
            ->withSession(['admin_2fa_pending' => true])
            ->post(route('admin.2fa.verify'), ['code' => $code])
            ->assertRedirect(route('admin.dashboard'));

        // After the challenge, dashboard should be accessible
        $this->actingAs($admin, 'admin')
            ->withSession(['admin_2fa_passed' => true])
            ->get(route('admin.dashboard'))
            ->assertStatus(200);
    }
}
