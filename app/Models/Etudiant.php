<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Etudiant extends Model
{
    use HasFactory, LogsActivity;
    
    protected $primaryKey = 'id_etudiant';
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'telephone',
        'adresse',
        'date_naissance',
        'genre',
        'id_classe'
    ];
    
    protected $casts = [
        'date_naissance' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->matricule)) {
                $model->matricule = self::generateMatricule();
            }
        });
    }

    public static function generateMatricule(): string
    {
        $year = date('Y');
        $count = self::whereYear('created_at', $year)->count() + 1;
        return $year . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    public function user()
    {
        return $this->morphOne(User::class, 'profile');
    }

    /**
     * Check if this student has a user account
     */
    public function hasAccount(): bool
    {
        return $this->user()->exists();
    }

    /**
     * Get email from user account if exists
     */
    public function getEmailAttribute()
    {
        return $this->user?->email;
    }

    /**
     * Get full name
     */
    public function getFullNameAttribute(): string
    {
        return trim("{$this->nom} {$this->prenom}");
    }
    
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe');
    }
    
    public function notes()
    {
        return $this->hasMany(Note::class, 'id_etudiant');
    }
    
    public function paiements()
    {
        return $this->hasMany(EtudePaiement::class, 'id_etudiant');
    }
    


    // Route model binding key - use matricule in URLs
    public function getRouteKeyName()
    {
        return 'matricule';
    }

    /**
     * Configure activity logging
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nom', 'prenom', 'email', 'telephone', 'id_classe', 'matricule'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Student {$eventName}");
    }
    
    use HasFactory;
}
