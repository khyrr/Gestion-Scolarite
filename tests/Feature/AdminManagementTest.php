<?php

namespace Tests\Feature;

use App\Models\Administrateur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_super_admin_cannot_view_admin_creation_page()
    {
        $admin = Administrateur::create([
            'nom' => 'Normal',
            'prenom' => 'Admin',
            'email' => 'normal@example.com',
            'mot_de_passe' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $this->actingAs($admin, 'admin')
             ->get('/admins/create')
             ->assertStatus(403);
    }

    /** @test */
    public function super_admin_can_create_a_new_admin()
    {
        $super = Administrateur::create([
            'nom' => 'Super',
            'prenom' => 'Admin',
            'email' => 'super@example.com',
            'mot_de_passe' => Hash::make('password'),
            'role' => 'super_admin',
        ]);

           $this->actingAs($super, 'admin')
               ->get('/admins/create')
               ->assertStatus(200);

        $payload = [
            'nom' => 'New',
            'prenom' => 'Admin',
            'email' => 'newadmin@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'role' => 'admin',
        ];

        $this->actingAs($super, 'admin')
             ->post('/admins', $payload)
             ->assertRedirect();

        $this->assertDatabaseHas('administrateurs', [
            'email' => 'newadmin@example.com',
            'role' => 'admin',
        ]);
    }

    /** @test */
    public function non_super_admin_is_forbidden_from_storing_new_admins()
    {
        $admin = Administrateur::create([
            'nom' => 'Normal',
            'prenom' => 'Admin',
            'email' => 'normal2@example.com',
            'mot_de_passe' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $payload = [
            'nom' => 'Attempt',
            'prenom' => 'Create',
            'email' => 'attempt@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'role' => 'admin',
        ];

        $this->actingAs($admin, 'admin')
             ->post('/admins', $payload)
             ->assertStatus(403);

        $this->assertDatabaseMissing('administrateurs', [
            'email' => 'attempt@example.com',
        ]);
    }
}
