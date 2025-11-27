<?php

namespace App\Services;

use App\Models\Cours;
use App\Models\Enseignant;
use App\Models\Etudiant;
use App\Models\Evaluation;

use App\Models\Note;

class SearchService
{
    /**
     * Perform the search logic based on the query and category
     */
    public function performSearch($query, $category)
    {
        $results = null;

        switch ($category) {
            case 'etudiant':
                $results = $this->searchEtudiants($query);
                break;
            case 'enseignant':
                $results = $this->searchEnseignants($query);
                break;
            case 'note':
                $results = $this->searchNotes($query);
                break;
            case 'course':
                $results = $this->searchCourses($query);
                break;
            case 'evaluation':
                $results = $this->searchEvaluations($query);
                break;
        }

        return $results;
    }

    private function searchEtudiants($query)
    {
        return Etudiant::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('nom', 'like', "%$query%")
                ->orWhere('prenom', 'like', "%$query%")
                ->orWhere('id_etudiant', 'like', "%$query%")
                ->orWhere('telephone', 'like', "%$query%")
                ->orWhere('date_naissance', 'like', "%$query%")
                ->orWhere('adresse', 'like', "%$query%")
                ->orWhereHas('classe', function ($subQueryBuilder) use ($query) {
                    $subQueryBuilder->where('niveau', 'like', "%$query%");
                });
        })->with('classe')->get();
    }

    private function searchEnseignants($query)
    {
        return Enseignant::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('nom', 'like', "%$query%")
                ->orWhere('id_enseignant', 'like', "%$query%")
                ->orWhere('telephone', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%")
                ->orWhere('matiere', 'like', "%$query%")
                ->orWhereHas('classe', function ($subQueryBuilder) use ($query) {
                    $subQueryBuilder->where('niveau', 'like', "%$query%");
                });
        })->with('classe')->get();
    }

    private function searchNotes($query)
    {
        return Note::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('note', 'like', "%$query%")
                ->orWhere('type', 'like', "%$query%")
                ->orWhere('notes.id_etudiant', 'like', "%$query%")
                ->orWhere('matiere', 'like', "%$query%")
                ->orWhereHas('etudiants', function ($subQueryBuilder) use ($query) {
                    $subQueryBuilder->where('nom', 'like', "%$query%");
                });
        })->with('etudiants')->get();
    }

    private function searchCourses($query)
    {
        return Cours::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('jour', 'like', "%$query%")
                ->orWhere('date_debut', 'like', "%$query%")
                ->orWhere('date_fin', 'like', "%$query%")
                ->orWhere('academic.cours.id_classe', 'like', "%$query%")
                ->orWhere('matiere', 'like', "%$query%")
                ->orWhereHas('classe', function ($subQueryBuilder) use ($query) {
                    $subQueryBuilder->where('niveau', 'like', "%$query%");
                });
        })->with('classe')->get();
    }

    private function searchEvaluations($query)
    {
        // Handling the potential typo in model name from original controller
        // Assuming Evoluation is an alias or typo for Evaluation, but using the class imported in original controller
        // If Evoluation doesn't exist, this might fail, but I'm mirroring original imports.
        // Checking imports: use App\Models\Evoluation; was present.

        return Evaluation::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('date', 'like', "%$query%")
                ->orWhere('type', 'like', "%$query%")
                ->orWhere('date_debut', 'like', "%$query%")
                ->orWhere('date_fin', 'like', "%$query%")
                ->orWhereHas('classe', function ($subQueryBuilder) use ($query) {
                    $subQueryBuilder->where('niveau', 'like', "%$query%");
                })
                ->orWhere('matiere', 'like', "%$query%");
        })->with('classe')->get();
    }
}
