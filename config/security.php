<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Require Two-Factor Authentication
    |--------------------------------------------------------------------------
    |
    | When enabled, all users must have 2FA enabled to access the application.
    | Users without 2FA will be redirected to the setup page.
    |
    */
    'require_2fa' => env('SECURITY_REQUIRE_2FA', false),

    /*
    |--------------------------------------------------------------------------
    | Two-Factor Reconfirmation Minutes
    |--------------------------------------------------------------------------
    |
    | Number of minutes before requiring 2FA reconfirmation for sensitive actions.
    | Set to 0 to always require confirmation.
    |
    */
    'reconfirm_minutes' => env('SECURITY_RECONFIRM_MINUTES', 30),

    /*
    |--------------------------------------------------------------------------
    | Two-Factor Challenge Timeout
    |--------------------------------------------------------------------------
    |
    | Number of minutes a 2FA challenge session is valid before expiring.
    |
    */
    'challenge_timeout' => env('SECURITY_CHALLENGE_TIMEOUT', 15),

    /*
    |--------------------------------------------------------------------------
    | Max Failed Attempts
    |--------------------------------------------------------------------------
    |
    | Maximum number of failed 2FA attempts before rate limiting kicks in.
    |
    */
    'max_failed_attempts' => env('SECURITY_MAX_FAILED_ATTEMPTS', 5),

    /*
    |--------------------------------------------------------------------------
    | Rate Limit Decay Seconds
    |--------------------------------------------------------------------------
    |
    | Number of seconds to wait before resetting failed attempts counter.
    |
    */
    'rate_limit_decay_seconds' => env('SECURITY_RATE_LIMIT_DECAY_SECONDS', 60),

    /*
    |--------------------------------------------------------------------------
    | Recovery Codes Count
    |--------------------------------------------------------------------------
    |
    | Number of recovery codes to generate.
    |
    */
    'recovery_codes_count' => 8,
];
