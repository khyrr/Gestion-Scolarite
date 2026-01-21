<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'prenom',
        'nom',
        'email',
        'password',
        'role',
        'telephone',
        'is_active',
        'profile_type',
        'profile_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    /**
     * Get the profile associated with the user.
     */
    public function profile()
    {
        return $this->morphTo();
    }

    /**
     * Check if user is an administrator
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin' || $this->role === 'super_admin';
    }

    /**
     * Check if user is a teacher
     */
    public function isTeacher(): bool
    {
        return $this->role === 'teacher' || $this->role === 'enseignant';
    }

    /**
     * Check if user is a teacher (alias)
     */
    public function isEnseignant(): bool
    {
        return $this->isTeacher();
    }

    /**
     * Check if user is a student
     */
    public function isStudent(): bool
    {
        return $this->role === 'student' || $this->role === 'etudiant';
    }



    /**
     * Check if user has a specific role
     */
    public function hasRole(string $role): bool
    {
        if ($this->role === 'super_admin' && $role === 'admin') {
            return true;
        }
        return $this->role === $role;
    }

    /**
     * Check if user has any of the given roles
     */
    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }

    /**
     * Get user's full name
     */
    public function getFullNameAttribute(): string
    {
        return trim($this->prenom . ' ' . $this->nom);
    }

    /**
     * Get the classe this user belongs to (only for students via Etudiant model)
     * Teachers' classes are managed through enseignant_matiere_classe pivot table
     */
    public function classe()
    {
        if ($this->isEtudiant()) {
            // For students, get class through etudiant record
            $etudiant = Etudiant::where('email', $this->email)->first();
            return $etudiant ? $etudiant->classe() : null;
        }
        return null;
    }

    /**
     * Get students for this teacher (if user is a teacher)
     */
    public function etudiants()
    {
        if ($this->isEnseignant()) {
            // Get students through the classes this teacher teaches
            $teacherClasses = $this->classesEnseignees()->pluck('id_classe');
            return Etudiant::whereIn('id_classe', $teacherClasses);
        }
        return null;
    }

    /**
     * Get courses for this teacher (if user is a teacher)
     */
    public function cours()
    {
        if ($this->isEnseignant()) {
            return $this->hasMany(Cours::class, 'id_enseignant');
        }
        return null;
    }

    /**
     * Get notes for this student (if user is a student)
     */
    public function notes()
    {
        if ($this->isEtudiant()) {
            return $this->hasMany(Note::class, 'id_etudiant');
        }
        return null;
    }

    /**
     * Get payments for this teacher (if user is a teacher)
     */
    public function paiements()
    {
        if ($this->isEnseignant()) {
            return $this->hasMany(EnseignPaiement::class, 'id_enseignant');
        } elseif ($this->isEtudiant()) {
            return $this->hasMany(EtudePaiement::class, 'id_etudiant');
        }
        return null;
    }

    /**
     * Get subjects (matieres) this teacher teaches
     * Teachers should use the Enseignant model for subject relationships
     */
    public function matieres()
    {
        if ($this->isEnseignant()) {
            $enseignant = Enseignant::where('email', $this->email)->first();
            return $enseignant ? $enseignant->matieres() : collect();
        }
        return collect();
    }

    /**
     * Get classes this teacher teaches (through subjects)
     * Teachers should use the Enseignant model for class relationships
     */
    public function classesEnseignees()
    {
        if ($this->isEnseignant()) {
            $enseignant = Enseignant::where('email', $this->email)->first();
            return $enseignant ? $enseignant->classes() : collect();
        }
        return collect();
    }

    /**
     * Get subjects this teacher teaches in a specific class
     */
    public function matieresInClasse($classeId)
    {
        if ($this->isEnseignant()) {
            return $this->matieres()->wherePivot('id_classe', $classeId)->wherePivot('active', true);
        }
        return collect();
    }

    /**
     * Scope to get only active users
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get users by role
     */
    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Get all admins
     */
    public static function getAdmins()
    {
        return self::where('role', 'admin')->active()->get();
    }

    /**
     * Get all teachers
     */
    public static function getEnseignants()
    {
        return self::where('role', 'enseignant')->active()->get();
    }

    /**
     * Get all students
     */
    public static function getEtudiants()
    {
        return self::where('role', 'etudiant')->active()->get();
    }

    /**
     * Configure activity logging
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'role', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
