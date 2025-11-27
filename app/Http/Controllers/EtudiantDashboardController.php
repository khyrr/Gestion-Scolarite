<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Auth;

class EtudiantDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:etudiant']);
    }

    public function index()
    {
        $user = Auth::user();
        $student = Etudiant::where('email', $user->email)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Profil étudiant non trouvé');
        }

        // Load relationships
        $student->load('classe');

        // Calculate stats
        $stats = [
            'classe_name' => $student->classe ? $student->classe->nom_classe : 'Non assigné',
            'level' => $student->classe ? $student->classe->niveau : 'N/A',
            'total_notes' => $student->notes()->count(),
        ];

        return view('etudiant.dashboard', compact('student', 'stats'));
    }

    public function mesNotes()
    {
        $user = Auth::user();
        $student = Etudiant::where('email', $user->email)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Profil étudiant non trouvé');
        }

        $notes = $student->notes()->with(['evaluation.matiere', 'evaluation.enseignant'])->get();

        return view('etudiant.notes', compact('student', 'notes'));
    }

    public function monEmploi()
    {
        $user = Auth::user();
        $student = Etudiant::where('email', $user->email)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Profil étudiant non trouvé');
        }

        $emploi = [];
        if ($student->classe) {
            $emploi = \App\Models\Cours::where('id_classe', $student->id_classe)
                ->with(['matiere', 'enseignant'])
                ->orderBy('jour')
                ->orderBy('date_debut')
                ->get()
                ->groupBy('jour');
        }

        return view('etudiant.emploi', compact('student', 'emploi'));
    }
}
