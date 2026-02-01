<?php

namespace App\Models;

use Spatie\Activitylog\Models\Activity as SpatieActivity;

/**
 * Compatibility wrapper for legacy code that still references App\Models\ActivityLog.
 * This class extends Spatie's Activity model and exposes legacy attribute names
 * (user_type, user_id, action, resource, resource_id, changes, ip_address, user_agent)
 * as accessors so existing code continues to work while we use Spatie's package.
 */
class ActivityLog extends SpatieActivity
{
    protected $table;

    protected $casts = [
        'properties' => 'array',
    ];

    public function __construct(array $attributes = [])
    {
        // Ensure we use the configured table name (activity_logs by default)
        $this->table = config('activitylog.table_name', 'activity_logs');

        parent::__construct($attributes);
    }

    // Legacy accessors
    public function getUserTypeAttribute()
    {
        return $this->causer_type ? class_basename($this->causer_type) : ($this->properties['resource'] ?? null);
    }

    public function getUserIdAttribute()
    {
        return $this->causer_id;
    }

    public function getActionAttribute()
    {
        // Older code stored a simple action; Spatie stores a description/event
        return $this->description ?? $this->event;
    }

    public function getResourceAttribute()
    {
        return $this->subject_type ? class_basename($this->subject_type) : ($this->properties['resource'] ?? null);
    }

    public function getResourceIdAttribute()
    {
        return $this->subject_id ?? $this->properties['resource_id'] ?? null;
    }

    public function getChangesAttribute()
    {
        return $this->properties['changes'] ?? null;
    }

    public function getIpAddressAttribute()
    {
        return $this->properties['ip'] ?? null;
    }

    public function getUserAgentAttribute()
    {
        return $this->properties['user_agent'] ?? null;
    }
}
