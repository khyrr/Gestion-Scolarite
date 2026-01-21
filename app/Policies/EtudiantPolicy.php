<?php

namespace App\Policies;

use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EtudiantPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view students');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Etudiant $etudiant): bool
    {
        // Admins and teachers can view all students
        if ($user->hasPermissionTo('view students')) {
            return true;
        }
        
        // Students can only view their own data
        return $user->profile_type === 'App\\Models\\Etudiant' 
            && $user->profile_id === $etudiant->id_etudiant;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create students');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Etudiant $etudiant): bool
    {
        return $user->hasPermissionTo('edit students');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Etudiant $etudiant): bool
    {
        return $user->hasPermissionTo('delete students');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Etudiant $etudiant): bool
    {
        return $user->hasPermissionTo('delete students');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Etudiant $etudiant): bool
    {
        return $user->hasRole('super_admin');
    }
}
