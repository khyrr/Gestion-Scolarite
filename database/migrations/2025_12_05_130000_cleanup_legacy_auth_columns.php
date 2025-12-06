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
        // Remove auth fields from administrateurs table
        Schema::table('administrateurs', function (Blueprint $table) {
            if (Schema::hasColumn('administrateurs', 'password')) {
                $table->dropColumn('password');
            }
            if (Schema::hasColumn('administrateurs', 'mot_de_passe')) {
                $table->dropColumn('mot_de_passe');
            }
            if (Schema::hasColumn('administrateurs', 'remember_token')) {
                $table->dropColumn('remember_token');
            }
            if (Schema::hasColumn('administrateurs', 'role')) {
                $table->dropColumn('role');
            }
        });

        // Remove auth fields from enseignants table
        Schema::table('enseignants', function (Blueprint $table) {
            if (Schema::hasColumn('enseignants', 'password')) {
                $table->dropColumn('password');
            }
            if (Schema::hasColumn('enseignants', 'mot_de_passe')) {
                $table->dropColumn('mot_de_passe');
            }
            if (Schema::hasColumn('enseignants', 'remember_token')) {
                $table->dropColumn('remember_token');
            }
            if (Schema::hasColumn('enseignants', 'email_verified_at')) {
                $table->dropColumn('email_verified_at');
            }
        });

        // Remove auth fields from etudiants table
        Schema::table('etudiants', function (Blueprint $table) {
            if (Schema::hasColumn('etudiants', 'password')) {
                $table->dropColumn('password');
            }
            if (Schema::hasColumn('etudiants', 'mot_de_passe')) {
                $table->dropColumn('mot_de_passe');
            }
            if (Schema::hasColumn('etudiants', 'remember_token')) {
                $table->dropColumn('remember_token');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We cannot easily restore the data, but we can restore the columns
        Schema::table('administrateurs', function (Blueprint $table) {
            $table->string('password')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->string('role')->default('admin');
        });

        Schema::table('enseignants', function (Blueprint $table) {
            $table->string('password')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamp('email_verified_at')->nullable();
        });

        Schema::table('etudiants', function (Blueprint $table) {
            $table->string('password')->nullable();
            $table->string('remember_token', 100)->nullable();
        });
    }
};
