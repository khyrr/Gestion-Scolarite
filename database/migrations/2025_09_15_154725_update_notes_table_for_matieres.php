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
        // First truncate the notes table to avoid foreign key issues
        \DB::table('notes')->truncate();
        
        Schema::table('notes', function (Blueprint $table) {
            // Add matiere reference - notes will get matiere from evaluation
            $table->unsignedBigInteger('id_matiere')->after('id_note');
            
            // Add foreign key constraint
            $table->foreign('id_matiere')->references('id_matiere')->on('matieres')->onDelete('cascade');
            
            // Remove redundant matiere string column if it exists
            if (Schema::hasColumn('notes', 'matiere')) {
                $table->dropColumn('matiere');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            // Drop foreign key and column if they exist (skip dropForeign on sqlite)
            if (Schema::hasColumn('notes', 'id_matiere')) {
                if (Schema::getConnection()->getDriverName() !== 'sqlite') {
                    $table->dropForeign(['id_matiere']);
                }
                $table->dropColumn('id_matiere');
            }
            
            // Add back old column
            $table->string('matiere');
        });
    }
};
