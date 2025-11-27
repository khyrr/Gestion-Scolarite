<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;

class AdminSettingsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function super_admin_can_access_ip_settings_and_sees_link_in_sidebar(): void
    {
        $admin = Administrateur::create([
            'nom' => 'Sec',
            'prenom' => 'Admin',
            'email' => 'sec-admin@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'super_admin',
        ]);

        $this->actingAs($admin, 'admin')
             ->get(route('admin.settings.ip'))
             ->assertStatus(200);

        // Confirm the link appears on the dashboard
        $this->actingAs($admin, 'admin')
             ->get(route('admin.dashboard'))
             ->assertStatus(200)
             ->assertSee(__('app.securite_ip'));
    }

    /** @test */
    public function non_super_admin_cannot_access_ip_settings_and_does_not_see_link(): void
    {
        $admin = Administrateur::create([
            'nom' => 'NotSec',
            'prenom' => 'Admin',
            'email' => 'notsec-admin@example.com',
            'mot_de_passe' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $this->actingAs($admin, 'admin')
             ->get(route('admin.settings.ip'))
             ->assertStatus(403);

        $this->actingAs($admin, 'admin')
             ->get(route('admin.dashboard'))
             ->assertStatus(200)
             ->assertDontSee(__('app.securite_ip'));
    }
}
