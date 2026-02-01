<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrateur;
use App\Services\TwoFactorService;
use Illuminate\Support\Facades\Hash;

class AdminTwoFactorAuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_with_2fa_enabled_is_redirected_to_challenge_on_login(): void
    {
        $secret = TwoFactorService::generateSecret(16);

        $admin = Administrateur::create([
            'nom' => 'MFA',
            'prenom' => 'User',
            'email' => 'mfa-admin@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'admin',
            'two_factor_enabled' => true,
            'two_factor_secret' => $secret,
        ]);

        $response = $this->post(route('admin.login.submit'), ['email' => 'mfa-admin@example.com', 'password' => 'secret123']);

        $response->assertRedirect(route('admin.2fa.challenge'));
    }

    /** @test */
    public function non_super_admin_can_setup_and_enable_but_cannot_disable_2fa(): void
    {
        $admin = Administrateur::create([
            'nom' => 'Normal',
            'prenom' => 'Admin',
            'email' => 'normal-admin@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'admin',
        ]);

        // show setup view should be available
        $this->actingAs($admin, 'admin')
            ->get(route('admin.2fa.setup'))
            ->assertStatus(200);

        // The controller generates a secret when viewing setup - reload admin and ensure secret present
        $admin->refresh();
        $this->assertNotEmpty($admin->two_factor_secret);

        // Generate a valid TOTP code and enable
        $code = \App\Services\TwoFactorService::generateCode($admin->two_factor_secret);

        $this->actingAs($admin, 'admin')
            ->post(route('admin.2fa.enable'), ['code' => $code])
            ->assertRedirect(route('admin.dashboard'));

        $admin->refresh();
        $this->assertTrue((bool) $admin->two_factor_enabled);

        // ensure an activity log was created for enabling 2FA
        $this->assertTrue(\DB::table(config('activitylog.table_name'))->where('description', 'like', '%Enabled two-factor%')->exists());

        // disable should be forbidden for non-super_admin
        $this->actingAs($admin, 'admin')
            ->post(route('admin.2fa.disable'))
            ->assertStatus(403);
    }

    /** @test */
    public function super_admin_can_setup_enable_and_disable_2fa(): void
    {
        $admin = Administrateur::create([
            'nom' => 'Super',
            'prenom' => 'Admin',
            'email' => 'super-2fa@example.com',
            'mot_de_passe' => Hash::make('password'),
            'role' => 'super_admin',
        ]);

        // show setup should succeed
        $this->actingAs($admin, 'admin')
            ->get(route('admin.2fa.setup'))
            ->assertStatus(200)
            ->assertSee('secret');

        // ensure there's a secret to verify against - the controller will create one
        $admin->refresh();
        $this->assertNotEmpty($admin->two_factor_secret);

        // generate a valid TOTP code and enable
        $code = TwoFactorService::generateCode($admin->two_factor_secret);

        $this->actingAs($admin, 'admin')
            ->post(route('admin.2fa.enable'), ['code' => $code])
            ->assertRedirect(route('admin.dashboard'));

        $admin->refresh();
        $this->assertTrue((bool) $admin->two_factor_enabled);

        $this->assertTrue(\DB::table(config('activitylog.table_name'))->where('description', 'like', '%Enabled two-factor%')->exists());

        // now disable should be allowed
        $this->actingAs($admin, 'admin')
            ->post(route('admin.2fa.disable'))
            ->assertRedirect(route('admin.dashboard'));

        $admin->refresh();
        $this->assertFalse((bool) $admin->two_factor_enabled);

        $this->assertTrue(\DB::table(config('activitylog.table_name'))->where('description', 'like', '%Disabled two-factor%')->exists());
    }
}
