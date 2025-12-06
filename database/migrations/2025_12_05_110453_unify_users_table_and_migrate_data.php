<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add columns to users table
        Schema::table('users', function (Blueprint $table) {
            // Change role to string to allow any role (it was enum)
            $table->string('role')->default('user')->change(); 
            
            if (!Schema::hasColumn('users', 'profile_type')) {
                $table->nullableMorphs('profile'); // Adds profile_type and profile_id
            }
        });

        // 2. Migrate Administrateurs
        $admins = DB::table('administrateurs')->get();
        foreach ($admins as $admin) {
            // Check if user already exists with this email
            $existingUser = DB::table('users')->where('email', $admin->email)->first();
            
            if (!$existingUser) {
                DB::table('users')->insert([
                    'name' => $admin->nom . ' ' . $admin->prenom,
                    'email' => $admin->email,
                    'password' => $admin->password, // Already hashed and renamed
                    'role' => 'admin',
                    'profile_type' => 'App\\Models\\Administrateur',
                    'profile_id' => $admin->id_administrateur,
                    'created_at' => $admin->created_at,
                    'updated_at' => $admin->updated_at,
                ]);
            } else {
                // Update existing user to link profile
                DB::table('users')->where('id', $existingUser->id)->update([
                    'role' => 'admin',
                    'profile_type' => 'App\\Models\\Administrateur',
                    'profile_id' => $admin->id_administrateur,
                ]);
            }
        }

        // 3. Migrate Enseignants
        $teachers = DB::table('enseignants')->get();
        foreach ($teachers as $teacher) {
            $existingUser = DB::table('users')->where('email', $teacher->email)->first();

            if (!$existingUser) {
                DB::table('users')->insert([
                    'name' => $teacher->nom . ' ' . $teacher->prenom,
                    'email' => $teacher->email,
                    'password' => $teacher->password, // Already hashed and renamed
                    'role' => 'teacher',
                    'profile_type' => 'App\\Models\\Enseignant',
                    'profile_id' => $teacher->id_enseignant,
                    'created_at' => $teacher->created_at,
                    'updated_at' => $teacher->updated_at,
                ]);
            } else {
                 DB::table('users')->where('id', $existingUser->id)->update([
                    'role' => 'teacher',
                    'profile_type' => 'App\\Models\\Enseignant',
                    'profile_id' => $teacher->id_enseignant,
                ]);
            }
        }

        // 4. Migrate Etudiants
        $students = DB::table('etudiants')->get();
        foreach ($students as $student) {
            // Students might not have email, or duplicate email. 
            // If email is null, we can't create a user easily (users.email is unique).
            // For now, skip if email is null.
            if (!$student->email) continue;

            $existingUser = DB::table('users')->where('email', $student->email)->first();

            if (!$existingUser) {
                DB::table('users')->insert([
                    'name' => $student->nom . ' ' . $student->prenom,
                    'email' => $student->email,
                    'password' => Hash::make('password'), // Default password
                    'role' => 'student',
                    'profile_type' => 'App\\Models\\Etudiant',
                    'profile_id' => $student->id_etudiant,
                    'created_at' => $student->created_at,
                    'updated_at' => $student->updated_at,
                ]);
            } else {
                 DB::table('users')->where('id', $existingUser->id)->update([
                    'role' => 'student',
                    'profile_type' => 'App\\Models\\Etudiant',
                    'profile_id' => $student->id_etudiant,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'profile_type', 'profile_id']);
        });
    }
};
