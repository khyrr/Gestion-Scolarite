<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Classe;
use App\Http\Requests\StoreEtudiantRequest;
use App\Http\Requests\UpdateEtudiantRequest;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = Etudiant::with('classe')->latest()->paginate(10);
        return view('academic.etudiants.index', compact('etudiants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::orderBy('nom_classe')->get();
        return view('academic.etudiants.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEtudiantRequest $request)
    {
        try {
            $etudiant = Etudiant::create($request->validated());
            return redirect()->route('etudiants.index')
                ->with('success', "L'étudiant {$etudiant->full_name} a été ajouté avec succès.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de l\'ajout de l\'étudiant.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        $etudiant->load(['classe', 'notes.evaluation', 'paiements']);
        return view('academic.etudiants.show', compact('etudiant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        $classes = Classe::orderBy('nom_classe')->get();
        return view('academic.etudiants.edit', compact('etudiant', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtudiantRequest $request, Etudiant $etudiant)
    {
        try {
            $etudiant->update($request->validated());
            return redirect()->route('etudiants.index')
                ->with('success', "Les informations de {$etudiant->full_name} ont été mises à jour.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la mise à jour.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        try {
            $nom = $etudiant->full_name;
            $etudiant->delete();
            return redirect()->route('etudiants.index')
                ->with('success', "L'étudiant {$nom} a été supprimé.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer cet étudiant.');
        }
    }
}
