<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrateur;
use Spatie\Activitylog\Models\Activity as ActivityModel;
use Illuminate\Support\Facades\Hash;

class ActivityLogUiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function super_admin_can_view_logs_and_filter(): void
    {
        $admin = Administrateur::create([
            'nom' => 'Audit',
            'prenom' => 'Admin',
            'email' => 'audit@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'super_admin',
        ]);

        // create sample logs
        activity()->withProperties(['ip' => '127.0.0.1', 'resource' => 'administrateur'])->log('Test login');
        activity()->withProperties(['ip' => '1.2.3.4', 'resource' => 'enseignant'])->log('failed');

        $this->actingAs($admin, 'admin')
             ->get(route('admin.logs.index'))
             ->assertStatus(200)
             ->assertSee('Test login')
             ->assertSee('failed');

        // filter by user_type
        $this->actingAs($admin, 'admin')
             ->get(route('admin.logs.index', ['user_type' => 'teacher']))
             ->assertStatus(200)
             ->assertDontSee('Test login')
             ->assertSee('failed');
    }

    /** @test */
    public function non_super_admin_cannot_view_logs(): void
    {
        $admin = Administrateur::create([
            'nom' => 'Not',
            'prenom' => 'Super',
            'email' => 'not_super@example.com',
            'mot_de_passe' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $this->actingAs($admin, 'admin')
             ->get(route('admin.logs.index'))
             ->assertStatus(403);
    }

    /** @test */
    public function super_admin_can_export_csv(): void
    {
        $admin = Administrateur::create([
            'nom' => 'Exporter',
            'prenom' => 'Admin',
            'email' => 'export@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'super_admin',
        ]);

        activity()->withProperties(['ip' => '127.0.0.1', 'resource' => 'administrateur'])->log('Test login');

        $response = $this->actingAs($admin, 'admin')->get(route('admin.logs.export'));
        $response->assertStatus(200);
        $this->assertStringContainsString('text/csv', $response->headers->get('content-type'));
        $content = $response->streamedContent();
        $this->assertStringContainsString('Test login', $content);
    }

    /** @test */
    public function super_admin_sees_activity_logs_link_in_sidebar(): void
    {
        $admin = Administrateur::create([
            'nom' => 'Nav',
            'prenom' => 'Admin',
            'email' => 'nav@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'super_admin',
        ]);

        $this->actingAs($admin, 'admin')
             ->get(route('admin.dashboard'))
             ->assertStatus(200)
             ->assertSee(route('admin.logs.index'))
             ->assertSee(__('app.activity_logs'));
    }

    /** @test */
    public function super_admin_sees_two_factor_link_in_sidebar(): void
    {
        $admin = Administrateur::create([
            'nom' => 'Tfa',
            'prenom' => 'Admin',
            'email' => 'tfa@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'super_admin',
        ]);

        $this->actingAs($admin, 'admin')
             ->get(route('admin.dashboard'))
             ->assertStatus(200)
             ->assertSee(route('admin.2fa.setup'))
             ->assertSee(__('app.two_factor'));
    }

        /** @test */
        public function super_admin_sees_create_administrator_link_in_sidebar(): void
        {
            $admin = Administrateur::create([
                'nom' => 'Nav',
                'prenom' => 'Admin',
                'email' => 'nav-create@example.com',
                'mot_de_passe' => Hash::make('secret123'),
                'role' => 'super_admin',
            ]);

            $this->actingAs($admin, 'admin')
                 ->get(route('admin.dashboard'))
                 ->assertStatus(200)
                 ->assertSee(route('admin.admins.create'))
                 ->assertSee(__('app.creer_admin'));
        }

    /** @test */
    public function non_super_admin_does_not_see_activity_logs_link_in_sidebar(): void
    {
        $admin = Administrateur::create([
            'nom' => 'Normal',
            'prenom' => 'Admin',
            'email' => 'normal@example.com',
            'mot_de_passe' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $this->actingAs($admin, 'admin')
             ->get(route('admin.dashboard'))
             ->assertStatus(200)
             ->assertDontSee(route('admin.logs.index'))
             ->assertDontSee(__('app.activity_logs'));
    }

    /** @test */
    public function non_super_admin_does_not_see_two_factor_link_in_sidebar(): void
    {
        $admin = Administrateur::create([
            'nom' => 'Normal',
            'prenom' => 'Admin',
            'email' => 'normal2@example.com',
            'mot_de_passe' => Hash::make('password'),
            'role' => 'admin',
        ]);

           $this->actingAs($admin, 'admin')
               ->get(route('admin.dashboard'))
               ->assertStatus(200)
               ->assertSee(route('admin.2fa.setup'))
               ->assertSee(__('app.two_factor'));
    }

        /** @test */
        public function non_super_admin_does_not_see_create_administrator_link_in_sidebar(): void
        {
            $admin = Administrateur::create([
                'nom' => 'Normal',
                'prenom' => 'Admin',
                'email' => 'normal-create@example.com',
                'mot_de_passe' => Hash::make('password'),
                'role' => 'admin',
            ]);

            $this->actingAs($admin, 'admin')
                 ->get(route('admin.dashboard'))
                 ->assertStatus(200)
                 ->assertDontSee(route('admin.admins.create'))
                 ->assertDontSee(__('app.creer_admin'));
        }
}
