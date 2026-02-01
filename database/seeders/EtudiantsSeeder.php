<?php

namespace Database\Seeders;

use App\Models\Etudiant;
use App\Models\Classe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EtudiantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = Classe::all();
        
        if ($classes->isEmpty()) {
            $this->command->warn('No classes found. Run ClassesSeeder first.');
            return;
        }

        $students = [
            // Students for 6ème A
            [
                'nom' => 'Ba',
                'prenom' => 'Aissata',
                'telephone' => '+222 30 11 22 33',
                'adresse' => 'Tevragh Zeina, Nouakchott',
                'date_naissance' => '2010-03-15',
                'genre' => 'F',
                'id_classe' => $classes->where('nom_classe', '6ème A')->first()?->id_classe,
            ],
            [
                'nom' => 'Ould Ahmed',
                'prenom' => 'Mohamed Salem',
                'telephone' => '+222 30 11 22 34',
                'adresse' => 'Ksar, Nouakchott',
                'date_naissance' => '2010-07-22',
                'genre' => 'M',
                'id_classe' => $classes->where('nom_classe', '6ème A')->first()?->id_classe,
            ],
            [
                'nom' => 'Mint Sidi',
                'prenom' => 'Fatimata',
                'telephone' => '+222 30 11 22 35',
                'adresse' => 'El Mina, Nouakchott',
                'date_naissance' => '2010-11-08',
                'genre' => 'F',
                'id_classe' => $classes->where('nom_classe', '6ème A')->first()?->id_classe,
            ],
            
            // Students for 6ème B
            [
                'nom' => 'Ould Baba',
                'prenom' => 'Ahmed Mahmoud',
                'telephone' => '+222 30 11 22 36',
                'adresse' => 'Sebkha, Nouakchott',
                'date_naissance' => '2010-01-12',
                'genre' => 'M',
                'id_classe' => $classes->where('nom_classe', '6ème B')->first()?->id_classe,
            ],
            [
                'nom' => 'Sy',
                'prenom' => 'Mariama',
                'telephone' => '+222 30 11 22 37',
                'adresse' => 'Arafat, Nouakchott',
                'date_naissance' => '2010-05-30',
                'genre' => 'F',
                'id_classe' => $classes->where('nom_classe', '6ème B')->first()?->id_classe,
            ],
            
            // Students for 5ème A
            [
                'nom' => 'Ould Mohamed',
                'prenom' => 'Sidi Mohamed',
                'telephone' => '+222 30 11 22 38',
                'adresse' => 'Toujounine, Nouakchott',
                'date_naissance' => '2009-09-14',
                'genre' => 'M',
                'id_classe' => $classes->where('nom_classe', '5ème A')->first()?->id_classe,
            ],
            [
                'nom' => 'Mint Vall',
                'prenom' => 'Aïcha',
                'telephone' => '+222 30 11 22 39',
                'adresse' => 'Dar Naim, Nouakchott',
                'date_naissance' => '2009-02-28',
                'genre' => 'F',
                'id_classe' => $classes->where('nom_classe', '5ème A')->first()?->id_classe,
            ],
            
            // Students for Terminale S
            [
                'nom' => 'Kane',
                'prenom' => 'Ousmane',
                'telephone' => '+222 30 11 22 40',
                'adresse' => 'Riad, Nouakchott',
                'date_naissance' => '2005-12-10',
                'genre' => 'M',
                'id_classe' => $classes->where('nom_classe', 'Terminale S')->first()?->id_classe,
            ],
            [
                'nom' => 'Mint Ebnou',
                'prenom' => 'Khadijetou',
                'telephone' => '+222 30 11 22 41',
                'adresse' => 'Hay Saken, Nouakchott',
                'date_naissance' => '2005-08-16',
                'genre' => 'F',
                'id_classe' => $classes->where('nom_classe', 'Terminale S')->first()?->id_classe,
            ],
            
            // Students for CM2
            [
                'nom' => 'Diallo',
                'prenom' => 'Amadou',
                'telephone' => '+222 30 11 22 42',
                'adresse' => 'Medina, Nouakchott',
                'date_naissance' => '2012-04-25',
                'genre' => 'M',
                'id_classe' => $classes->where('nom_classe', 'CM2')->first()?->id_classe,
            ],
        ];

        foreach ($students as $index => $studentData) {
            if ($studentData['id_classe']) {
                // Add matricule to student data
                $studentData['matricule'] = 'ETU' . str_pad($index + 1, 4, '0', STR_PAD_LEFT);
                
                // Create Student record only (no User account for students)
                Etudiant::create($studentData);
            }
        }

        // Note: Random student generation temporarily disabled to avoid email duplicates
        // Can be re-enabled after implementing proper email uniqueness checks
    }

    private function getRandomFirstName(): string
    {
        $names = [
            'Mohamed', 'Ahmed', 'Sidi', 'Oumar', 'Abdallahi', 'Mohamed Lemine', 'Salem', 'Mahmoud',
            'Fatimata', 'Aissata', 'Mariem', 'Khadija', 'Aminetou', 'Aïcha', 'Khadijetou',
            'Amadou', 'Ousmane', 'Ibrahim', 'Youssef', 'Hassan'
        ];
        
        return $names[array_rand($names)];
    }

    private function getRandomLastName(): string
    {
        $lastNames = [
            'Ould Ahmed', 'Mint Sidi', 'Ba', 'Sy', 'Kane', 'Diallo', 'Ould Baba', 'Mint Vall',
            'Ould Mohamed', 'Mint Ebnou', 'Ould Abdallahi', 'Mint Mohamedou', 'Touré', 'Sow'
        ];
        
        return $lastNames[array_rand($lastNames)];
    }

    private function getRandomAddress(): string
    {
        $addresses = [
            'Tevragh Zeina, Nouakchott', 'Ksar, Nouakchott', 'El Mina, Nouakchott',
            'Sebkha, Nouakchott', 'Arafat, Nouakchott', 'Toujounine, Nouakchott',
            'Dar Naim, Nouakchott', 'Riad, Nouakchott', 'Hay Saken, Nouakchott', 'Medina, Nouakchott'
        ];
        
        return $addresses[array_rand($addresses)];
    }

    private function getRandomBirthDate(int $niveau): string
    {
        $baseYear = 2024 - $niveau - 5; // Approximate age calculation
        $year = $baseYear + rand(-1, 1); // Add some variation
        $month = rand(1, 12);
        $day = rand(1, 28);
        
        return sprintf('%d-%02d-%02d', $year, $month, $day);
    }
}
