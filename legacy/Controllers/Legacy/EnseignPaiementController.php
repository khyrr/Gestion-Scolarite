<?php

namespace App\Http\Controllers\Legacy;

use App\Http\Controllers\Controller;

use App\Models\Enseignant;
use App\Models\EnseignPaiement;
use Illuminate\Http\Request;
use App\Services\PaymentService;

class EnseignPaiementController extends Controller
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
        $enseignpaiement = EnseignPaiement::all();
        $enseignant = Enseignant::all();
        return view('enseignpaiement.index', compact('enseignant', 'enseignpaiement'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id, $salaire)
    {
        $enseignant = Enseignant::find($id); // Retrieve the student using the provided ID
        return view('enseignpaiement.create', compact('enseignant', 'salaire'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $e = $input['id_enseignant'];
        $enseignant = Enseignant::find($e);

        $this->paymentService->createTeacherPayment($input);

        return redirect('paiement/enseignpaiement')->with('flash_message', "le salaire de {$enseignant->nom} a été payé");
    }

    /**
     * Display the specified resource.
     */
    public function show(EnseignPaiement $enseignPaiement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $enseignPaiement, $salaire)
    {
        $enseignpaiement = EnseignPaiement::find($enseignPaiement);
        $idenseignant = $enseignpaiement->id_enseignant;
        $enseignant = Enseignant::find($idenseignant);
        if (!$enseignpaiement) {
            return redirect()->back()->with('flash_message', 'enseignant introuvable');
        }

        return view('enseignpaiement.edit', compact('enseignpaiement', 'enseignant', 'salaire'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $enseignPaiement)
    {
        $input = $request->all();
        $this->paymentService->updateTeacherPayment($enseignPaiement, $input);
        return redirect('/paiement/enseignpaiement')->with('flash_message', 'le salaire a été payé');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EnseignPaiement $enseignPaiement)
    {
        //
    }
}
