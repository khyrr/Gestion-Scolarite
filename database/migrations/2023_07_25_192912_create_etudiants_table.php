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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id('id_etudiant');
            $table->string('matricule')->unique(); // Unique student identifier
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->enum('genre', ['M', 'F']);
            $table->string('telephone');
            $table->text('adresse');
            $table->string('email')->nullable();
            $table->unsignedBigInteger('id_classe'); // Clé étrangère pour la table Classe
            $table->timestamps();
            
            $table->foreign('id_classe')->references('id_classe')->on('classes');
            $table->index('id_classe');
            $table->index('nom');
            $table->index('matricule');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
