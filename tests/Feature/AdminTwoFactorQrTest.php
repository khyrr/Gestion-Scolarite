<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrateur;
use App\Services\TwoFactorService;
use Illuminate\Support\Facades\Hash;

class AdminTwoFactorQrTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function setup_view_shows_qr_image_when_provisioning_uri_present()
    {
        $admin = Administrateur::create([
            'nom' => 'QR',
            'prenom' => 'Tester',
            'email' => 'qr-tester@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'admin',
            // ensure there's a secret so controller builds a provisioningUri
            'two_factor_secret' => TwoFactorService::generateSecret(16),
            'two_factor_enabled' => false,
        ]);

        $this->actingAs($admin, 'admin')
            ->get(route('admin.2fa.setup'))
            ->assertStatus(200)
            ->assertSee('data:image/png');
    }
}
