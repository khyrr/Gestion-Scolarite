<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Enseignant;
use App\Models\Matiere;
use App\Services\CourseService;

class CoursController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cours = Cours::with(['classe', 'matiere', 'enseignant'])->latest()->paginate(15);
        return view('admin.academic.cours.index')->with('cours', $cours);
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::all();
        $enseignants = Enseignant::all();
        $matieres = Matiere::all();

        return view('admin.academic.cours.create', compact('classes', 'enseignants', 'matieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Cours::create($input);

        // Redirect to timetable if coming from there, otherwise to index
        if ($request->input('from_timetable')) {
            return redirect()->route('admin.cours.spectacle')->with('success', 'Le cours a été ajouté avec succès!');
        }

        return redirect()->route('admin.cours.index')->with('flash_message', 'Le cours a été ajouté');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cours $cour)
    {
        $cours = $cour; // Keep variable name consistent in view
        $cours->load(['classe', 'matiere', 'enseignant']);
        return view('admin.academic.cours.show', compact('cours'));
    }

    /**
     * Display the timetable/schedule view.
     */
    public function spectacle()
    {
        $data = $this->courseService->getScheduleData();
        return view('admin.academic.cours.spectacle', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Cours = Cours::find($id);
        $classes = Classe::all();
        $enseignants = Enseignant::all();
        $matieres = Matiere::all();

        if (!$Cours) {
            return redirect()->back()->with('flash_message', 'Cours introuvable');
        }

        return view('admin.academic.cours.edit', compact('Cours', 'classes', 'enseignants', 'matieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cours = Cours::find($id);
        $input = $request->all();
        $cours->update($input);

        // Redirect to timetable if coming from there, otherwise to index
        if ($request->input('from_timetable')) {
            return redirect()->route('admin.cours.spectacle')->with('success', 'Le cours a été modifié avec succès!');
        }

        return redirect()->route('admin.cours.index')->with('flash_message', 'Les informations ont été mises à jour!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        Cours::find($id)->delete();

        // Redirect to timetable if coming from there, otherwise to index
        if ($request->input('from_timetable')) {
            return redirect()->route('admin.cours.spectacle')->with('success', 'Le cours a été supprimé avec succès!');
        }

        return redirect()->route('admin.cours.index')->with('flash_message', 'Le cours est supprimé');
    }
}
