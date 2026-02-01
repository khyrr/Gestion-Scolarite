<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Administrateur extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_administrateur';

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'adresse',
    ];

    protected $hidden = [
        // Auth data is now in User model
    ];

    protected $casts = [
        // Move to User if needed
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'profile');
    }

    /**
     * Helper to check if admin has a user account
     */
    public function hasAccount(): bool
    {
        return $this->user !== null;
    }

    /**
     * Get full name
     */
    public function getFullNameAttribute(): string
    {
        return trim("{$this->prenom} {$this->nom}");
    }
}
