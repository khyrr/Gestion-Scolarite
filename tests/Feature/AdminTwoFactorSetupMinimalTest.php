<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrateur;
use App\Services\TwoFactorService;
use Illuminate\Support\Facades\Hash;

class AdminTwoFactorSetupMinimalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function setup_page_uses_dashboard_layout_and_shows_qr_when_not_enabled()
    {
        $admin = Administrateur::create([
            'nom' => 'Setup',
            'prenom' => 'Tester',
            'email' => 'setup-minimal@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'admin',
            // ensure a secret exists so controller builds provisioningUri
            'two_factor_secret' => TwoFactorService::generateSecret(16),
            'two_factor_enabled' => false,
        ]);

        $this->actingAs($admin, 'admin')
            ->get(route('admin.2fa.setup'))
            ->assertStatus(200)
            // When using dashboard layout, the main wrapper should be present
            ->assertSee('main-wrapper')
            ->assertSee(__('app.two_factor_setup'))
            ->assertSee('img')
            ->assertSee('form');
    }
}
