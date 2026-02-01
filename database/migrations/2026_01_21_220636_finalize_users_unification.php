<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add 2FA columns to users table
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'two_factor_secret')) {
                $table->text('two_factor_secret')->after('password')->nullable();
            }
            if (!Schema::hasColumn('users', 'two_factor_recovery_codes')) {
                $table->text('two_factor_recovery_codes')->after('two_factor_secret')->nullable();
            }
            if (!Schema::hasColumn('users', 'two_factor_enabled')) {
                $table->boolean('two_factor_enabled')->after('two_factor_recovery_codes')->default(false);
            }
        });

        // 2. Transfer data from administrateurs to users for 2FA
        $admins = DB::table('administrateurs')->get();
        foreach ($admins as $admin) {
            DB::table('users')
                ->where('profile_type', 'App\Models\Administrateur')
                ->where('profile_id', $admin->id_administrateur)
                ->update([
                    'two_factor_secret' => $admin->two_factor_secret ?? null,
                    'two_factor_recovery_codes' => $admin->two_factor_recovery_codes ?? null,
                    'two_factor_enabled' => $admin->two_factor_enabled ?? false,
                ]);
        }

        // 3. Drop redundant columns from administrateurs
        Schema::table('administrateurs', function (Blueprint $table) {
            $cols = ['nom', 'prenom', 'email', 'two_factor_secret', 'two_factor_enabled', 'two_factor_recovery_codes'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('administrateurs', $col)) {
                    $table->dropColumn($col);
                }
            }
        });

        // 4. Drop redundant columns from enseignants
        Schema::table('enseignants', function (Blueprint $table) {
            $cols = ['nom', 'prenom', 'email', 'telephone'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('enseignants', $col)) {
                    $table->dropColumn($col);
                }
            }
        });

        // 5. Drop redundant columns from etudiants
        Schema::table('etudiants', function (Blueprint $table) {
            $cols = ['nom', 'prenom', 'email', 'telephone'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('etudiants', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['two_factor_secret', 'two_factor_recovery_codes', 'two_factor_enabled']);
        });
    }
};
