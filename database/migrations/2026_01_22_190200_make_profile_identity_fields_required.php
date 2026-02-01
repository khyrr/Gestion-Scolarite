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
        // Fill any remaining nulls with placeholder values
        DB::table('etudiants')->whereNull('nom')->update(['nom' => 'À renseigner']);
        DB::table('etudiants')->whereNull('prenom')->update(['prenom' => 'À renseigner']);
        
        DB::table('enseignants')->whereNull('nom')->update(['nom' => 'À renseigner']);
        DB::table('enseignants')->whereNull('prenom')->update(['prenom' => 'À renseigner']);
        
        if (Schema::hasTable('administrateurs')) {
            DB::table('administrateurs')->whereNull('nom')->update(['nom' => 'À renseigner']);
            DB::table('administrateurs')->whereNull('prenom')->update(['prenom' => 'À renseigner']);
        }
        
        // Make identity fields NOT NULL after filling defaults
        Schema::table('etudiants', function (Blueprint $table) {
            $table->string('nom')->nullable(false)->change();
            $table->string('prenom')->nullable(false)->change();
        });

        Schema::table('enseignants', function (Blueprint $table) {
            $table->string('nom')->nullable(false)->change();
            $table->string('prenom')->nullable(false)->change();
        });

        if (Schema::hasTable('administrateurs')) {
            Schema::table('administrateurs', function (Blueprint $table) {
                $table->string('nom')->nullable(false)->change();
                $table->string('prenom')->nullable(false)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('etudiants', function (Blueprint $table) {
            $table->string('nom')->nullable()->change();
            $table->string('prenom')->nullable()->change();
        });

        Schema::table('enseignants', function (Blueprint $table) {
            $table->string('nom')->nullable()->change();
            $table->string('prenom')->nullable()->change();
        });

        if (Schema::hasTable('administrateurs')) {
            Schema::table('administrateurs', function (Blueprint $table) {
                $table->string('nom')->nullable()->change();
                $table->string('prenom')->nullable()->change();
            });
        }
    }
};
