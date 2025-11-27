<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrateur extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'admin';

    protected $primaryKey = 'id_administrateur';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'role',
        'two_factor_secret',
        'two_factor_enabled',
        'two_factor_recovery_codes',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
        'two_factor_secret',
    ];

    protected $casts = [
        'two_factor_enabled' => 'boolean',
    ];

    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }
}
