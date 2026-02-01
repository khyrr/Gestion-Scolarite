<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add identity fields to etudiants
        Schema::table('etudiants', function (Blueprint $table) {
            if (!Schema::hasColumn('etudiants', 'nom')) {
                $table->string('nom')->nullable()->after('matricule');
            }
            if (!Schema::hasColumn('etudiants', 'prenom')) {
                $table->string('prenom')->nullable()->after('nom');
            }
            if (!Schema::hasColumn('etudiants', 'telephone')) {
                $table->string('telephone')->nullable()->after('prenom');
            }
            if (!Schema::hasColumn('etudiants', 'adresse')) {
                $table->text('adresse')->nullable()->after('telephone');
            }
        });

        // Add identity fields to enseignants
        Schema::table('enseignants', function (Blueprint $table) {
            if (!Schema::hasColumn('enseignants', 'nom')) {
                $table->string('nom')->nullable()->after('id_enseignant');
            }
            if (!Schema::hasColumn('enseignants', 'prenom')) {
                $table->string('prenom')->nullable()->after('nom');
            }
            if (!Schema::hasColumn('enseignants', 'telephone')) {
                $table->string('telephone')->nullable()->after('prenom');
            }
            if (!Schema::hasColumn('enseignants', 'adresse')) {
                $table->text('adresse')->nullable()->after('telephone');
            }
        });

        // Add identity fields to administrateurs (if table exists)
        if (Schema::hasTable('administrateurs')) {
            Schema::table('administrateurs', function (Blueprint $table) {
                if (!Schema::hasColumn('administrateurs', 'nom')) {
                    $table->string('nom')->nullable()->after('id_administrateur');
                }
                if (!Schema::hasColumn('administrateurs', 'prenom')) {
                    $table->string('prenom')->nullable()->after('nom');
                }
                if (!Schema::hasColumn('administrateurs', 'telephone')) {
                    $table->string('telephone')->nullable()->after('prenom');
                }
                if (!Schema::hasColumn('administrateurs', 'adresse')) {
                    $table->text('adresse')->nullable()->after('telephone');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('etudiants', function (Blueprint $table) {
            $table->dropColumn(['nom', 'prenom', 'telephone', 'adresse']);
        });

        Schema::table('enseignants', function (Blueprint $table) {
            $table->dropColumn(['nom', 'prenom', 'telephone', 'adresse']);
        });

        if (Schema::hasTable('administrateurs')) {
            Schema::table('administrateurs', function (Blueprint $table) {
                $table->dropColumn(['nom', 'prenom', 'telephone', 'adresse']);
            });
        }
    }
};
