<?php

namespace App\Support;

/**
 * Registry of available notification channels.
 * Used to define which channels are supported by the system.
 */
class NotificationChannels
{
    public const DATABASE = 'database';
    public const MAIL = 'mail';
    public const BROADCAST = 'broadcast';
    public const SMS = 'sms';
    public const PUSH = 'push';
    
    /**
     * Get all available channels.
     *
     * @return array
     */
    public static function all(): array
    {
        return [
            self::DATABASE,
            self::MAIL,
            self::BROADCAST, // Configure Laravel Reverb or Pusher first
            self::SMS,       // Configure Vonage or Twilio first
            self::PUSH,      // Configure Web/Mobile Push first
        ];
    }
}
