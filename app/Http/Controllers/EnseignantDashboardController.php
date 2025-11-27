<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EnseignantService;
use Illuminate\Support\Facades\Auth;

class EnseignantDashboardController extends Controller
{
    protected $enseignantService;

    public function __construct(EnseignantService $enseignantService)
    {
        $this->middleware(['auth', 'role:enseignant']);
        $this->enseignantService = $enseignantService;
    }

    /**
     * Show the teacher dashboard
     */
    public function index()
    {
        $teacher = $this->enseignantService->getCurrentTeacher();

        if (!$teacher) {
            return redirect()->back()->with('error', 'Profil enseignant non trouvé');
        }

        $classes = $this->enseignantService->getTeacherClasses($teacher);
        $students = $this->enseignantService->getTeacherStudents($teacher);
        $courses = $this->enseignantService->getTeacherCourses($teacher);
        $recentEvaluations = $this->enseignantService->getRecentEvaluations($teacher);
        $stats = $this->enseignantService->getDashboardStats($teacher);

        return view('enseignant.dashboard', compact(
            'teacher',
            'classes',
            'students',
            'courses',
            'recentEvaluations',
            'stats'
        ));
    }

    /**
     * Show teacher's students
     */
    public function mesEtudiants()
    {
        $teacher = $this->enseignantService->getCurrentTeacher();

        if (!$teacher) {
            return redirect()->back()->with('error', 'Profil enseignant non trouvé');
        }

        $classes = $this->enseignantService->getTeacherClasses($teacher);
        $students = $this->enseignantService->getTeacherStudents($teacher);

        return view('enseignant.etudiants.index', compact('students', 'classes', 'teacher'));
    }

    /**
     * Show teacher's courses
     */
    public function mesCours()
    {
        $teacher = $this->enseignantService->getCurrentTeacher();

        if (!$teacher) {
            return redirect()->back()->with('error', 'Profil enseignant non trouvé');
        }

        $rawCourses = $this->enseignantService->getTeacherCourses($teacher);
        $timetableData = $this->enseignantService->getOrganizedTimetable($rawCourses);

        $courses = $timetableData['formatted_courses'];
        $organizedCourses = $timetableData['organized_courses'];
        $timeSlots = $timetableData['time_slots'];
        $days = $timetableData['days'];

        return view('enseignant.cours.index', compact('courses', 'teacher', 'organizedCourses', 'timeSlots', 'days'));
    }

    /**
     * Show form to enter grades
     */
    public function saisirNotes(Request $request)
    {
        $teacher = $this->enseignantService->getCurrentTeacher();

        if (!$teacher) {
            return redirect()->back()->with('error', 'Profil enseignant non trouvé');
        }

        $teacherClasses = $this->enseignantService->getTeacherClasses($teacher);

        // Get selected class from request or default to first class
        $selectedClassId = $request->get('classe_id');
        $selectedClass = null;
        $students = collect();
        $evaluations = collect();
        $existingNotes = collect();

        if ($selectedClassId && $teacherClasses->count() > 0) {
            $selectedClass = $teacherClasses->firstWhere('id_classe', $selectedClassId);
        } else if ($teacherClasses->count() > 0) {
            $selectedClass = $teacherClasses->first();
        }

        if ($selectedClass) {
            $students = $selectedClass->etudiants ?? collect();
            $evaluations = $this->enseignantService->getGradableEvaluations($teacher, $selectedClass->id_classe);
            $existingNotes = $this->enseignantService->getExistingNotes($teacher, $selectedClass->id_classe);
        }

        return view('enseignant.notes.create', compact('students', 'evaluations', 'teacher', 'teacherClasses', 'selectedClass', 'existingNotes'));
    }

    /**
     * Show teacher profile
     */
    public function profil()
    {
        $user = Auth::user();
        $teacher = $this->enseignantService->getCurrentTeacher();

        if (!$teacher) {
            return redirect()->back()->with('error', 'Profil enseignant non trouvé');
        }

        $teacherAssignments = $this->enseignantService->getTeacherCourses($teacher);
        $stats = $this->enseignantService->getProfileStats($teacher);

        return view('enseignant.profile.edit', compact('teacher', 'user', 'teacherAssignments', 'stats'));
    }

    /**
     * Update teacher profile
     */
    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        $teacher = $this->enseignantService->getCurrentTeacher();

        if (!$teacher) {
            return redirect()->back()->with('error', 'Profil enseignant non trouvé');
        }

        // Validate the request
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|unique:enseignants,email,' . $teacher->id_enseignant . ',id_enseignant',
            'password' => 'nullable|min:8|confirmed',
        ], [
            'nom.required' => 'Le nom est obligatoire',
            'prenom.required' => 'Le prénom est obligatoire',
            'telephone.required' => 'Le téléphone est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'Format d\'email invalide',
            'email.unique' => 'Cet email est déjà utilisé',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas',
        ]);

        // Update teacher record
        $teacher->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'email' => $request->email,
        ]);

        // Update user record if email changed
        if ($user->email !== $request->email) {
            $user->update([
                'email' => $request->email,
                'name' => $request->prenom . ' ' . $request->nom,
            ]);
        }

        // Update password if provided
        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        return redirect()->route('enseignant.profil')->with('success', 'Profil mis à jour avec succès');
    }
}
