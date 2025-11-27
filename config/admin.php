<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Prefix
    |--------------------------------------------------------------------------
    |
    | The URL prefix for accessing the admin panel.
    | Example: https://domain.com/{prefix}/dashboard
    |
    */

    'prefix' => env('ADMIN_PREFIX', 'control-panel'),


    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    |
    | IP whitelist protection for admin routes.
    | If enabled, only allowed IPs can access admin routes.
    |
    | ip_whitelist_reject_status:
    |   - 404 hides admin presence
    |   - 403 returns Forbidden
    |   - 401 for Unauthorized
    |
    */

    'security' => [
        'ip_whitelist_enabled' => (bool) env('ADMIN_IP_WHITELIST_ENABLED', false),
        'ip_whitelist_reject_status' => (int) env('ADMIN_IP_WHITELIST_REJECT_STATUS', 404),
    ],

];
