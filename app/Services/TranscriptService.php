<?php

namespace App\Services;

use App\Models\Etudiant;
use App\Models\Note;
use Carbon\Carbon;

class TranscriptService
{
    /**
     * Calculate statistics for a transcript based on grouped notes
     */
    public function calculateTranscriptStatistics($notesByMatiere)
    {
        $averages = [];
        $totalNotes = 0;
        $passedNotes = 0;
        $excellentNotes = 0;
        $totalCoeff = 0;
        $weightedSum = 0;

        // Get passing grade from settings (as percentage)
        $passingGradePercentage = setting('academic.passing_grade', 50); // Default 50%
        $passingGradeOn20 = ($passingGradePercentage / 100) * 20;

        foreach ($notesByMatiere as $matiere => $matiereNotes) {
            $matiereStats = [
                'total_points' => 0,
                'total_max_points' => 0,
                'note_count' => $matiereNotes->count(),
                'coefficient' => 1 // Default coefficient, can be enhanced
            ];

            foreach ($matiereNotes as $note) {
                $noteMax = $note->evaluation?->note_max ?? 20;
                $noteSur20 = ($note->note / $noteMax) * 20;

                $matiereStats['total_points'] += $note->note;
                $matiereStats['total_max_points'] += $noteMax;

                $totalNotes++;
                if ($noteSur20 >= $passingGradeOn20)
                    $passedNotes++;
                if ($noteSur20 >= 16)
                    $excellentNotes++;
            }

            // Calculate matiere average
            $matiereAverage = $matiereStats['total_max_points'] > 0
                ? ($matiereStats['total_points'] / $matiereStats['total_max_points']) * 20
                : 0;

            $averages[$matiere] = [
                'average' => $matiereAverage,
                'coefficient' => $matiereStats['coefficient'],
                'note_count' => $matiereStats['note_count'],
                'grade_letter' => $this->getGradeLetter($matiereAverage)
            ];

            // Weighted average calculation
            $weightedSum += $matiereAverage * $matiereStats['coefficient'];
            $totalCoeff += $matiereStats['coefficient'];
        }

        $overallAverage = $totalCoeff > 0 ? $weightedSum / $totalCoeff : 0;

        return [
            'averages' => $averages,
            'overall_average' => $overallAverage,
            'total_notes' => $totalNotes,
            'passed_notes' => $passedNotes,
            'excellent_notes' => $excellentNotes,
            'success_rate' => $totalNotes > 0 ? ($passedNotes / $totalNotes) * 100 : 0,
            'excellence_rate' => $totalNotes > 0 ? ($excellentNotes / $totalNotes) * 100 : 0,
            'overall_grade' => $this->getGradeLetter($overallAverage),
            'mention' => $this->getMention($overallAverage)
        ];
    }

    public function getGradeLetter($average)
    {
        $gradingSystem = setting('academic.grading_system', 'percentage');
        
        if ($gradingSystem === 'letter') {
            if ($average >= 18) return 'A+';
            if ($average >= 16) return 'A';
            if ($average >= 14) return 'B+';
            if ($average >= 12) return 'B';
            if ($average >= setting('academic.passing_grade', 50) / 100 * 20) return 'C';
            if ($average >= 8) return 'D';
            return 'F';
        }
        
        if ($gradingSystem === 'gpa') {
            if ($average >= 18) return '4.0';
            if ($average >= 16) return '3.5';
            if ($average >= 14) return '3.0';
            if ($average >= 12) return '2.5';
            if ($average >= setting('academic.passing_grade', 50) / 100 * 20) return '2.0';
            if ($average >= 8) return '1.0';
            return '0.0';
        }
        
        // Default: percentage
        return round($average, 1) . '/20';
    }

    public function getMention($average)
    {
        $passingGrade = setting('academic.passing_grade', 50) / 100 * 20; // Convert % to /20
        
        if ($average >= 16)
            return 'Très Bien';
        if ($average >= 14)
            return 'Bien';
        if ($average >= 12)
            return 'Assez Bien';
        if ($average >= $passingGrade)
            return 'Passable';
        return 'Insuffisant';
    }

    public function getTrimestreInfo($trimestre)
    {
        $trimestreNames = [
            '1' => '1er Trimestre',
            '2' => '2ème Trimestre',
            '3' => '3ème Trimestre'
        ];

        $dateRange = $this->getTrimestreDateRange($trimestre);

        return [
            'number' => $trimestre,
            'name' => $trimestreNames[$trimestre] ?? 'Trimestre inconnu',
            'start_date' => $dateRange['start'],
            'end_date' => $dateRange['end'],
            'formatted_period' => date('d/m/Y', strtotime($dateRange['start'])) . ' - ' . date('d/m/Y', strtotime($dateRange['end']))
        ];
    }

