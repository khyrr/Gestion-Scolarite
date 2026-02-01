<?php

namespace App\Http\Controllers\Legacy;

use App\Http\Controllers\Controller;

use App\Models\Evaluation;
use App\Models\Classe;
use App\Http\Requests\Legacy\StoreEvaluationRequest;
use App\Http\Requests\Legacy\UpdateEvaluationRequest;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Evaluation::with(['classe', 'matiere'])
            ->orderBy('date', 'desc');

        // Apply filters
        if ($request->filled('type_filter')) {
            $query->where('type', $request->type_filter);
        }

        if ($request->filled('classe_filter')) {
            $query->whereHas('classe', function($q) use ($request) {
                $q->where('nom_classe', $request->classe_filter);
            });
        }

        if ($request->filled('matiere_filter')) {
            $query->whereHas('matiere', function($q) use ($request) {
                $q->where('nom_matiere', $request->matiere_filter);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('matiere', function($mq) use ($search) {
                    $mq->where('nom_matiere', 'like', "%{$search}%");
                })
                ->orWhereHas('classe', function($cq) use ($search) {
                    $cq->where('nom_classe', 'like', "%{$search}%");
                })
                ->orWhere('type', 'like', "%{$search}%")
                ->orWhere('date', 'like', "%{$search}%");
            });
        }

        // Get filtered results for statistics
        $filteredEvaluations = $query->get();
        
        // Statistics on filtered data
        $stats = [
            'total' => $filteredEvaluations->count(),
            'examens' => $filteredEvaluations->where('type', 'examen')->count(),
            'controles' => $filteredEvaluations->where('type', 'controle')->count(),
            'devoirs' => $filteredEvaluations->where('type', 'devoir')->count(),
        ];

        // Paginate
        $evaluations = $query->paginate(15)->withQueryString();

        // Get unique classes and matieres for filters
        $allClasses = Evaluation::with('classe')
            ->get()
            ->pluck('classe')
            ->filter()
            ->unique('nom_classe')
            ->sortBy('nom_classe')
            ->values();

        $allMatieres = Evaluation::with('matiere')
            ->get()
            ->pluck('matiere')
            ->filter()
            ->unique('nom_matiere')
            ->sortBy('nom_matiere')
            ->values();

        return view('old_admin_pages.admin.academic.evaluations.index', compact('evaluations', 'stats', 'allClasses', 'allMatieres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::orderBy('nom_classe')->get();
        return view('old_admin_pages.admin.academic.evaluations.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvaluationRequest $request)
    {
        try {
            $evaluation = Evaluation::create($request->validated());

            $redirectRoute = $this->getRedirectRoute($evaluation->type);

            return redirect()->route($redirectRoute)
                ->with('success', "L'évaluation de {$evaluation->matiere_name} a été créée avec succès.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la création de l\'évaluation.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        $evaluation->load(['classe', 'notes.etudiant']);
        return view('old_admin_pages.admin.academic.evaluations.show', compact('evaluation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        $classes = Classe::orderBy('nom_classe')->get();
        $matieres = \App\Models\Matiere::where('active', true)->orderBy('nom_matiere')->get();
        return view('old_admin_pages.admin.academic.evaluations.edit', compact('evaluation', 'classes', 'matieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEvaluationRequest $request, Evaluation $evaluation)
    {
        try {
            $evaluation->update($request->validated());
            return redirect()->route('admin.evaluations.index')
                ->with('success', "L'évaluation a été mise à jour avec succès.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la mise à jour.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        try {
            $matiere = $evaluation->matiere_name;
            $evaluation->delete();
            return redirect()->route('admin.evaluations.index')
                ->with('success', "L'évaluation de {$matiere} a été supprimée.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer cette évaluation.');
        }
    }

    /**
     * Show evaluation schedule
     */
    public function schedule($type, $niveau)
    {
        // Placeholder for schedule logic - to be implemented
        return view('old_admin_pages.admin.academic.evaluations.schedule', compact('type', 'niveau'));
    }

    /**
     * Get redirect route based on evaluation type
     */
    private function getRedirectRoute($type)
    {
        $routes = [
            'devoir' => 'admin.evaluations.index',
            'examen' => 'admin.evaluations.index',
            'controle' => 'admin.evaluations.index',
        ];

        return $routes[$type] ?? 'admin.evaluations.index';
    }
}
