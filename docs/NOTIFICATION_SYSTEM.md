# Scalable Event-Driven Notification System

This project uses a centralized, event-driven architecture for notifications. This ensures scalability, preference management, and logging for all system communications.

## Architecture Rules

1.  **NEVER** call `$user->notify()` directly in your controllers or business logic.
2.  **ALWAYS** use `NotificationService::dispatch()`.
3.  All notifications are queued automatically.
4.  Filament is used only for displaying database notifications.

## 1. How to Send a Notification

### Option A: Using Events (Recommended)
This approach decouples your business logic from the notification system.

1.  **Dispatch the Event**:
    ```php
    // In your Controller or Service
    use App\Events\GradePublished;
    
    // ... logic to create grade ...
    
    event(new GradePublished($student, "Math 101 - A+"));
    ```

2.  **Logic is handled automatically**:
    - The `GradePublished` event is fired.
    - `SendGradePublishedNotification` listener picks it up (queued).
    - Listener calls `NotificationService::dispatch()`.
    - Service checks preferences and sends via enabled channels.

### Option B: Direct Dispatch (Service-to-Service)
Use this only when an event is overkill or strictly internal.

```php
use App\Services\NotificationService;
use App\Support\NotificationKeys;

class SomeService 
{
    public function __construct(protected NotificationService $notifier) {}
    
    public function execute(User $user)
    {
        $this->notifier->dispatch(
            NotificationKeys::SECURITY_ALERT, 
            $user, 
            [
                'subject' => 'Security Alert',
                'message' => 'Login from new IP detected.',
                'action_url' => '...',
            ]
        );
    }
}
```

## 2. Adding a New Notification Type

1.  **Add Key**: Add a new constant to `app/Support/NotificationKeys.php`.
    ```php
    public const NEW_FEATURE_ALERT = 'new_feature_alert';
    ```

2.  **Implement Event/Listener** (Optional but recommended):
    - Create `NewFeatureEvent`.
    - Create `SendNewFeatureNotification` listener.
    - Register in `EventServiceProvider`.

## 3. Managing Channels & Preferences

Users can manage their preferences. The `NotificationService` automatically checks `notification_preferences` table.

- If a record exists for `(user_id, key, channel)` and `enabled = false`, the notification is **suppressed** for that channel.
- Logs are written to `notification_logs` table for every attempt (sent/failed).

## 4. Extending Channels

To add a new channel (e.g., Slack):
1.  Add constant to `app/Support/NotificationChannels.php`.
2.  Ensure Laravel supports it (params in `config/services.php` etc).
3.  The `SystemNotification` class will automatically pass the new channel if `NotificationService` returns it.

## 5. Database Schema

The system relies on three tables:
- `notifications`: Standard Laravel table (UUID, type, data, read_at).
- `notification_preferences`: User opt-in/out settings per key/channel.
- `notification_logs`: History of all sent dispatch attempts.
