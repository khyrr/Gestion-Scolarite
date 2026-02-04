<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;

class NotePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view grades');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Note $note): bool
    {
        // Students can view their own grades
        if ($user->profile_type === 'App\\Models\\Etudiant') {
            return $user->profile_id === $note->etudiant_id;
        }
        
        // Teachers can view grades for evaluations they manage
        if ($user->profile_type === 'App\\Models\\Enseignant') {
            $enseignant = $user->profile;
            if ($enseignant && $enseignant->matieres()
                    ->where('matieres.id_matiere', $note->evaluation->id_matiere)
                    ->wherePivot('id_classe', $note->evaluation->id_classe)
                    ->exists()) {
                return true;
            }
        }
        
        return $user->hasPermissionTo('view grades');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create grades');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Note $note): bool
    {
        // Teachers can edit grades for their evaluations
        if ($user->profile_type === 'App\\Models\\Enseignant') {
            $enseignant = $user->profile;
            if ($enseignant && $enseignant->enseignantMatiereClasses()
                    ->where('matiere_id', $note->evaluation->matiere_id)
                    ->where('classe_id', $note->evaluation->classe_id)
                    ->exists()) {
                return true;
            }
        }
        
        return $user->hasPermissionTo('edit grades');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Note $note): bool
    {
        // Teachers can delete grades for their evaluations
        if ($user->profile_type === 'App\\Models\\Enseignant') {
            $enseignant = $user->profile;
            if ($enseignant && $enseignant->enseignantMatiereClasses()
                    ->where('matiere_id', $note->evaluation->matiere_id)
                    ->where('classe_id', $note->evaluation->classe_id)
                    ->exists()) {
                return true;
            }
        }
        
        return $user->hasPermissionTo('delete grades');
    }

    /**
     * Can edit grade comments
     */
    public function editComments(User $user, Note $note): bool
    {
        // Teachers can edit comments for their evaluations
        if ($user->profile_type === 'App\\Models\\Enseignant') {
            $enseignant = $user->profile;
            if ($enseignant && $enseignant->enseignantMatiereClasses()
                    ->where('matiere_id', $note->evaluation->matiere_id)
                    ->where('classe_id', $note->evaluation->classe_id)
                    ->exists()) {
                return true;
            }
        }
        
        return $user->hasPermissionTo('edit grade comments');
    }
}