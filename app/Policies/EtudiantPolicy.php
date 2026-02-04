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
        return $user->hasPermissionTo('student.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Etudiant $etudiant): bool
    {
        // Students can only view their own data
        if ($user->profile_type === 'App\Models\Etudiant') {
            return $user->profile_id === $etudiant->id;
        }
        
        // All other roles with permission can view students
        return $user->hasPermissionTo('student.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('student.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Etudiant $etudiant): bool
    {
        return $user->hasPermissionTo('student.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Etudiant $etudiant): bool
    {
        return $user->hasPermissionTo('student.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Etudiant $etudiant): bool
    {
        return $user->hasPermissionTo('student.delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Etudiant $etudiant): bool
    {
        return $user->hasRole('super_admin');
    }
}
