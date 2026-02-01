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
        // Make adresse nullable in all profile tables
        Schema::table('etudiants', function (Blueprint $table) {
            $table->string('adresse')->nullable()->change();
        });

        Schema::table('enseignants', function (Blueprint $table) {
            if (Schema::hasColumn('enseignants', 'adresse')) {
                $table->string('adresse')->nullable()->change();
            }
        });

        Schema::table('administratifs', function (Blueprint $table) {
            if (Schema::hasColumn('administratifs', 'adresse')) {
                $table->string('adresse')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('etudiants', function (Blueprint $table) {
            $table->string('adresse')->nullable(false)->change();
        });

        Schema::table('enseignants', function (Blueprint $table) {
            if (Schema::hasColumn('enseignants', 'adresse')) {
                $table->string('adresse')->nullable(false)->change();
            }
        });

        Schema::table('administratifs', function (Blueprint $table) {
            if (Schema::hasColumn('administratifs', 'adresse')) {
                $table->string('adresse')->nullable(false)->change();
            }
        });
    }
};
