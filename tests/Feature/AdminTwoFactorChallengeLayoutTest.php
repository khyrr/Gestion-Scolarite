<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrateur;
use App\Services\TwoFactorService;
use Illuminate\Support\Facades\Hash;

class AdminTwoFactorChallengeLayoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function challenge_page_is_rendered_standalone_without_dashboard_shell()
    {
        $admin = Administrateur::create([
            'nom' => 'Challenge',
            'prenom' => 'Layout',
            'email' => 'layout-challenge@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'admin',
            'two_factor_enabled' => true,
            'two_factor_secret' => TwoFactorService::generateSecret(16),
        ]);

        $this->actingAs($admin, 'admin')
            ->withSession(['admin_2fa_pending' => true])
            ->get(route('admin.2fa.challenge'))
            ->assertStatus(200)
            // ensure the dashboard structure doesn't appear
            ->assertDontSee('class="main-wrapper"')
            ->assertDontSee('sidebar-overlay')
            // confirm the challenge card exists
            ->assertSee('auth-card');
    }
}
