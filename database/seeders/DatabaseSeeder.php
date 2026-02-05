<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🌱 Starting comprehensive database seeding...');
        $this->command->line('');

        // Seed in order of dependencies
        $seeders = [
            ['seeder' => RolesAndPermissionsSeeder::class, 'description' => 'Roles & Permissions'],
            ['seeder' => AdministrateursSeeder::class, 'description' => 'Super Admin Users'],
            ['seeder' => ClassesSeeder::class, 'description' => 'School Classes'],
            ['seeder' => MatieresSeeder::class, 'description' => 'School Subjects'], 
            ['seeder' => EnseignantsSeeder::class, 'description' => 'Teachers'],
            ['seeder' => EtudiantsSeeder::class, 'description' => 'Students'],
            ['seeder' => EnseignantMatiereClasseSeeder::class, 'description' => 'Teacher-Subject-Class assignments'],
            ['seeder' => CoursSeeder::class, 'description' => 'Course schedules'],
            ['seeder' => EvaluationsSeeder::class, 'description' => 'Evaluations'],
            ['seeder' => NotesSeeder::class, 'description' => 'Student grades'],
            ['seeder' => EtudePaiementSeeder::class, 'description' => 'Student payments'],
            ['seeder' => EnseignPaiementSeeder::class, 'description' => 'Teacher payments'],
            ['seeder' => DefaultPagesSeeder::class, 'description' => 'Default Pages & Site Settings'],
        ];
        
        foreach ($seeders as $seeder) {
            $this->command->info('📋 Seeding: ' . $seeder['description']);
            $this->call($seeder['seeder']);
            $this->command->line('');
        }

        $this->displaySummary();
    }
    
    private function displaySummary(): void
    {
        $this->command->info('✅ Database seeding completed successfully!');
        $this->command->line('');
        
        // Display comprehensive statistics
        $stats = [
            ['label' => 'Users (Total)', 'count' => \App\Models\User::count(), 'icon' => '👥'],
            ['label' => 'Super Admins', 'count' => \App\Models\Administrateur::count(), 'icon' => '🛡️'],
            ['label' => 'Teachers', 'count' => \App\Models\Enseignant::count(), 'icon' => '👨‍🏫'],
            ['label' => 'Students', 'count' => \App\Models\Etudiant::count(), 'icon' => '👨‍🎓'],
            ['label' => 'Classes', 'count' => \App\Models\Classe::count(), 'icon' => '🏫'],
            ['label' => 'Subjects', 'count' => \App\Models\Matiere::count(), 'icon' => '📚'],
            ['label' => 'Courses', 'count' => \App\Models\Cours::count(), 'icon' => '📅'],
            ['label' => 'Evaluations', 'count' => \App\Models\Evaluation::count(), 'icon' => '📝'],
            ['label' => 'Grades', 'count' => \App\Models\Note::count(), 'icon' => '📊'],            ['label' => 'Student Payments', 'count' => \App\Models\EtudePaiement::count(), 'icon' => '💰'],
            ['label' => 'Teacher Payments', 'count' => \App\Models\EnseignPaiement::count(), 'icon' => '💼'],        ];
        
        $this->command->info('📊 Database Summary:');
        foreach ($stats as $stat) {
            $this->command->info(sprintf('   %s %s: %d', $stat['icon'], $stat['label'], $stat['count']));
        }
        
        $this->command->line('');
        $this->command->info('🔑 Default Login Credentials:');
        $this->command->info('   🛡️ Super Admin:');
        $this->command->info('      📧 admin@ecole.com');
        $this->command->info('      🔒 password123');
        $this->command->line('');
        $this->command->info('   👨‍🏫 Teachers (examples):');
        $this->command->info('      📧 elmoctar@ecole.com (with management permissions)');
        $this->command->info('      📧 mariama.ba@ecole.com');
        $this->command->info('      🔒 teacher123');
        $this->command->line('');
        $this->command->info('   👨‍🎓 Students (examples):');
        $this->command->info('      📧 ousmane.kane@student.ecole.com');
        $this->command->info('      📧 khadijetou.ebnou@student.ecole.com');
        $this->command->info('      🔒 student123');
        $this->command->line('');
        
        // Show sample matricules
        $sampleStudents = \App\Models\Etudiant::take(3)->get();
        if ($sampleStudents->isNotEmpty()) {
            $this->command->info('🎯 Sample Student Matricules:');
            foreach ($sampleStudents as $student) {
                $this->command->info(sprintf('      📋 %s - %s %s', 
                    $student->matricule, 
                    $student->prenom, 
                    $student->nom
                ));
            }
        }
        
        $this->command->line('');
        $this->command->info('🚀 System ready for use!');
    }
}
