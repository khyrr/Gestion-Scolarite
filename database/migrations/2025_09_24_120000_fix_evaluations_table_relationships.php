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
        // First add new columns
        Schema::table('evaluations', function (Blueprint $table) {
            // Add id_matiere column if it doesn't exist
            if (!Schema::hasColumn('evaluations', 'id_matiere')) {
                $table->unsignedBigInteger('id_matiere')->nullable()->after('id_evaluation');
            }
            
            // Add titre column for evaluation title
            if (!Schema::hasColumn('evaluations', 'titre')) {
                $table->string('titre')->nullable()->after('id_matiere');
            }
            
            // Add note_max column if it doesn't exist
            if (!Schema::hasColumn('evaluations', 'note_max')) {
                $table->decimal('note_max', 4, 2)->default(20.00)->after('type');
            }
        });
        
        // Update existing evaluations to use proper relationships
        $this->updateExistingEvaluations();
        
        // Make id_matiere required and add foreign key
        Schema::table('evaluations', function (Blueprint $table) {
            $table->unsignedBigInteger('id_matiere')->nullable(false)->change();
            $table->foreign('id_matiere')->references('id_matiere')->on('matieres')->onDelete('cascade');
        });
        
        // Remove the old matiere string column after data migration
        Schema::table('evaluations', function (Blueprint $table) {
            if (Schema::hasColumn('evaluations', 'matiere')) {
                $table->dropColumn('matiere');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            // Add back the matiere string column
            $table->string('matiere')->after('id_matiere');
            
            // Drop foreign key and columns
            if (Schema::hasColumn('evaluations', 'id_matiere')) {
                if (Schema::getConnection()->getDriverName() !== 'sqlite') {
                    $table->dropForeign(['id_matiere']);
                }
                $table->dropColumn(['id_matiere', 'titre', 'note_max']);
            }
        });
    }
    
    /**
     * Update existing evaluations to use proper relationships
     */
    private function updateExistingEvaluations(): void
    {
        // Get all evaluations that don't have id_matiere set
        $evaluations = \DB::table('evaluations')->whereNull('id_matiere')->get();
        
        foreach ($evaluations as $evaluation) {
            $matiereId = null;
            $titre = 'Evaluation';
            
            if (!empty($evaluation->matiere)) {
                // Try to find matching matiere by name
                $matiere = \DB::table('matieres')
                    ->where('nom_matiere', 'LIKE', '%' . $evaluation->matiere . '%')
                    ->orWhere('code_matiere', 'LIKE', '%' . $evaluation->matiere . '%')
                    ->first();
                    
                if ($matiere) {
                    $matiereId = $matiere->id_matiere;
                    $titre = ucfirst($evaluation->type) . ' de ' . $matiere->nom_matiere;
                }
            }
            
            // If no matching matiere found, use first available
            if (!$matiereId) {
                $firstMatiere = \DB::table('matieres')->first();
                if ($firstMatiere) {
                    $matiereId = $firstMatiere->id_matiere;
                    $titre = ucfirst($evaluation->type) . ' - ' . ($evaluation->matiere ?? 'Evaluation');
                }
            }
            
            // Update the evaluation if we found a matiere
            if ($matiereId) {
                \DB::table('evaluations')
                    ->where('id_evaluation', $evaluation->id_evaluation)
                    ->update([
                        'id_matiere' => $matiereId,
                        'titre' => $titre
                    ]);
            }
        }
    }
};