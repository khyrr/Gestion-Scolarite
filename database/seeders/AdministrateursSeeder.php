<?php

namespace Database\Seeders;

use App\Models\Administrateur;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministrateursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrators = [
            [
                'nom' => 'Directeur Principal',
                'prenom' => 'Mohamed',
                'email' => 'admin@ecole.com',
                'mot_de_passe' => Hash::make('password123'),
                'role' => 'super_admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Secrétaire Générale',
                'prenom' => 'Fatima',
                'email' => 'secretaire@ecole.com',
                'mot_de_passe' => Hash::make('password123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Comptable',
                'prenom' => 'Ahmed',
                'email' => 'comptable@ecole.com',
                'mot_de_passe' => Hash::make('password123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($administrators as $adminData) {
            // Create Administrator record in administrateurs table
            Administrateur::create($adminData);

            // Create User account for authentication (clean auth system)
            User::updateOrCreate(
                ['email' => $adminData['email']],
                [
                    'name' => $adminData['prenom'] . ' ' . $adminData['nom'],
                    'prenom' => $adminData['prenom'],
                    'nom' => $adminData['nom'],
                    'email' => $adminData['email'],
                    'password' => $adminData['mot_de_passe'],
                    'role' => 'admin',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
