<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Evaluation;
use App\Models\Etudiant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $evaluations = Evaluation::with('classe')->get();

        if ($evaluations->isEmpty()) {
            $this->command->warn('No evaluations found. Run EvaluationsSeeder first.');
            return;
        }

        $this->command->info("Creating grades for {$evaluations->count()} evaluations...");

        foreach ($evaluations as $evaluation) {
            // Get all students from the evaluation's class
            $students = Etudiant::where('id_classe', $evaluation->id_classe)->get();

            if ($students->isEmpty()) {
                continue;
            }

            foreach ($students as $student) {
                $note = $this->generateRealisticNote($evaluation->note_max, $evaluation->type);
                
                Note::create([
                    'note' => $note,
                    'id_matiere' => $evaluation->id_matiere,
                    'type' => $evaluation->type,
                    'commentaire' => $this->generateComment($note, $evaluation->note_max, $evaluation->type),
                    'id_etudiant' => $student->id_etudiant,
                    'id_evaluation' => $evaluation->id_evaluation,
                    'id_classe' => $evaluation->id_classe,
                ]);
            }
        }
        
        $notesCount = Note::count();
        $this->command->info("✅ Created {$notesCount} student grades.");
    }

    private function generateRealisticNote(int $noteMax, string $evaluationType): float
    {
        // Different grade distributions based on evaluation type and French grading system
        $distributions = [
            'controle' => [
                'excellent' => 0.12,  // 16-20 (12%)
                'good' => 0.25,       // 14-15 (25%)
                'average' => 0.35,    // 10-13 (35%)
                'below' => 0.28       // 0-9 (28%)
            ],
            'devoir' => [
                'excellent' => 0.10,  // 16-20 (10%)
                'good' => 0.22,       // 14-15 (22%)
                'average' => 0.38,    // 10-13 (38%)
                'below' => 0.30       // 0-9 (30%)
            ],
            'examen' => [
                'excellent' => 0.08,  // 16-20 (8%)
                'good' => 0.18,       // 14-15 (18%)
                'average' => 0.40,    // 10-13 (40%)
                'below' => 0.34       // 0-9 (34%)
            ]
        ];

        $dist = $distributions[$evaluationType] ?? $distributions['controle'];
        $rand = mt_rand() / mt_getrandmax();

        if ($rand < $dist['excellent']) {
            // Excellent: 16-20
            $min = $noteMax * 0.80;
            $max = $noteMax;
        } elseif ($rand < $dist['excellent'] + $dist['good']) {
            // Good: 14-15
            $min = $noteMax * 0.70;
            $max = $noteMax * 0.79;
        } elseif ($rand < $dist['excellent'] + $dist['good'] + $dist['average']) {
            // Average: 10-13 (passing grade)
            $min = $noteMax * 0.50;
            $max = $noteMax * 0.69;
        } else {
            // Below average: 0-9 (failing)
            $min = 0;
            $max = $noteMax * 0.49;
        }

        $note = $min + (mt_rand() / mt_getrandmax()) * ($max - $min);
        
        // Round to 0.25 precision (French system: 12.25, 12.5, 12.75, etc.)
        return round($note * 4) / 4;
    }

    private function generateComment(float $note, int $noteMax, string $type): string
    {
        $percentage = ($note / $noteMax) * 100;
        
        // French academic comments based on performance
        if ($percentage >= 80) {
            $comments = [
                'Excellent travail, à continuer ainsi !',
                'Très bonne maîtrise des notions.',
                'Performance remarquable.',
                'Très bien, félicitations !',
                'Excellente compréhension du sujet.'
            ];
        } elseif ($percentage >= 70) {
            $comments = [
                'Bon travail, quelques points à améliorer.',
                'Bonne performance générale.',
                'Bien, continuez vos efforts.',
                'Bonnes connaissances, à approfondir.',
                'Satisfaisant, peut mieux faire.'
            ];
        } elseif ($percentage >= 50) {
            $comments = [
                'Travail moyen, des efforts à fournir.',
                'Assez bien, amélioration nécessaire.',
                'Acquis fragiles, revoir les bases.',
                'Peut mieux faire, travaillez davantage.',
                'Résultats moyens, plus de révision nécessaire.'
            ];
        } else {
            $comments = [
                'Travail insuffisant, revoir les leçons.',
                'Difficultés importantes, aide nécessaire.',
                'Notions non acquises, rattrapage indispensable.',
                'Résultats préoccupants, soutien requis.',
                'Travail à reprendre entièrement.'
            ];
        }
        
        $baseComment = $comments[array_rand($comments)];
        
        // Add specific comments for evaluation type
        if ($type === 'examen') {
            $baseComment .= ' (Examen final)';
        } elseif ($type === 'devoir' && $percentage < 50) {
            $baseComment .= ' Préparez-vous mieux pour le prochain devoir.';
        }
        
        return $baseComment;
    }
}
