<?php

namespace App\Services;

use App\Models\Etudiant;
use Illuminate\Support\Facades\Hash;

class EtudiantService
{
    /**
     * Get paginated students with their classes
     */
    public function getPaginatedEtudiants($perPage = 10)
    {
        return Etudiant::with('classe')->latest()->paginate($perPage);
    }

    /**
     * Create a new student
     */
    public function createEtudiant(array $data)
    {
        // Password handling removed as Etudiant table has no password column
        if (isset($data['password'])) {
            unset($data['password']);
        }

        return Etudiant::create($data);
    }

    /**
     * Update a student
     */
    public function updateEtudiant(Etudiant $etudiant, array $data)
    {
        // Password handling removed as Etudiant table has no password column
        if (isset($data['password'])) {
            unset($data['password']);
        }

        $etudiant->update($data);
        return $etudiant;
    }

    /**
     * Delete a student
     */
    public function deleteEtudiant(Etudiant $etudiant)
    {
        return $etudiant->delete();
    }
}
