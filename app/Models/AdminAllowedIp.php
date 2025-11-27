<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminAllowedIp extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'label',
        'is_active',
        'added_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function addedBy()
    {
        return $this->belongsTo(Administrateur::class, 'added_by', 'id_administrateur');
    }
}
