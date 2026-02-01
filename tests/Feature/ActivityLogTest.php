<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;

class ActivityLogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function successful_admin_login_is_logged(): void
    {
        $admin = Administrateur::create([
            'nom' => 'A',
            'prenom' => 'Admin',
            'email' => 'alogin@example.com',
            'mot_de_passe' => Hash::make('secret123'),
            'role' => 'super_admin',
        ]);

        $this->post(route('admin.login.submit'), ['email' => 'alogin@example.com', 'password' => 'secret123'])
             ->assertRedirect();

        $this->assertDatabaseHas(config('activitylog.table_name'), [
            'description' => 'Admin login',
        ]);
    }

    /** @test */
    public function creating_admin_is_logged(): void
    {
        $creator = Administrateur::create([
            'nom' => 'Creator',
            'prenom' => 'One',
            'email' => 'creator@example.com',
            'mot_de_passe' => Hash::make('password'),
            'role' => 'super_admin',
        ]);

        $this->actingAs($creator, 'admin')
             ->post(route('admin.admins.store'), [
                'nom' => 'New',
                'prenom' => 'Admin',
                'email' => 'newadmin@example.com',
                'password' => 'secret123',
                'password_confirmation' => 'secret123',
                'role' => 'admin',
             ])->assertRedirect();

        $this->assertTrue(
            \DB::table(config('activitylog.table_name'))->where('description', 'like', 'Created new admin%')->exists()
        );
    }
}
