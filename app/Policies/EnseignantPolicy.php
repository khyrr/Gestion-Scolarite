<?php

namespace App\Policies;

use App\Models\Enseignant;
use App\Models\User;

class EnseignantPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('teacher.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Enseignant $enseignant): bool
    {
        // Teachers can view their own data
        if ($user->profile_type === 'App\\Models\\Enseignant') {
            return $user->profile_id === $enseignant->id;
        }
        
        return $user->hasPermissionTo('teacher.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('teacher.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Enseignant $enseignant): bool
    {
        // Teachers can edit basic info about themselves
        if ($user->profile_type === 'App\\Models\\Enseignant' && $user->profile_id === $enseignant->id) {
            return true;
        }
        
        return $user->hasPermissionTo('teacher.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Enseignant $enseignant): bool
    {
        return $user->hasPermissionTo('teacher.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Enseignant $enseignant): bool
    {
        return $user->hasPermissionTo('teacher.delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Enseignant $enseignant): bool
    {
        return $user->hasRole('super_admin');
    }
}