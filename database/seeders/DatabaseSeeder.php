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
        $this->command->info('🌱 Starting database seeding...');

        // Seed in order of dependencies
        $this->call([
            RolesAndPermissionsSeeder::class, // Must run first for Spatie roles
            AdministrateursSeeder::class,
            ClassesSeeder::class,
            EnseignantsSeeder::class,
            EtudiantsSeeder::class,
            MatieresSeeder::class,
            EnseignantMatiereClasseSeeder::class,
            CoursSeeder::class,
            EvaluationsSeeder::class,
            NotesSeeder::class,
        ]);

        $this->command->info('✅ Database seeding completed successfully!');
        $this->command->line('');
        $this->command->info('📊 Summary:');
        $this->command->info('   - Administrators: ' . \App\Models\Administrateur::count());
        $this->command->info('   - Classes: ' . \App\Models\Classe::count());
        $this->command->info('   - Teachers: ' . \App\Models\Enseignant::count());
        $this->command->info('   - Students: ' . \App\Models\Etudiant::count());
        $this->command->info('   - Courses: ' . \App\Models\Cours::count());
        $this->command->info('   - Users (Login Accounts): ' . \App\Models\User::count());
        $this->command->line('');
        $this->command->info('🔑 Default login credentials:');
        $this->command->info('   Super Admin: admin@ecole.com / password123');
        $this->command->info('   Teacher: elmoctar@ecole.com / teacher123');
        $this->command->line('');
        $this->command->info('📚 Students access grades via public search using matricule');
        $this->command->info('   Example matricule: ETU0001, ETU0002, etc.');
    }
}
