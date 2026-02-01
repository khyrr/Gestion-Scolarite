<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check which columns exist in users table
        $hasAdresse = Schema::hasColumn('users', 'adresse');
        
        // Migrate data from users to etudiants
        if (Schema::hasColumn('users', 'nom') && Schema::hasColumn('users', 'prenom')) {
            $sql = "
                UPDATE etudiants e
                INNER JOIN users u ON u.profile_type = 'App\\\\Models\\\\Etudiant' AND u.profile_id = e.id_etudiant
                SET 
                    e.nom = COALESCE(u.nom, ''),
                    e.prenom = COALESCE(u.prenom, '')";
                    
            if (Schema::hasColumn('users', 'telephone')) {
                $sql .= ",\n                    e.telephone = u.telephone";
            }
            
            if ($hasAdresse) {
                $sql .= ",\n                    e.adresse = u.adresse";
            }
            
            $sql .= "\n                WHERE e.nom IS NULL OR e.nom = ''";
            
            DB::statement($sql);
        }

        // Migrate data from users to enseignants
        if (Schema::hasColumn('users', 'nom') && Schema::hasColumn('users', 'prenom')) {
            $sql = "
                UPDATE enseignants ens
                INNER JOIN users u ON u.profile_type = 'App\\\\Models\\\\Enseignant' AND u.profile_id = ens.id_enseignant
                SET 
                    ens.nom = COALESCE(u.nom, ''),
                    ens.prenom = COALESCE(u.prenom, '')";
                    
            if (Schema::hasColumn('users', 'telephone')) {
                $sql .= ",\n                    ens.telephone = u.telephone";
            }
            
            if ($hasAdresse) {
                $sql .= ",\n                    ens.adresse = u.adresse";
            }
            
            $sql .= "\n                WHERE ens.nom IS NULL OR ens.nom = ''";
            
            DB::statement($sql);
        }

        // Migrate data from users to administrateurs (if table exists)
        if (Schema::hasTable('administrateurs') && Schema::hasColumn('users', 'nom') && Schema::hasColumn('users', 'prenom')) {
            $sql = "
                UPDATE administrateurs a
                INNER JOIN users u ON u.profile_type = 'App\\\\Models\\\\Administrateur' AND u.profile_id = a.id_administrateur
                SET 
                    a.nom = COALESCE(u.nom, ''),
                    a.prenom = COALESCE(u.prenom, '')";
                    
            if (Schema::hasColumn('users', 'telephone')) {
                $sql .= ",\n                    a.telephone = u.telephone";
            }
            
            if ($hasAdresse) {
                $sql .= ",\n                    a.adresse = u.adresse";
            }
            
            $sql .= "\n                WHERE a.nom IS NULL OR a.nom = ''";
            
            DB::statement($sql);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No reverse migration - data is duplicated for safety
    }
};
