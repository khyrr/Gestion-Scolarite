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
        Schema::table('enseignpaiements', function (Blueprint $table) {
            $table->boolean('notified')->default(false)->after('date_paiement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enseignpaiements', function (Blueprint $table) {
            $table->dropColumn('notified');
        });
    }
};
