<?php

namespace App\Policies;

use App\Models\Classe;
use App\Models\User;

class ClassePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view classes');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Classe $classe): bool
    {
        // Students can view their own class
        if ($user->profile_type === 'App\\Models\\Etudiant') {
            $etudiant = $user->profile;
            return $etudiant && $etudiant->classe_id === $classe->id_classe;
        }
        
        // Teachers can view classes they teach
        if ($user->profile_type === 'App\\Models\\Enseignant') {
            $enseignant = $user->profile;
            return $enseignant && $enseignant->classes()
                ->where('classes.id_classe', $classe->id_classe)
                ->exists();
        }
        
        return $user->hasPermissionTo('view classes');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create classes');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Classe $classe): bool
    {
        return $user->hasPermissionTo('edit classes');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Classe $classe): bool
    {
        return $user->hasPermissionTo('delete classes');
    }

    /**
     * Determine whether the user can manage class assignments.
     */
    public function manageAssignments(User $user, Classe $classe): bool
    {
        return $user->hasPermissionTo('manage class assignments');
    }
}