    public function getTrimestreDateRange($trimestre, $etudiant = null)
    {
        // Get academic year start month from config (default: October = 10)  
        $academicStartMonth = config('school.academic_year_start_month', 10);

        // Get trimestre configuration from config
        $trimestreConfig = config('school.trimestres', [
            '1' => ['start_month' => 10, 'start_day' => 1, 'end_month' => 12, 'end_day' => 31],
            '2' => ['start_month' => 1, 'start_day' => 1, 'end_month' => 4, 'end_day' => 30],
            '3' => ['start_month' => 5, 'start_day' => 1, 'end_month' => 7, 'end_day' => 31]
        ]);

        if (!isset($trimestreConfig[$trimestre])) {
            return [
                'start' => '2024-01-01',
                'end' => '2025-12-31'
            ];
        }

        $config = $trimestreConfig[$trimestre];

        // Detect academic year based on student's evaluation dates if available
        if ($etudiant) {
            $studentEvaluations = Note::with('evaluation')
                ->where('id_etudiant', $etudiant->id_etudiant)
                ->get()
                ->pluck('evaluation.date')
                ->filter()
                ->sort();

            if ($studentEvaluations->isNotEmpty()) {
                // Find the most common academic year from student's evaluations
                $academicYears = [];
                foreach ($studentEvaluations as $date) {
                    $year = (int) $date->format('Y');
                    $month = (int) $date->format('n');

                    // Determine which academic year this evaluation belongs to
                    if ($month >= $academicStartMonth) {
                        $academicYears[] = $year;
                    } else {
                        $academicYears[] = $year - 1;
                    }
                }

                // Use the most recent academic year with evaluations
                $academicYear = max($academicYears);
            } else {
                // Fallback if no evaluations
                $academicYear = $this->getCurrentAcademicYearNumber();
            }
        } else {
            // Fallback to current academic year calculation
            $academicYear = $this->getCurrentAcademicYearNumber();
        }

        // Calculate start and end years for the trimester
        if ($config['start_month'] >= $academicStartMonth) {
            $startYear = $academicYear;
        } else {
            $startYear = $academicYear + 1;
        }

        if ($config['end_month'] >= $academicStartMonth) {
            $endYear = $academicYear;
        } else {
            $endYear = $academicYear + 1;
        }

        return [
            'start' => sprintf("%04d-%02d-%02d", $startYear, $config['start_month'], $config['start_day']),
            'end' => sprintf("%04d-%02d-%02d", $endYear, $config['end_month'], $config['end_day'])
        ];
    }

    public function getCurrentAcademicYear()
    {
        $currentYear = date('Y');
        $currentMonth = date('n');

        // Get academic year start month from config (default: October = 10)
        $academicStartMonth = config('school.academic_year_start_month', 10);

        if ($currentMonth >= $academicStartMonth) {
            return $currentYear . '/' . ($currentYear + 1);
        } else {
            return ($currentYear - 1) . '/' . $currentYear;
        }
    }

    public function getCurrentAcademicYearNumber()
    {
        $currentYear = (int) date('Y');
        $currentMonth = (int) date('n');

        // Get academic year start month from config (default: October = 10)
        $academicStartMonth = config('school.academic_year_start_month', 10);

        if ($currentMonth >= $academicStartMonth) {
            return $currentYear;
        } else {
            return $currentYear - 1;
        }
    }

    public function getAvailableAcademicYearsForStudent($etudiant)
    {
        // Get all evaluation dates for this student
        $evaluationDates = Note::with('evaluation')
            ->where('id_etudiant', $etudiant->id_etudiant)
            ->get()
            ->pluck('evaluation.date')
            ->filter()
            ->map(function ($date) {
                return Carbon::parse($date);
            });

        $academicStartMonth = config('school.academic_year_start_month', 10);
        $years = collect();

        // Always include current academic year
        $years->push($this->getCurrentAcademicYear());

        // Add years based on evaluation dates
        foreach ($evaluationDates as $date) {
            $year = $date->year;
            $month = $date->month;

            if ($month >= $academicStartMonth) {
                $academicYear = $year . '/' . ($year + 1);
            } else {
                $academicYear = ($year - 1) . '/' . $year;
            }

            $years->push($academicYear);
        }

        return $years->unique()->sort()->values();
    }

    public function getAcademicYearDateRange($academicYear)
    {
        // Parse academic year (e.g., "2024/2025")
        $years = explode('/', $academicYear);
        $startYear = (int) $years[0];
        $endYear = (int) $years[1];

        $academicStartMonth = config('school.academic_year_start_month', 10);

        return [
            'start' => sprintf("%04d-%02d-01", $startYear, $academicStartMonth),
            'end' => sprintf("%04d-%02d-30", $endYear, $academicStartMonth - 1 ?: 9)
        ];
    }

    public function getTrimestreDateRangeForYear($trimestre, $academicYear)
    {
        // Parse academic year
        $years = explode('/', $academicYear);
        $startYear = (int) $years[0];

        // Get trimestre configuration from config
        $trimestreConfig = config('school.trimestres', [
            '1' => ['start_month' => 10, 'start_day' => 1, 'end_month' => 12, 'end_day' => 31],
            '2' => ['start_month' => 1, 'start_day' => 1, 'end_month' => 4, 'end_day' => 30],
            '3' => ['start_month' => 5, 'start_day' => 1, 'end_month' => 9, 'end_day' => 30]
        ]);

        if (!isset($trimestreConfig[$trimestre])) {
            return [
                'start' => $startYear . '-01-01',
                'end' => ($startYear + 1) . '-12-31'
            ];
        }

        $config = $trimestreConfig[$trimestre];
        $academicStartMonth = config('school.academic_year_start_month', 10);

        // Calculate start and end years for the trimester
        if ($config['start_month'] >= $academicStartMonth) {
            $startYearForTrimestre = $startYear;
        } else {
            $startYearForTrimestre = $startYear + 1;
        }

        if ($config['end_month'] >= $academicStartMonth) {
            $endYearForTrimestre = $startYear;
        } else {
            $endYearForTrimestre = $startYear + 1;
        }

        return [
            'start' => sprintf("%04d-%02d-%02d", $startYearForTrimestre, $config['start_month'], $config['start_day']),
            'end' => sprintf("%04d-%02d-%02d", $endYearForTrimestre, $config['end_month'], $config['end_day'])
        ];
    }
}
