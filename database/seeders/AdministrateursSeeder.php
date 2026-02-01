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
                'telephone' => '+222 20 00 11 22',
                'adresse' => 'Tevragh Zeina, Nouakchott',
                'email' => 'admin@ecole.com',
                'password' => 'password123',
                'role' => 'super_admin',
            ],
            [
                'nom' => 'Secrétaire Générale',
                'prenom' => 'Fatima',
                'telephone' => '+222 20 00 11 23',
                'adresse' => 'Ksar, Nouakchott',
                'email' => 'secretaire@ecole.com',
                'password' => 'password123',
                'role' => 'admin',
            ],
            [
                'nom' => 'Comptable',
                'prenom' => 'Ahmed',
                'telephone' => '+222 20 00 11 24',
                'adresse' => 'El Mina, Nouakchott',
                'email' => 'comptable@ecole.com',
                'password' => 'password123',
                'role' => 'admin',
            ]
        ];

        foreach ($administrators as $data) {
            // Create Administrator profile record
            $admin = Administrateur::create([
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'telephone' => $data['telephone'],
                'adresse' => $data['adresse'],
            ]);

            // Create User account with polymorphic relationship
            $user = User::create([
                'name' => trim($data['prenom'] . ' ' . $data['nom']),
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'is_active' => true,
                'email_verified_at' => now(),
                'profile_type' => Administrateur::class,
                'profile_id' => $admin->id_administrateur,
            ]);

            // Assign role using Spatie
            $user->assignRole($data['role']);
        }
    }
}
