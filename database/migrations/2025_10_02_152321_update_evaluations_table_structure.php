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
            // Drop old matiere string column if exists
            if (Schema::hasColumn('evaluations', 'matiere')) {
                $table->dropColumn('matiere');
            }
            
            // Add id_matiere if not exists
            if (!Schema::hasColumn('evaluations', 'id_matiere')) {
                $table->unsignedBigInteger('id_matiere')->nullable()->after('id_evaluation');
                $table->foreign('id_matiere')->references('id_matiere')->on('matieres')->onDelete('cascade');
            }
            
            // Add titre column if not exists
            if (!Schema::hasColumn('evaluations', 'titre')) {
                $table->string('titre')->nullable()->after('id_matiere');
            }
            
            // Change date_debut and date_fin from date to time
            $table->time('date_debut')->nullable()->change();
            $table->time('date_fin')->nullable()->change();
            
            // Make date not nullable
            $table->date('date')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            // Reverse the changes
            if (Schema::hasColumn('evaluations', 'id_matiere')) {
                if (Schema::getConnection()->getDriverName() !== 'sqlite') {
                    $table->dropForeign(['id_matiere']);
                }
                $table->dropColumn('id_matiere');
            }
            
            if (Schema::hasColumn('evaluations', 'titre')) {
                $table->dropColumn('titre');
            }
            
            // Add back matiere string column
            if (!Schema::hasColumn('evaluations', 'matiere')) {
                $table->string('matiere')->after('id_evaluation');
            }
            
            // Change back to date
            $table->date('date_debut')->change();
            $table->date('date_fin')->change();
        });
    }
};
