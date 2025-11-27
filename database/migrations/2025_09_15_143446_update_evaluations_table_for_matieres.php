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
        Schema::table('evaluations', function (Blueprint $table) {
            // Check if column doesn't exist already
            if (!Schema::hasColumn('evaluations', 'id_matiere')) {
                $table->unsignedBigInteger('id_matiere')->nullable()->after('id_evaluation');
            }
            
            // Keep the old matiere column for now (we'll remove it later after data migration)
            if (Schema::hasColumn('evaluations', 'matiere')) {
                $table->string('matiere')->nullable()->change();
            }
            
            // Add index if it doesn't exist
            if (!Schema::hasIndex('evaluations', 'evaluations_id_matiere_index')) {
                $table->index('id_matiere');
            }
        });
        
        // We'll add the foreign key constraint later after populating the data
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            if (Schema::hasColumn('evaluations', 'id_matiere')) {
                if (Schema::getConnection()->getDriverName() !== 'sqlite') {
                    $table->dropForeign(['id_matiere']);
                }
                $table->dropColumn('id_matiere');
            }

            if (Schema::hasColumn('evaluations', 'matiere')) {
                $table->string('matiere')->nullable(false)->change();
            }
        });
    }
};
