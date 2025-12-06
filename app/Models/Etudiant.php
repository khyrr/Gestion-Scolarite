<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $primaryKey = 'id_etudiant';
    protected $fillable = ['matricule', 'nom', 'prenom', 'telephone', 'date_naissance', 'genre', 'adresse', 'email', 'id_classe'];
    
    protected $casts = [
        'date_naissance' => 'datetime',
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'profile');
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
    
    // Helper method to get full name
    public function getFullNameAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    // Route model binding key - use matricule in URLs
    public function getRouteKeyName()
    {
        return 'matricule';
    }
    
    use HasFactory;
}
