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
        // First, clean up duplicate notes by keeping only the latest one for each student-evaluation combination
        $duplicates = \Illuminate\Support\Facades\DB::table('notes')
            ->select('id_etudiant', 'id_evaluation', \Illuminate\Support\Facades\DB::raw('COUNT(*) as count'))
            ->groupBy('id_etudiant', 'id_evaluation')
            ->having('count', '>', 1)
            ->get();

        foreach ($duplicates as $duplicate) {
            // Get all notes for this student-evaluation combination, ordered by id_note (latest first)
            $notes = \Illuminate\Support\Facades\DB::table('notes')
                ->where('id_etudiant', $duplicate->id_etudiant)
                ->where('id_evaluation', $duplicate->id_evaluation)
                ->orderBy('id_note', 'desc')
                ->get();

            // Keep the first (latest) note, delete the rest
            $keepNote = $notes->first();
            $notesToDelete = $notes->skip(1);

            foreach ($notesToDelete as $noteToDelete) {
                \Illuminate\Support\Facades\DB::table('notes')
                    ->where('id_note', $noteToDelete->id_note)
                    ->delete();
            }
        }

        // Now add the unique constraint
        Schema::table('notes', function (Blueprint $table) {
            $table->unique(['id_etudiant', 'id_evaluation'], 'unique_student_evaluation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            try {
                $sm = Schema::getConnection()->getDoctrineSchemaManager();
                $details = $sm->listTableDetails('notes');
                if ($details->hasIndex('unique_student_evaluation')) {
                    $table->dropUnique('unique_student_evaluation');
                }
            } catch (\Exception $e) {
                // Ignore if index doesn't exist (best-effort rollback)
            }
        });
    }
};
