<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_type', 'user_id', 'action', 'resource', 'resource_id', 'description', 'changes', 'ip_address', 'user_agent'
    ];

    protected $casts = [
        'changes' => 'array',
    ];
}
