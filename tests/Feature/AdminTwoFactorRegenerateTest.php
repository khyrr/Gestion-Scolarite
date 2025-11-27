<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrateur;
use App\Services\TwoFactorService;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Hash;

class AdminTwoFactorRegenerateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function regenerate_requires_valid_password_and_current_code_and_generates_new_secret(): void
    {
        $secret = TwoFactorService::generateSecret(16);

        $admin = Administrateur::create([
            'nom' => 'Reg',
            'prenom' => 'Admin',
            'email' => 'reg-admin@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'super_admin',
            'two_factor_secret' => $secret,
            'two_factor_enabled' => true,
            'two_factor_recovery_codes' => json_encode(array_map(fn($i) => bin2hex(random_bytes(6)), range(1, 8))),
        ]);

        $code = TwoFactorService::generateCode($secret);

        $this->actingAs($admin, 'admin')
            ->withSession(['admin_2fa_passed' => true])
            ->post(route('admin.2fa.regenerate'), ['password' => 'secret123', 'code' => $code])
            ->assertStatus(200)
            ->assertSee('secret');

        $admin->refresh();
        $this->assertTrue($admin->two_factor_enabled, '2FA should remain enabled with old secret until new is verified');
        $this->assertEquals($secret, $admin->two_factor_secret, 'old secret should remain in database');
        $this->assertNotEmpty($admin->two_factor_recovery_codes);

        $this->assertDatabaseHas('activity_logs', [
            'user_type' => 'admin',
            'action' => '2fa_regenerate_initiated',
            'resource' => 'administrateur',
        ]);
    }

    /** @test */
    public function regenerate_consumes_recovery_code_if_used_and_allows_regeneration(): void
    {
        $secret = TwoFactorService::generateSecret(16);
        $recovery = array_map(fn($i) => bin2hex(random_bytes(6)), range(1, 4));

        $admin = Administrateur::create([
            'nom' => 'Rec',
            'prenom' => 'Admin',
            'email' => 'rec-admin@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'super_admin',
            'two_factor_secret' => $secret,
            'two_factor_enabled' => true,
            'two_factor_recovery_codes' => json_encode($recovery),
        ]);

        $used = $recovery[0];

        $this->actingAs($admin, 'admin')
            ->withSession(['admin_2fa_passed' => true])
            ->post(route('admin.2fa.regenerate'), ['password' => 'secret123', 'code' => $used])
            ->assertStatus(200)
            ->assertSee('secret');

        $admin->refresh();
        $codesLeft = json_decode($admin->two_factor_recovery_codes, true) ?: [];
        // original used code should be removed (we consumed it before regeneration; new codes were generated so they should not include the old code)
        $this->assertNotContains($used, $codesLeft);
        $this->assertNotEmpty($admin->two_factor_secret);
    }

    /** @test */
    public function regenerate_fails_with_invalid_password_or_code(): void
    {
        $secret = TwoFactorService::generateSecret(16);

        $admin = Administrateur::create([
            'nom' => 'Fail',
            'prenom' => 'Admin',
            'email' => 'fail-admin@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'super_admin',
            'two_factor_secret' => $secret,
            'two_factor_enabled' => true,
        ]);

        $this->actingAs($admin, 'admin')
            ->withSession(['admin_2fa_passed' => true])
            ->post(route('admin.2fa.regenerate'), ['password' => 'wrong', 'code' => '000000'])
            ->assertSessionHasErrors(['password']);

        $code = TwoFactorService::generateCode($secret);
        $this->actingAs($admin, 'admin')
            ->withSession(['admin_2fa_passed' => true])
            ->post(route('admin.2fa.regenerate'), ['password' => 'secret123', 'code' => '000000'])
            ->assertSessionHasErrors(['code']);
    }

    /** @test */
    public function enabled_user_seeing_setup_gets_status_and_not_secret(): void
    {
        $secret = TwoFactorService::generateSecret(16);

        $admin = Administrateur::create([
            'nom' => 'Status',
            'prenom' => 'Admin',
            'email' => 'status-admin@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'admin',
            'two_factor_secret' => $secret,
            'two_factor_enabled' => true,
        ]);

        $this->actingAs($admin, 'admin')
            ->get(route('admin.2fa.setup'))
            ->assertStatus(200)
            ->assertSee(__('app.deux_facteurs_active_court'))
            ->assertDontSee($secret);
    }

    /** @test */
    public function regeneration_keeps_old_secret_active_until_new_is_verified(): void
    {
        $oldSecret = TwoFactorService::generateSecret(16);

        $admin = Administrateur::create([
            'nom' => 'Safe',
            'prenom' => 'Admin',
            'email' => 'safe-admin@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'super_admin',
            'two_factor_secret' => $oldSecret,
            'two_factor_enabled' => true,
            'two_factor_recovery_codes' => json_encode(array_map(fn($i) => bin2hex(random_bytes(6)), range(1, 8))),
        ]);

        $oldCode = TwoFactorService::generateCode($oldSecret);

        // Initiate regeneration
        $this->actingAs($admin, 'admin')
            ->withSession(['admin_2fa_passed' => true])
            ->post(route('admin.2fa.regenerate'), ['password' => 'secret123', 'code' => $oldCode])
            ->assertStatus(200);

        $admin->refresh();
        // Database should still have old secret and be enabled
        $this->assertEquals($oldSecret, $admin->two_factor_secret);
        $this->assertTrue($admin->two_factor_enabled);

        // Old secret should still work for login
        $this->assertTrue(TwoFactorService::verifyCode($oldSecret, TwoFactorService::generateCode($oldSecret)));

        // Now verify the new secret to complete regeneration
        // Get the new secret from session (simulate)
        $pending = session('admin_2fa_pending_regeneration');
        $newSecret = $pending['new_secret'];
        $newCode = TwoFactorService::generateCode($newSecret);

        $this->actingAs($admin, 'admin')
            ->post(route('admin.2fa.enable'), ['code' => $newCode])
            ->assertRedirect(route('admin.dashboard'));

        $admin->refresh();
        // Now database should have new secret
        $this->assertEquals($newSecret, $admin->two_factor_secret);
        $this->assertTrue($admin->two_factor_enabled);
        $this->assertNotEquals($oldSecret, $admin->two_factor_secret);
    }

    /** @test */
    public function show_setup_displays_pending_regeneration_data(): void
    {
        $oldSecret = TwoFactorService::generateSecret(16);

        $admin = Administrateur::create([
            'nom' => 'Pending',
            'prenom' => 'Admin',
            'email' => 'pending-admin@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'super_admin',
            'two_factor_secret' => $oldSecret,
            'two_factor_enabled' => true,
            'two_factor_recovery_codes' => json_encode(array_map(fn($i) => bin2hex(random_bytes(6)), range(1, 8))),
        ]);

        $oldCode = TwoFactorService::generateCode($oldSecret);

        // Initiate regeneration
        $this->actingAs($admin, 'admin')
            ->withSession(['admin_2fa_passed' => true])
            ->post(route('admin.2fa.regenerate'), ['password' => 'secret123', 'code' => $oldCode])
            ->assertStatus(200);

        // Now GET the setup page should show the pending regeneration data
        $this->actingAs($admin, 'admin')
            ->withSession(['admin_2fa_passed' => true])
            ->get(route('admin.2fa.setup'))
            ->assertStatus(200)
            ->assertSee('secret') // Should show QR/setup
            ->assertDontSee(__('app.deux_facteurs_active_court')); // Should not show enabled state
    }
}
