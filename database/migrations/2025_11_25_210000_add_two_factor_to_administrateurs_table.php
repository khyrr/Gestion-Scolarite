<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('administrateurs')) {
            Schema::table('administrateurs', function (Blueprint $table) {
                if (!Schema::hasColumn('administrateurs', 'two_factor_secret')) {
                    $table->string('two_factor_secret')->nullable()->after('role');
                }

                if (!Schema::hasColumn('administrateurs', 'two_factor_enabled')) {
                    $table->boolean('two_factor_enabled')->default(false)->after('two_factor_secret');
                }

                if (!Schema::hasColumn('administrateurs', 'two_factor_recovery_codes')) {
                    $table->text('two_factor_recovery_codes')->nullable()->after('two_factor_enabled');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('administrateurs')) {
            Schema::table('administrateurs', function (Blueprint $table) {
                $drop = ['two_factor_secret', 'two_factor_enabled', 'two_factor_recovery_codes'];
                foreach ($drop as $col) {
                    if (Schema::hasColumn('administrateurs', $col)) {
                        $table->dropColumn($col);
                    }
                }
            });
        }
    }
};
