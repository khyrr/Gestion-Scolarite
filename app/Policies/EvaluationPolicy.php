<?php

namespace App\Policies;

use App\Models\Evaluation;
use App\Models\User;

class EvaluationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('evaluation.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Evaluation $evaluation): bool
    {
        // Students can view evaluations for their class
        if ($user->profile_type === 'App\\Models\\Etudiant') {
            $etudiant = $user->profile;
            return $etudiant && $etudiant->classe_id === $evaluation->classe_id;
        }
        
        // Teachers can view evaluations they created or for subjects they teach
        if ($user->profile_type === 'App\\Models\\Enseignant') {
            $enseignant = $user->profile;
            if ($enseignant && $enseignant->matieres()
                    ->where('matieres.id_matiere', $evaluation->id_matiere)
                    ->wherePivot('id_classe', $evaluation->id_classe)
                    ->exists()) {
                return true;
            }
        }
        
        return $user->hasPermissionTo('evaluation.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('evaluation.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Evaluation $evaluation): bool
    {
        // Teachers can edit their own evaluations
        if ($user->profile_type === 'App\\Models\\Enseignant') {
            $enseignant = $user->profile;
            if ($enseignant && $enseignant->matieres()
                    ->where('matieres.id_matiere', $evaluation->id_matiere)
                    ->wherePivot('id_classe', $evaluation->id_classe)
                    ->exists()) {
                return true;
            }
        }
        
        return $user->hasPermissionTo('evaluation.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Evaluation $evaluation): bool
    {
        // Teachers can delete their own evaluations (with restrictions)
        if ($user->profile_type === 'App\\Models\\Enseignant') {
            $enseignant = $user->profile;
            if ($enseignant && $enseignant->matieres()
                    ->where('matieres.id_matiere', $evaluation->id_matiere)
                    ->wherePivot('id_classe', $evaluation->id_classe)
                    ->exists()) {
                // Can only delete if no grades have been assigned yet
                return !$evaluation->notes()->exists();
            }
        }
        
        return $user->hasPermissionTo('evaluation.delete');
    }
}