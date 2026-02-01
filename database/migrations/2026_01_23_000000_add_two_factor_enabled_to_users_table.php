<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add boolean for UI / toggles compatibility
            $table->boolean('two_factor_enabled')->default(false)->after('two_factor_secret');
        });

        // Backfill: if user has a confirmed timestamp, mark boolean true
        DB::table('users')
            ->whereNotNull('two_factor_confirmed_at')
            ->update(['two_factor_enabled' => true]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('two_factor_enabled');
        });
    }
};
