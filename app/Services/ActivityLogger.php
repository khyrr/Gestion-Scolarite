<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogger
{
    public static function log(string $userType, ?int $userId, string $action, ?string $resource = null, $resourceId = null, ?string $description = null, ?array $changes = null, ?Request $request = null)
    {
        $ip = $request?->ip() ?? request()->ip() ?? null;
        $ua = $request?->userAgent() ?? request()->userAgent() ?? null;

        ActivityLog::create([
            'user_type' => $userType,
            'user_id' => $userId,
            'action' => $action,
            'resource' => $resource,
            'resource_id' => $resourceId,
            'description' => $description,
            'changes' => $changes,
            'ip_address' => $ip,
            'user_agent' => $ua,
        ]);
    }
}
