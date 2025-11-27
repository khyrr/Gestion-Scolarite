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
        // Hash password if provided, otherwise use default
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = Hash::make('password'); // Default password
        }

        return Etudiant::create($data);
    }

    /**
     * Update a student
     */
    public function updateEtudiant(Etudiant $etudiant, array $data)
    {
        // Handle password update if provided
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
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
