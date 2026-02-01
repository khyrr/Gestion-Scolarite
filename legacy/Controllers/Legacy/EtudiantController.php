<?php

namespace App\Http\Controllers\Legacy;

use App\Http\Controllers\Controller;

use App\Models\Etudiant;
use App\Models\Classe;
use App\Http\Requests\Legacy\StoreEtudiantRequest;
use App\Http\Requests\Legacy\UpdateEtudiantRequest;
use Illuminate\Http\Request;
use App\Services\EtudiantService;

class EtudiantController extends Controller
{
    protected $etudiantService;

    public function __construct(EtudiantService $etudiantService)
    {
        $this->etudiantService = $etudiantService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = $this->etudiantService->getPaginatedEtudiants();
        return view('old_admin_pages.admin.academic.etudiants.index', compact('etudiants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::orderBy('nom_classe')->get();
        return view('old_admin_pages.admin.academic.etudiants.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEtudiantRequest $request)
    {
        try {
            $etudiant = $this->etudiantService->createEtudiant($request->validated());
            return redirect()->route('admin.etudiants.index')
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
        return view('old_admin_pages.admin.academic.etudiants.show', compact('etudiant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        $classes = Classe::orderBy('nom_classe')->get();
        return view('old_admin_pages.admin.academic.etudiants.edit', compact('etudiant', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtudiantRequest $request, Etudiant $etudiant)
    {
        try {
            $this->etudiantService->updateEtudiant($etudiant, $request->validated());
            return redirect()->route('admin.etudiants.index')
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
            $this->etudiantService->deleteEtudiant($etudiant);
            return redirect()->route('admin.etudiants.index')
                ->with('success', "L'étudiant {$nom} a été supprimé.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer cet étudiant.');
        }
    }
}
