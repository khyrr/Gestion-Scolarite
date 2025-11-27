<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Enseignant;
use App\Models\Classe;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EnseignantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get classes for assignment
        $classes = Classe::all();
        
        $enseignants = [
            [
                'nom' => 'El Moctar',
                'prenom' => 'Sidi Mohamed',
                'email' => 'elmoctar@ecole.com',
                'telephone' => '+222 20 11 22 33',
                'matiere' => 'Mathématiques',
                'id_classe' => $classes->where('nom_classe', '6ème A')->first()?->id_classe ?? 1,
            ],
            [
                'nom' => 'Mint Mohamedou',
                'prenom' => 'Aminetou',
                'email' => 'aminetou@ecole.com',
                'telephone' => '+222 20 11 22 34',
                'matiere' => 'Français',
                'id_classe' => $classes->where('nom_classe', '6ème B')->first()?->id_classe ?? 2,
            ],
            [
                'nom' => 'Ould Baba',
                'prenom' => 'Oumar',
                'email' => 'oumar@ecole.com',
                'telephone' => '+222 20 11 22 35',
                'matiere' => 'Sciences Physiques',
                'id_classe' => $classes->where('nom_classe', '5ème A')->first()?->id_classe ?? 3,
            ],
            [
                'nom' => 'Mint Ahmed',
                'prenom' => 'Khadija',
                'email' => 'khadija@ecole.com',
                'telephone' => '+222 20 11 22 36',
                'matiere' => 'Anglais',
                'id_classe' => $classes->where('nom_classe', 'Terminale S')->first()?->id_classe ?? 4,
            ],
            [
                'nom' => 'Ould Sid Ahmed',
                'prenom' => 'Mohamed Lemine',
                'email' => 'lemine@ecole.com',
                'telephone' => '+222 20 11 22 37',
                'matiere' => 'Histoire-Géographie',
                'id_classe' => $classes->where('nom_classe', 'CM2')->first()?->id_classe ?? 5,
            ],
        ];

        foreach ($enseignants as $teacherData) {
            // Only insert fields that exist on the enseignants table.
            // 'matiere' and 'id_classe' were removed and are handled via the
            // enseignant_matiere_classe pivot table (see EnseignantMatiereClasseSeeder).
            $enseignantData = [
                'nom' => $teacherData['nom'],
                'prenom' => $teacherData['prenom'],
                'email' => $teacherData['email'],
                'telephone' => $teacherData['telephone'],
            ];

            // Create Teacher record in enseignants table
            Enseignant::create($enseignantData);

            // Create User account for authentication (clean auth system)
            // Do not attempt to write 'matiere' or 'id_classe' into users –
            // those columns were removed from users table in a migration.
            User::updateOrCreate(
                ['email' => $teacherData['email']],
                [
                    'name' => $teacherData['prenom'] . ' ' . $teacherData['nom'],
                    'prenom' => $teacherData['prenom'],
                    'nom' => $teacherData['nom'],
                    'email' => $teacherData['email'],
                    'password' => Hash::make('password123'),
                    'role' => 'enseignant',
                    'telephone' => $teacherData['telephone'],
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}