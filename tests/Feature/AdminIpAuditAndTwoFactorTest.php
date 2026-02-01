<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrateur;
use App\Models\AdminAllowedIp;
use Illuminate\Support\Facades\Hash;

class AdminIpAuditAndTwoFactorTest extends TestCase
{
     use RefreshDatabase;

     /** @test */
     public function ip_write_actions_require_2fa_when_admin_has_2fa_enabled(): void
     {
          $admin = Administrateur::create([
               'nom' => 'Two',
               'prenom' => 'Factor',
               'email' => '2fa-admin@example.com',
               'mot_de_passe' => Hash::make('secret123'),
               'role' => 'super_admin',
               'two_factor_enabled' => true,
          ]);

          // create should redirect to 2fa challenge when not passed
          $this->actingAs($admin, 'admin')
               ->post(route('admin.settings.ip.store'), ['ip_address' => '203.0.113.5', 'label' => 'Test'])
               ->assertRedirect(route('admin.2fa.challenge'));

          $entry = AdminAllowedIp::create(['ip_address' => '203.0.113.9', 'label' => 'Existing', 'is_active' => true, 'added_by' => $admin->id_administrateur]);

          $this->actingAs($admin, 'admin')
               ->patch(route('admin.settings.ip.toggle', $entry))
               ->assertRedirect(route('admin.2fa.challenge'));

          $this->actingAs($admin, 'admin')
               ->delete(route('admin.settings.ip.destroy', $entry))
               ->assertRedirect(route('admin.2fa.challenge'));
     }

     /** @test */
     public function ip_write_actions_log_activity_when_2fa_passed(): void
     {
          $admin = Administrateur::create([
               'nom' => 'Audit',
               'prenom' => 'Admin',
               'email' => 'audit-admin@example.com',
               'mot_de_passe' => Hash::make('secret123'),
               'role' => 'super_admin',
               'two_factor_enabled' => true,
          ]);

          // create (store)
          $this->actingAs($admin, 'admin')
               ->withSession(['admin_2fa_passed' => true])
               ->post(route('admin.settings.ip.store'), ['ip_address' => '198.51.100.7', 'label' => 'Audit test'])
               ->assertRedirect();

          $this->assertDatabaseHas('admin_allowed_ips', ['ip_address' => '198.51.100.7']);
          $this->assertTrue(\DB::table(config('activitylog.table_name'))->where('description', 'like', 'Added allowed IP%')->exists());

          // toggle (update)
          $entry = AdminAllowedIp::firstWhere('ip_address', '198.51.100.7');

          $this->actingAs($admin, 'admin')
               ->withSession(['admin_2fa_passed' => true])
               ->patch(route('admin.settings.ip.toggle', $entry))
               ->assertRedirect();

          $entry->refresh();
          $this->assertFalse($entry->is_active);
          $this->assertTrue(\DB::table(config('activitylog.table_name'))->where('description', 'like', 'Toggled IP%')->exists());

          // destroy (delete)
          $this->actingAs($admin, 'admin')
               ->withSession(['admin_2fa_passed' => true])
               ->delete(route('admin.settings.ip.destroy', $entry))
               ->assertRedirect();

          $this->assertDatabaseMissing('admin_allowed_ips', ['ip_address' => '198.51.100.7']);
          $this->assertTrue(\DB::table(config('activitylog.table_name'))->where('description', 'like', 'Deleted allowed IP%')->exists());
     }

     /** @test */
     public function non_super_admin_without_2fa_is_forbidden_from_sensitive_ip_writes(): void
     {
          $admin = Administrateur::create([
               'nom' => 'No2FA',
               'prenom' => 'Admin',
               'email' => 'no2fa-admin@example.com',
               'mot_de_passe' => Hash::make('secret123'),
               'role' => 'admin',
               'two_factor_enabled' => false,
          ]);

          $this->actingAs($admin, 'admin')
               ->post(route('admin.settings.ip.store'), ['ip_address' => '192.0.2.5', 'label' => 'No 2FA'])
               ->assertStatus(403);
     }

     /** @test */
     public function super_admin_without_2fa_is_redirected_to_setup_for_sensitive_ip_writes(): void
     {
          $admin = Administrateur::create([
               'nom' => 'MustSetup',
               'prenom' => 'Admin',
               'email' => 'mustsetup-admin@example.com',
               'mot_de_passe' => Hash::make('secret123'),
               'role' => 'super_admin',
               'two_factor_enabled' => false,
          ]);

          $this->actingAs($admin, 'admin')
               ->post(route('admin.settings.ip.store'), ['ip_address' => '192.0.2.6', 'label' => 'Must Setup'])
               ->assertRedirect(route('admin.2fa.setup'));
     }
}
