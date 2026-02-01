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
        Schema::create('enseignant_matiere_classe', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_enseignant'); // Direct reference to enseignants table
            $table->unsignedBigInteger('id_matiere');
            $table->unsignedBigInteger('id_classe');
            $table->boolean('active')->default(true);
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('id_enseignant')->references('id_enseignant')->on('enseignants')->onDelete('cascade');
            $table->foreign('id_matiere')->references('id_matiere')->on('matieres')->onDelete('cascade');
            $table->foreign('id_classe')->references('id_classe')->on('classes')->onDelete('cascade');
            
            // Ensure unique combination
            $table->unique(['id_enseignant', 'id_matiere', 'id_classe'], 'unique_enseignant_matiere_classe');
            
            // Indexes for better performance
            $table->index('id_enseignant');
            $table->index('id_matiere');
            $table->index('id_classe');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseignant_matiere_classe');
    }
};
