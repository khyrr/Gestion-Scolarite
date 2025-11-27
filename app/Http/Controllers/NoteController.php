<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\Evaluation;
use App\Models\Matiere;
use App\Services\TranscriptService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NoteController extends Controller
{
    protected $transcriptService;

    public function __construct(TranscriptService $transcriptService)
    {
        // Apply auth middleware to all methods except public transcript access
        $this->middleware('auth')->except(['publicTranscript', 'publicTranscriptSearch']);
        $this->transcriptService = $transcriptService;
    }

    /**
     * Display a listing of notes with filters
     */
    public function index(Request $request)
    {
        $query = Note::with(['etudiant', 'classe', 'evaluation.matiere', 'matiere']);

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('etudiant', function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                    ->orWhere('prenom', 'like', "%{$search}%");
            });
        }

        if ($request->filled('classe_filter')) {
            $query->whereHas('classe', function ($q) use ($request) {
                $q->where('nom_classe', $request->classe_filter);
            });
        }

        if ($request->filled('evaluation_filter')) {
            $query->where('id_evaluation', $request->evaluation_filter);
        }

        if ($request->filled('matiere_filter')) {
            $query->whereHas('matiere', function ($q) use ($request) {
                $q->where('nom_matiere', $request->matiere_filter);
            });
        }

        // Calculate statistics on ALL filtered results before pagination
        $allNotes = $query->get();
        $totalNotes = $allNotes->count();
        $excellentCount = 0;
        $goodCount = 0;
        $averageCount = 0;
        $poorCount = 0;
        $averageGrade = 0;

        foreach ($allNotes as $note) {
            $noteMax = $note->evaluation->note_max ?? 20;
            $percentage = ($note->note / $noteMax) * 100;
            $averageGrade += $percentage;

            if ($percentage >= 80)
                $excellentCount++;
            elseif ($percentage >= 60)
                $goodCount++;
            elseif ($percentage >= 50)
                $averageCount++;
            else
                $poorCount++;
        }

        $averageGrade = $totalNotes > 0 ? round($averageGrade / $totalNotes, 1) : 0;

        // Now paginate the results
        $notes = $query->orderBy('created_at', 'desc')->paginate(20);

        // Get filter options
        $classes = Classe::orderBy('nom_classe')->get();
        $evaluations = Evaluation::with('matiere')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($eval) {
                $eval->matiere_name = $eval->matiere->nom_matiere ?? 'N/A';
                return $eval;
            });
        $matieres = Matiere::orderBy('nom_matiere')->get();

        $statistics = [
            'total' => $totalNotes,
            'average' => $averageGrade,
            'excellent' => $excellentCount,
            'good' => $goodCount,
            'average_count' => $averageCount,
            'poor' => $poorCount
        ];

        return view('admin.academic.notes.index', compact('notes', 'classes', 'evaluations', 'matieres', 'statistics'));
    }

    /**
     * Check if the current user can manage notes
     */
    private function canManageNote($studentId = null, $evaluationId = null, $noteId = null)
    {
        $user = auth()->user();

        // Admins can manage all notes
        if ($user->hasRole('admin') || $user->hasRole('administrateur')) {
            return true;
        }

        // Teachers can only manage notes for their students and subjects
        if ($user->hasRole('enseignant')) {
            $enseignant = $user->enseignant;

            if (!$enseignant) {
                return false;
            }

            // If checking specific note
            if ($noteId) {
                $note = Note::find($noteId);
                if (!$note)
                    return false;

                // Check if teacher teaches this subject to this student's class
                return $enseignant->matieres()
                    ->where('id_matiere', $note->id_matiere)
                    ->whereHas('classes', function ($q) use ($note) {
                        $q->where('classes.id_classe', $note->id_classe);
                    })
                    ->exists();
            }

            // If checking evaluation
            if ($evaluationId) {
                $evaluation = Evaluation::find($evaluationId);
                if (!$evaluation)
                    return false;

                return $enseignant->matieres()
                    ->where('id_matiere', $evaluation->id_matiere)
                    ->whereHas('classes', function ($q) use ($evaluation) {
                        $q->where('classes.id_classe', $evaluation->id_classe);
                    })
                    ->exists();
            }
        }

        return false;
    }

    /**
     * Store a newly created note
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_etudiant' => 'required|exists:etudiants,id_etudiant',
            'id_evaluation' => 'required|exists:evaluations,id_evaluation',
            'note' => 'required|numeric|min:0',
            'commentaire' => 'nullable|string'
        ]);

        // Check authorization
        if (!$this->canManageNote($request->id_etudiant, $request->id_evaluation)) {
            return redirect()->back()
                ->with('error', 'Vous n\'êtes pas autorisé à ajouter cette note.');
        }

        // Check if note already exists
        $existingNote = Note::where('id_etudiant', $request->id_etudiant)
            ->where('id_evaluation', $request->id_evaluation)
            ->first();

        if ($existingNote) {
            return redirect()->back()
                ->with('error', 'Une note existe déjà pour cet étudiant et cette évaluation.');
        }

        // Get evaluation to extract related data
        $evaluation = Evaluation::findOrFail($request->id_evaluation);

        // Create note
        Note::create([
            'id_etudiant' => $request->id_etudiant,
            'id_evaluation' => $request->id_evaluation,
            'id_classe' => $evaluation->id_classe,
            'id_matiere' => $evaluation->id_matiere,
            'note' => $request->note,
            'type' => $evaluation->type,
            'commentaire' => $request->commentaire
        ]);

        // Redirect based on user role
        if (auth()->user()->hasRole('enseignant')) {
            return redirect()->route('admin.evaluations.show', $evaluation)
                ->with('success', 'La note a été ajoutée avec succès.');
        }

        return redirect()->route('admin.notes.index')
            ->with('success', 'La note a été ajoutée avec succès.');
    }

    /**
     * Show the form for editing a note
     */
    public function edit(Note $note)
    {
        if (!$this->canManageNote(null, null, $note->id_note)) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette note.');
        }

        $note->load(['etudiant', 'evaluation', 'classe']);

        return view('admin.academic.notes.edit', compact('note'));
    }

    /**
     * Update the specified note
     */
    public function update(Request $request, Note $note)
    {
        if (!$this->canManageNote(null, null, $note->id_note)) {
            return redirect()->back()
                ->with('error', 'Vous n\'êtes pas autorisé à modifier cette note.');
        }

        $request->validate([
            'note' => 'required|numeric|min:0',
            'commentaire' => 'nullable|string'
        ]);

        $note->update([
            'note' => $request->note,
            'commentaire' => $request->commentaire
        ]);

        // Redirect based on user role
        if (auth()->user()->hasRole('enseignant')) {
            return redirect()->route('admin.evaluations.show', $note->evaluation)
                ->with('success', 'La note a été modifiée avec succès.');
        }

        return redirect()->route('admin.notes.index')
            ->with('success', 'La note a été modifiée avec succès.');
    }

    /**
     * Remove the specified note
     */
    public function destroy(Note $note)
    {
        if (!$this->canManageNote(null, null, $note->id_note)) {
            return redirect()->back()
                ->with('error', 'Vous n\'êtes pas autorisé à supprimer cette note.');
        }

        $note->delete();

        return redirect()->back()
            ->with('success', 'La note a été supprimée avec succès.');
    }

    /**
     * Display student grade transcript
     */
    public function transcript(Request $request, Etudiant $etudiant, $trimestre = null)
    {
        // Get selected academic year from request, default to current (support both 'annee' and 'year')
        $selectedYear = $request->get('annee') ?? $request->get('year');
        $academicYear = $selectedYear ?: $this->transcriptService->getCurrentAcademicYear();

        // Get available academic years for this student
        $availableYears = $this->transcriptService->getAvailableAcademicYearsForStudent($etudiant);

        // Get all notes for the student with improved relationships
        $notesQuery = Note::with(['evaluation.matiere', 'matiere', 'classe'])
            ->where('id_etudiant', $etudiant->id_etudiant);

        // Filter by selected academic year
        $notesQuery->whereHas('evaluation', function ($q) use ($academicYear) {
            $yearRange = $this->transcriptService->getAcademicYearDateRange($academicYear);
            $q->whereBetween('date', [$yearRange['start'], $yearRange['end']]);
        });

        // Filter by trimestre if provided with better date handling
        if ($trimestre) {
            $notesQuery->whereHas('evaluation', function ($q) use ($trimestre, $academicYear) {
                $dates = $this->transcriptService->getTrimestreDateRangeForYear($trimestre, $academicYear);
                $q->whereBetween('date', [$dates['start'], $dates['end']]);
            });
        }

        $notes = $notesQuery->orderBy('created_at', 'desc')->get();

        // Group notes by matiere for better organization
        $notesByMatiere = $notes->groupBy(function ($note) {
            return $note->matiere?->code_matiere ??
                $note->evaluation?->matiere?->code_matiere ??
                'Matière non spécifiée';
        });

        // Calculate statistics with improved logic
        $statistics = $this->transcriptService->calculateTranscriptStatistics($notesByMatiere);

        // Get trimestre info with proper labels
        $trimestreInfo = $trimestre ? $this->transcriptService->getTrimestreInfo($trimestre) : null;

        return view('admin.academic.notes.transcript', compact(
            'etudiant',
            'notes',
            'notesByMatiere',
            'statistics',
            'trimestre',
            'trimestreInfo',
            'academicYear',
            'availableYears'
        ));
    }

    /**
     * Public: Search for student transcript by matricule (NO LOGIN REQUIRED)
     */
    public function publicTranscriptSearch(Request $request)
    {
        $request->validate([
            'matricule' => 'required|string'
        ]);

        $etudiant = Etudiant::where('matricule', $request->matricule)->first();

        if (!$etudiant) {
            return redirect()->route('accueil')
                ->with('error', 'Aucun étudiant trouvé avec ce matricule.');
        }

        // Redirect to public transcript view
        return redirect()->route('public.transcript.show', $etudiant->matricule);
    }

    /**
     * Public: Display student transcript (NO LOGIN REQUIRED)
     */
    public function publicTranscript($matricule, $trimestre = null)
    {
        // Find student by matricule
        $etudiant = Etudiant::where('matricule', $matricule)->firstOrFail();

        // Get selected academic year from request, default to current
        $selectedYear = request()->get('year');
        $academicYear = $selectedYear ?: $this->transcriptService->getCurrentAcademicYear();

        // Get available academic years for this student
        $availableYears = $this->transcriptService->getAvailableAcademicYearsForStudent($etudiant);

        // Get all notes for the student with improved relationships
        $notesQuery = Note::with(['evaluation.matiere', 'matiere', 'classe'])
            ->where('id_etudiant', $etudiant->id_etudiant);

        // Filter by selected academic year
        $notesQuery->whereHas('evaluation', function ($q) use ($academicYear) {
            $yearRange = $this->transcriptService->getAcademicYearDateRange($academicYear);
            $q->whereBetween('date', [$yearRange['start'], $yearRange['end']]);
        });

        // Filter by trimestre if provided with better date handling
        if ($trimestre) {
            $notesQuery->whereHas('evaluation', function ($q) use ($trimestre, $academicYear) {
                $dates = $this->transcriptService->getTrimestreDateRangeForYear($trimestre, $academicYear);
                $q->whereBetween('date', [$dates['start'], $dates['end']]);
            });
        }

        $notes = $notesQuery->orderBy('created_at', 'desc')->get();

        // Group notes by matiere for better organization
        $notesByMatiere = $notes->groupBy(function ($note) {
            return $note->matiere?->code_matiere ??
                $note->evaluation?->matiere?->code_matiere ??
                'Matière non spécifiée';
        });

        // Calculate statistics with improved logic
        $statistics = $this->transcriptService->calculateTranscriptStatistics($notesByMatiere);

        // Get trimestre info with proper labels
        $trimestreInfo = $trimestre ? $this->transcriptService->getTrimestreInfo($trimestre) : null;

        return view('public.transcript', compact(
            'etudiant',
            'notes',
            'notesByMatiere',
            'statistics',
            'trimestre',
            'trimestreInfo',
            'academicYear',
            'availableYears'
        ));
    }

    /**
     * Admin: Search for student transcript by matricule (REQUIRES LOGIN)
     */
    public function transcriptSearch(Request $request)
    {
        $request->validate([
            'matricule' => 'required|string'
        ]);

        $etudiant = Etudiant::where('matricule', $request->matricule)->first();

        if (!$etudiant) {
            return redirect()->route('accueil')
                ->with('error', 'Aucun étudiant trouvé avec ce matricule.');
        }

        // Redirect to admin transcript view
        return redirect()->route('admin.rapports.notes.transcript', $etudiant->matricule);
    }

    /**
     * Show all students for transcript selection
     */
    public function transcriptIndex(Request $request)
    {
        $classes = Classe::orderBy('nom_classe')->get();

        // Only load students if there's a search query or class filter
        if ($request->hasAny(['search', 'classe'])) {
            $query = Etudiant::with('classe');

            // Apply search filter
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenom', 'like', "%{$search}%")
                        ->orWhere('matricule', 'like', "%{$search}%");
                });
            }

            // Apply class filter
            if ($request->filled('classe')) {
                $query->where('id_classe', $request->classe);
            }

            $etudiants = $query->orderBy('nom')->orderBy('prenom')->paginate(12);
        } else {
            // Create empty paginator when no search
            $etudiants = new \Illuminate\Pagination\LengthAwarePaginator(
                [],
                0,
                12,
                1,
                ['path' => $request->url()]
            );
        }

        return view('admin.academic.notes.transcript-index', compact('etudiants', 'classes'));
    }
}
