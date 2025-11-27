<?php

namespace App\Http\Controllers;

use App\Models\EtudePaiement;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use App\Services\PaymentService;

class EtudePaiementController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudepaiement = EtudePaiement::all();
        $etudiant = Etudiant::all();
        return view('etudepaiement.index', compact('etudiant', 'etudepaiement'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id, $frais)
    {
        $etudiant = Etudiant::find($id); // Retrieve the student using the provided ID
        return view('etudepaiement.create', compact('etudiant', 'frais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $e = $input['id_etudiant'];
        $etudiant = Etudiant::find($e);

        $this->paymentService->createStudentPayment($input);

        return redirect('paiement/etudepaiement')->with('flash_message', "Les frais de {$etudiant->nom} ont été payés");
    }

    /**
     * Display the specified resource.
     */
    public function show(EtudePaiement $etudePaiement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, $frais)
    {
        $etudepaiement = EtudePaiement::find($id);
        $idetudiant = $etudepaiement->id_etudiant;
        $etudiant = Etudiant::find($idetudiant);
        if (!$etudepaiement) {
            return redirect()->back()->with('flash_message', 'introuvable');
        }
        return view('etudepaiement.edit', compact('etudepaiement', 'etudiant', 'frais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $etudepaiement)
    {
        $etudepaiementModel = EtudePaiement::find($etudepaiement);
        $etudiant = Etudiant::find($etudepaiementModel->id_etudiant);
        $input = $request->all();

        $this->paymentService->updateStudentPayment($etudepaiement, $input);

        return redirect('/paiement/etudepaiement')->with('flash_message', "Les frais de {$etudiant->nom} ont été payés");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EtudePaiement $etudePaiement)
    {
        //
    }
}
