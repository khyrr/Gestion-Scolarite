<?php

namespace App\Services;

use App\Models\Enseignant;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\Evaluation;
use App\Models\Note;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EnseignantService
{
    /**
     * Get the current authenticated teacher
     */
    public function getCurrentTeacher()
    {
        $user = Auth::user();
        return Enseignant::where('email', $user->email)->first();
    }

    /**
     * Get all class IDs assigned to a teacher
     */
    public function getTeacherClassIds($teacher)
    {
        return DB::table('enseignant_matiere_classe')
            ->where('id_enseignant', $teacher->id_enseignant)
            ->where('enseignant_matiere_classe.active', true)
            ->pluck('id_classe')
            ->unique();
    }

    /**
     * Get teacher's classes (including backward compatibility)
     */
    public function getTeacherClasses($teacher)
    {
        $teacherClassIds = $this->getTeacherClassIds($teacher);
        $classes = collect();

        if ($teacherClassIds->isNotEmpty()) {
            $classes = Classe::whereIn('id_classe', $teacherClassIds)->get();
        }

        // Backward compatibility
        if (isset($teacher->id_classe) && $teacher->id_classe) {
            $directClass = Classe::find($teacher->id_classe);
            if ($directClass && !$classes->contains('id_classe', $directClass->id_classe)) {
                $classes->push($directClass);
            }
        }

        return $classes;
    }

    /**
     * Get teacher's students (including backward compatibility)
     */
    public function getTeacherStudents($teacher)
    {
        $teacherClassIds = $this->getTeacherClassIds($teacher);
        $students = collect();

        if ($teacherClassIds->isNotEmpty()) {
            $students = Etudiant::whereIn('id_classe', $teacherClassIds)->get();
        }

        // Backward compatibility
        if (isset($teacher->id_classe) && $teacher->id_classe) {
            $directStudents = Etudiant::where('id_classe', $teacher->id_classe)->get();
            // Merge avoiding duplicates if any
            $existingIds = $students->pluck('id_etudiant')->toArray();
            $newStudents = $directStudents->filter(function ($student) use ($existingIds) {
                return !in_array($student->id_etudiant, $existingIds);
            });
            $students = $students->merge($newStudents);
        }

        return $students;
    }

    /**
     * Get teacher's course assignments
     */
    public function getTeacherCourses($teacher)
    {
        return DB::table('enseignant_matiere_classe')
            ->where('id_enseignant', $teacher->id_enseignant)
            ->where('enseignant_matiere_classe.active', true)
            ->join('matieres', 'enseignant_matiere_classe.id_matiere', '=', 'matieres.id_matiere')
            ->join('classes', 'enseignant_matiere_classe.id_classe', '=', 'classes.id_classe')
            ->select(
                'matieres.nom_matiere as matiere',
                'matieres.nom_matiere', // For compatibility
                'matieres.code_matiere',
                'matieres.id_matiere',
                'classes.nom_classe',
                'classes.id_classe',
                'enseignant_matiere_classe.id_matiere',
                'enseignant_matiere_classe.id_classe as class_id',
                'enseignant_matiere_classe.created_at as date_assignation'
            )
            ->get();
    }

    /**
     * Get recent evaluations for teacher's classes
     */
    public function getRecentEvaluations($teacher, $limit = 5)
    {
        $teacherClassIds = $this->getTeacherClassIds($teacher);

        if ($teacherClassIds->isEmpty()) {
            return collect();
        }

        $teacherMatiereIds = DB::table('enseignant_matiere_classe')
            ->where('id_enseignant', $teacher->id_enseignant)
            ->where('enseignant_matiere_classe.active', true)
            ->pluck('id_matiere');

        return Evaluation::whereIn('id_classe', $teacherClassIds)
            ->when($teacherMatiereIds->isNotEmpty(), function ($query) use ($teacherMatiereIds) {
                return $query->whereIn('id_matiere', $teacherMatiereIds);
            })
            ->with(['matiere', 'classe'])
            ->orderBy('date', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get dashboard statistics
     */
    public function getDashboardStats($teacher)
    {
        $classes = $this->getTeacherClasses($teacher);
        $students = $this->getTeacherStudents($teacher);
        $courses = $this->getTeacherCourses($teacher);
        $recentEvaluations = $this->getRecentEvaluations($teacher);

        return [
            'students_count' => $students->count(),
            'courses_count' => $courses->count(),
            'evaluations_count' => $recentEvaluations->count(),
            'classes_count' => $classes->count(),
            'classe_names' => $classes->pluck('nom_classe')->implode(', ') ?: 'Aucune classe assignée',
            'classe_name' => $classes->pluck('nom_classe')->implode(', ') ?: 'Aucune classe assignée',
            'matieres' => $courses->pluck('matiere')->unique()->implode(', ') ?: $teacher->matiere
        ];
    }

    /**
     * Organize courses into a timetable structure
     */
    public function getOrganizedTimetable($courses)
    {
        // Create course objects with the new structure (simulating old cours table structure)
        $formattedCourses = collect();
        foreach ($courses as $assignment) {
            $course = (object) [
                'matiere' => $assignment->nom_matiere,
                'code_matiere' => $assignment->code_matiere,
                'id_matiere' => $assignment->id_matiere,
                'classe' => (object) [
                    'nom_classe' => $assignment->nom_classe,
                    'id_classe' => $assignment->id_classe
                ],
                // Add default time slots (can be customized later)
                'jour' => 'Lundi', // Default day
                'date_debut' => '08:00:00',
                'date_fin' => '09:00:00'
            ];
            $formattedCourses->push($course);
        }

        $organizedCourses = [];
        $timeSlots = [
            ['time' => '08:00-09:00', 'period' => 'morning'],
            ['time' => '09:00-10:00', 'period' => 'morning'],
            ['time' => '10:00-10:30', 'period' => 'pause'],
            ['time' => '10:30-11:30', 'period' => 'morning'],
            ['time' => '11:30-12:30', 'period' => 'morning'],
            ['time' => '12:30-14:00', 'period' => 'pause'],
            ['time' => '14:00-15:00', 'period' => 'afternoon'],
            ['time' => '15:00-16:00', 'period' => 'afternoon'],
            ['time' => '16:00-16:30', 'period' => 'pause'],
            ['time' => '16:30-17:30', 'period' => 'afternoon'],
        ];

        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];

        // Initialize the organized courses array
        foreach ($days as $day) {
            foreach ($timeSlots as $slot) {
                $organizedCourses[$day][$slot['time']] = null;
            }
        }

        // Place courses in their correct time slots
        foreach ($formattedCourses as $course) {
            $day = ucfirst(strtolower($course->jour));
            $startTime = date('H:i', strtotime($course->date_debut));
            $endTime = date('H:i', strtotime($course->date_fin));
            $timeSlot = $startTime . '-' . $endTime;

            // Find matching time slot (or closest one)
            foreach ($timeSlots as $slot) {
                if (
                    $slot['time'] === $timeSlot ||
                    (strpos($slot['time'], $startTime) !== false)
                ) {
                    $organizedCourses[$day][$slot['time']] = $course;
                    break;
                }
            }
        }

        return [
            'formatted_courses' => $formattedCourses,
            'organized_courses' => $organizedCourses,
            'time_slots' => $timeSlots,
            'days' => $days
        ];
    }

    /**
     * Get evaluations available for grading
     */
    public function getGradableEvaluations($teacher, $classId = null)
    {
        $teacherClassIds = $this->getTeacherClassIds($teacher);

        if ($teacherClassIds->isEmpty()) {
            return collect();
        }

        // If a specific class is requested, ensure teacher has access to it
        if ($classId && !$teacherClassIds->contains($classId)) {
            // Check backward compatibility
            if (!($teacher->id_classe == $classId)) {
                return collect();
            }
        }

        // Use requested class or all teacher classes
        $targetClassIds = $classId ? [$classId] : $teacherClassIds;

        $teacherMatiereIds = DB::table('enseignant_matiere_classe')
            ->where('id_enseignant', $teacher->id_enseignant)
            ->where('enseignant_matiere_classe.active', true)
            ->pluck('id_matiere');

        return Evaluation::whereIn('id_classe', $targetClassIds)
            ->when($teacherMatiereIds->isNotEmpty(), function ($query) use ($teacherMatiereIds) {
                return $query->whereIn('id_matiere', $teacherMatiereIds);
            })
            ->where(function ($query) {
                // Include evaluations where the evaluation has ended
                $query->where(function ($subQuery) {
                    $subQuery->whereNotNull('date_fin')
                        ->where('date_fin', '<', now()->startOfDay());
                })
                    ->orWhere(function ($subQuery) {
                    $subQuery->whereNull('date_fin')
                        ->whereNotNull('date')
                        ->where('date', '<', now()->startOfDay());
                })
                    ->orWhere(function ($subQuery) {
                    $subQuery->whereNull('date_fin')
                        ->whereNull('date')
                        ->where('created_at', '<', now()->subDays(1));
                });
            })
            ->with(['matiere', 'classe'])
            ->orderBy('date', 'desc')
            ->get();
    }

    /**
     * Get existing notes for a class and teacher's subjects
     */
    public function getExistingNotes($teacher, $classId)
    {
        $teacherMatiereIds = DB::table('enseignant_matiere_classe')
            ->where('id_enseignant', $teacher->id_enseignant)
            ->where('id_classe', $classId)
            ->where('enseignant_matiere_classe.active', true)
            ->pluck('id_matiere');

        return Note::whereHas('evaluation', function ($query) use ($classId, $teacherMatiereIds) {
            $query->where('id_classe', $classId);
            if ($teacherMatiereIds->isNotEmpty()) {
                $query->whereIn('id_matiere', $teacherMatiereIds);
            }
        })
            ->with(['etudiant', 'evaluation.matiere'])
            ->get()
            ->groupBy('id_etudiant');
    }

    /**
     * Get profile statistics
     */
    public function getProfileStats($teacher)
    {
        $teacherClassIds = $this->getTeacherClassIds($teacher);
        $teacherAssignments = $this->getTeacherCourses($teacher);

        return [
            'total_students' => Etudiant::whereIn('id_classe', $teacherClassIds)->count(),
            'total_classes' => $teacherClassIds->count(),
            'total_matieres' => $teacherAssignments->pluck('code_matiere')->unique()->count(),
            'total_evaluations' => Evaluation::whereIn('id_classe', $teacherClassIds)->count(),
            'recent_notes' => Note::whereHas('etudiant', function ($q) use ($teacherClassIds) {
                $q->whereIn('id_classe', $teacherClassIds);
            })->where('created_at', '>', now()->subDays(7))->count()
        ];
    }

    /**
     * Create a new teacher
     */
    public function createTeacher(array $data)
    {
        return Enseignant::create($data);
    }

    /**
     * Update a teacher and their assignments
     */
    public function updateTeacher(Enseignant $enseignant, array $data, $selectedClasses = null, $matiereId = null)
    {
        $enseignant->update([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'date_recrutement' => $data['date_recrutement'],
        ]);

        // Update relationships if provided
        if ($selectedClasses !== null) {
            // Remove old relationships
            $enseignant->matiereClasses()->detach();

            // Add new relationships
            if (is_array($selectedClasses)) {
                foreach ($selectedClasses as $classeId) {
                    if ($matiereId) {
                        $enseignant->matiereClasses()->attach($classeId, ['matiere' => $matiereId]);
                    }
                }
            }
        }

        return $enseignant;
    }
}
