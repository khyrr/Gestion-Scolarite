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
        // First truncate the cours table to avoid foreign key issues
        \DB::table('cours')->truncate();
        
        Schema::table('cours', function (Blueprint $table) {
            // Add new columns for matiere system
            $table->unsignedBigInteger('id_matiere')->after('id_cours');
            
            // Add foreign key constraints
            $table->foreign('id_matiere')->references('id_matiere')->on('matieres')->onDelete('cascade');
            
            // Remove old matiere string column only (keep id_enseignant) if present
            if (Schema::hasColumn('cours', 'matiere')) {
                $table->dropColumn('matiere');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cours', function (Blueprint $table) {
            // Drop foreign key and column if they exist (skip dropForeign on sqlite)
            if (Schema::hasColumn('cours', 'id_matiere')) {
                if (Schema::getConnection()->getDriverName() !== 'sqlite') {
                    $table->dropForeign(['id_matiere']);
                }
                $table->dropColumn('id_matiere');
            }
            
            // Add back old matiere string column
            $table->string('matiere');
        });
    }
};
