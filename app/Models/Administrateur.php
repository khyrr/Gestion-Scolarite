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
        'email',
        'password',
        'role',
        'two_factor_secret',
        'two_factor_enabled',
        'two_factor_recovery_codes',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
    ];

    protected $casts = [
        'two_factor_enabled' => 'boolean',
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'profile');
    }
}
