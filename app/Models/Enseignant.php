<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Enseignant extends Model
{
    use Notifiable, HasFactory, LogsActivity;

    protected $primaryKey ='id_enseignant';
    protected $fillable =['nom','prenom','email','telephone','password','is_active','email_verified_at','remember_token'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'is_active' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'profile');
    }
    
    // Removed direct classe relationship - now handled through pivot table
    
    public function cours()
    {
        return $this->hasMany(Cours::class, 'id_enseignant');
    }
    
    public function paiements()
    {
        return $this->hasMany(EnseignPaiement::class, 'id_enseignant');
    }
    
    // New matiere relationships
    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'enseignant_matiere_classe', 'id_enseignant', 'id_matiere')
                    ->withPivot('id_classe', 'active')
                    ->withTimestamps();
    }
    
    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'enseignant_matiere_classe', 'id_enseignant', 'id_classe')
                    ->withPivot('id_matiere', 'active')
                    ->withTimestamps();
    }
    
    // Helper method to get full name


    // A teacher is always an 'enseignant' role in the system
    public function hasRole(string $role): bool
    {
        return $role === 'enseignant';
    }

    public function getFullNameAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * Configure activity logging
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nom', 'prenom', 'email', 'telephone', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Teacher {$eventName}");
    }
}
