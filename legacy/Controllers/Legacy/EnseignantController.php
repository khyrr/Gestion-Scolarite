<?php

namespace App\Http\Controllers\Legacy;

use App\Http\Controllers\Controller;

use App\Models\Enseignant;
use Illuminate\Http\Request;
use App\Models\Classe;
use App\Services\EnseignantService;

class EnseignantController extends Controller
{
    protected $enseignantService;

    public function __construct(EnseignantService $enseignantService)
    {
        $this->enseignantService = $enseignantService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enseignant = Enseignant::latest()->paginate(10);
        return view('old_admin_pages.admin.academic.enseignants.index')->with('enseignant', $enseignant);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::all(); // Retrieve all classes from the Classe model
        return view('old_admin_pages.admin.academic.enseignants.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $this->enseignantService->createTeacher($input);
        return redirect()->route('admin.enseignants.index')->with('flash_message', "l'enseignant a été ajouté");
    }

    /**
     * Display the specified resource.
     */
    public function show(Enseignant $enseignant)
    {
        return view('old_admin_pages.admin.academic.enseignants.show')->with('enseignants', $enseignant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enseignant $enseignant)
    {
        $classes = Classe::all();
        return view('old_admin_pages.admin.academic.enseignants.edit', compact('enseignant', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enseignant $enseignant)
    {
        $data = $request->only(['nom', 'prenom', 'address', 'phone', 'date_recrutement']);
        $selectedClasses = $request->has('selected_classes') ? $request->selected_classes : null;
        $matiereId = $request->has('matiere_id') ? $request->matiere_id : null;

        $this->enseignantService->updateTeacher($enseignant, $data, $selectedClasses, $matiereId);

        return redirect()->route('admin.enseignants.index')
            ->with('flash_message', 'enseignant modifié avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enseignant $enseignant)
    {
        $enseignant->delete();

        return redirect()->route('admin.enseignants.index')
            ->with('flash_message', 'enseignant supprimé avec succès!');
    }
}
