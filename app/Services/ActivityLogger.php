<?php

namespace App\Services;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogger
{
    /**
     * Log activity using Spatie activitylog. Keeps compatibility with old signature.
     */
    public static function log(string $userType, ?int $userId, string $action, ?string $resource = null, $resourceId = null, ?string $description = null, ?array $changes = null, ?Request $request = null)
    {
        $ip = $request?->ip() ?? request()->ip() ?? null;
        $ua = $request?->userAgent() ?? request()->userAgent() ?? null;

        // Try to resolve causer (user model) if possible
        $causer = null;
        if ($userType && $userId && class_exists($userType)) {
            try {
                $causer = $userType::find($userId);
            } catch (\Throwable $e) {
                $causer = null;
            }
        }

        // Try to resolve performedOn subject if resource is a model class or model instance
        $performedOn = null;
        if ($resource instanceof \Illuminate\Database\Eloquent\Model) {
            $performedOn = $resource;
        } elseif (is_string($resource) && $resource && $resourceId && class_exists($resource)) {
            try {
                $performedOn = $resource::find($resourceId);
            } catch (\Throwable $e) {
                $performedOn = null;
            }
        }

        $properties = array_filter([
            'resource' => is_string($resource) && ! $performedOn ? $resource : null,
            'resource_id' => $resourceId,
            'changes' => $changes,
            'ip' => $ip,
            'user_agent' => $ua,
        ], fn($v) => !is_null($v));

        $activityChain = activity();

        if ($causer) {
            $activityChain = $activityChain->causedBy($causer);
        }

        $activity = $activityChain
            ->performedOn($performedOn ?? null)
            ->withProperties($properties)
            ->log($description ?? $action);

        return $activity;
    }
}
