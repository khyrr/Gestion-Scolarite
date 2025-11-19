<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use Illuminate\Http\Request;
use App\Models\Classe;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enseignant = Enseignant::latest()->paginate(10);
        return view('academic.enseignants.index')->with('enseignant',$enseignant);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::all(); // Retrieve all classes from the Classe model
        return view('academic.enseignants.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Enseignant::create($input);
        return redirect()->route('enseignants.index')->with('flash_message', "l'enseignant a été ajouté");
    }

    /**
     * Display the specified resource.
     */
    public function show(Enseignant $enseignant)
    {
        return view('academic.enseignants.show')->with('enseignants', $enseignant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enseignant $enseignant)
    {
        $classes = Classe::all();
        return view('academic.enseignants.edit', compact('enseignant', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enseignant $enseignant)
    {
        $enseignant->nom = $request['nom'];
        $enseignant->prenom = $request['prenom'];
        $enseignant->address = $request['address'];
        $enseignant->phone = $request['phone'];
        $enseignant->date_recrutement = $request['date_recrutement'];

        $enseignant->save();

        // Supprimer les anciennes relations
        $enseignant->matiereClasses()->detach();

        // Ajouter les nouvelles relations
        if ($request->has('selected_classes')) {
            foreach ($request->selected_classes as $classeid) {
                if ($request->has('matiere_id')) {
                    $enseignant->matiereClasses()->attach($classeid, ['matiere' => $request->matiere_id]);
                }
            }
        }

        return redirect()->route('enseignants.index')
            ->with('flash_message', 'enseignant modifié avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enseignant $enseignant)
    {
        $enseignant->delete();

        return redirect()->route('enseignants.index')
            ->with('flash_message', 'enseignant supprimé avec succès!');
    }
}
