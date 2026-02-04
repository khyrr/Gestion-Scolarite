# Notification Preferences & Control Levels

## Overview

The notification system implements a **two-level control mechanism** that provides both system-wide administration and individual user customization. This allows administrators to manage notification policies while giving users control over their personal preferences.

## Control Hierarchy

```
┌─────────────────────────────────────────────────────────────┐
│                   Control Level Flow                         │
└─────────────────────────────────────────────────────────────┘

Level 1: Admin System-Wide Control (Settings)
   ↓
   ├── Enabled Globally?
   │   ├── YES → Continue to Level 2
   │   └── NO  → Block all notifications of this type
   ↓
Level 2: User Individual Preferences (Account)
   ↓
   ├── User enabled this notification?
   │   ├── YES → Send notification
   │   └── NO  → Don't send notification
```

### Principle: Admin Override

**Admin settings always take precedence**. If an admin disables a notification type globally, no user will receive it regardless of their individual preferences.

---

## Level 1: Admin System-Wide Control

### Access

- **Role Required**: Super Admin OR 'manage settings' permission
- **Location**: Settings → Notifications
- **URL**: `/admin/settings/notifications`

### Available Controls

| Notification Type | Description | Default |
|------------------|-------------|---------|
| Grade Published | Notify students when grades are posted | Enabled |
| Evaluation Created | Notify students about new evaluations | Enabled |
| Teacher Payment | Notify teachers when payments are processed | Enabled |
| Student Payment | Notify students/parents about payments | Enabled |
| Account Lockout | Notify users about account lockouts | Enabled |
| Security Alerts | Notify users about security events | Enabled |

### Implementation

**File**: `app/Filament/Pages/Settings/NotificationSettings.php`

**Key Features**:
- Toggle switches for each notification type
- Uses `SettingsService` for persistence
- Settings stored in `settings` table with keys like `notifications.teacher_payment.enabled`

**Code Example**:

```php
public function save(): void
{
    $data = $this->form->getState();
    
    $this->settingsService->set(
        'notifications.teacher_payment.enabled', 
        $data['enable_teacher_payment']
    );
    
    // ... save other settings
}
```

### Listener Integration

Every notification listener checks the admin setting before sending:

```php
public function handle(TeacherPaymentProcessed $event): void
{
    // Check system-wide setting first
    $settingsService = app(\App\Services\SettingsService::class);
    if (!$settingsService->get('notifications.teacher_payment.enabled', true)) {
        return; // Admin disabled this notification type
    }
    
    // Continue with notification logic...
}
```

### Use Cases

**Scenario 1: Disable During Maintenance**
- Admin temporarily disables all grade notifications during system migration
- No students receive grade notifications until re-enabled
- Individual user preferences are preserved

**Scenario 2: School Policy**
- School decides payment notifications should be opt-in only
- Admin disables teacher payment notifications
- Teachers must request to be added to a manual distribution list

**Scenario 3: Testing Phase**
- New notification type is in beta
- Admin keeps it disabled until thoroughly tested
- Can enable for all users when ready

---

## Level 2: User Individual Preferences

### Access

- **Role Required**: Any authenticated user
- **Location**: Account → Notifications
- **URL**: `/admin/account/notifications`

### Available Controls

Each user can control notifications on **two channels**:

1. **Email** - Receive via email
2. **In-App** - Receive in notification center

**Control Matrix**:

| Notification Type | Email Toggle | In-App Toggle |
|------------------|--------------|---------------|
| Login Attempts | ✓ | ✓ |
| Security Alerts | ✓ | ✓ |
| System Updates | ✓ | ✓ |
| Grade Published | ✓ | ✓ |

### Implementation

**File**: `app/Filament/Pages/Account/Notifications.php`

**Model**: `app/Models/NotificationPreference.php`

**Database Structure**:

```sql
CREATE TABLE notification_preferences (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED,
    key VARCHAR(255),              -- e.g., 'grade_published'
    channel VARCHAR(50),            -- 'mail' or 'database'
    enabled BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    UNIQUE KEY (user_id, key, channel)
);
```

**Example Records**:

```sql
-- Teacher wants email for payments, but not in-app
INSERT INTO notification_preferences VALUES
(1, 42, 'teacher_payment_processed', 'mail', TRUE, ...),
(2, 42, 'teacher_payment_processed', 'database', FALSE, ...);

-- Student wants both channels for grades
INSERT INTO notification_preferences VALUES
(3, 99, 'grade_published', 'mail', TRUE, ...),
(4, 99, 'grade_published', 'database', TRUE, ...);
```

### NotificationService Check

The service checks user preferences before sending:

```php
public function shouldNotify(User $user, string $key, string $channel): bool
{
    // First check admin setting
    $adminEnabled = $this->settingsService->get(
        "notifications.{$key}.enabled", 
        true
    );
    
    if (!$adminEnabled) {
        return false; // Admin disabled globally
    }
    
    // Then check user preference
    $preference = NotificationPreference::where([
        'user_id' => $user->id,
        'key' => $key,
        'channel' => $channel,
    ])->first();
    
    return $preference ? $preference->enabled : true; // Default to enabled
}
```

### UI Components

**Toggle Switches**:
```php
Forms\Components\Grid::make(3)
    ->schema([
        Forms\Components\Placeholder::make('label_grades')
            ->label('Grade Published')
            ->content('When a new grade is posted.'),
        Forms\Components\Toggle::make('grade_published_mail')
            ->label('Email'),
        Forms\Components\Toggle::make('grade_published_database')
            ->label('In-App'),
    ]),
```

### Use Cases

**Scenario 1: Busy Teacher**
- Teacher receives too many in-app notifications
- Keeps email enabled for critical updates
- Disables in-app for grade published events

**Scenario 2: Student Preferences**
- Student only wants important notifications
- Enables all security alerts
- Disables evaluation reminders (already has calendar)

**Scenario 3: Email Overload**
- Parent receives notifications for 3 children
- Disables all email notifications
- Checks in-app notification center daily instead

---

## Configuration Flow Examples

### Example 1: Teacher Payment Notification

**Admin Setting**: Enabled  
**User Preference (Email)**: Enabled  
**User Preference (In-App)**: Disabled  
**Result**: Teacher receives email, but not in-app notification

**Admin Setting**: Disabled  
**User Preference (Email)**: Enabled  
**User Preference (In-App)**: Enabled  
**Result**: Teacher receives nothing (admin override)

### Example 2: Grade Published Notification

**Admin Setting**: Enabled  
**User Preference (Email)**: Disabled  
**User Preference (In-App)**: Enabled  
**Result**: Student receives only in-app notification

**Admin Setting**: Enabled  
**User Preference (Email)**: Enabled  
**User Preference (In-App)**: Enabled  
**Result**: Student receives both email and in-app notification

### Example 3: Security Alert

**Admin Setting**: Enabled (cannot be disabled for security)  
**User Preference**: Irrelevant  
**Result**: All users receive critical security alerts

---

## Default Behaviors

### New Users

When a new user is created:
- **No preference records exist**
- **Default**: All notifications enabled on all channels
- **Reason**: Ensures users don't miss important information

### New Notification Types

When a new notification type is added:
- **Admin Setting**: Defaults to `true` (enabled)
- **User Preferences**: Don't exist yet, default to `true`
- **First Send**: Creates preference records as needed

### Deleted Preferences

If a preference record is deleted:
- **System reverts to default**: Enabled
- **Reason**: Safer to over-notify than miss critical updates

---

## Migration & Seeding

### Settings Seeder

```php
// database/seeders/SettingsSeeder.php

DB::table('settings')->insert([
    [
        'key' => 'notifications.grade_published.enabled',
        'value' => json_encode(true),
    ],
    [
        'key' => 'notifications.teacher_payment.enabled',
        'value' => json_encode(true),
    ],
    // ... etc
]);
```

### Default User Preferences

```php
// Not recommended to seed user preferences
// Let them default to 'enabled' and create on-demand
```

---

## API & Programmatic Access

### Check if Notification Should Send

```php
use App\Services\NotificationService;

$service = app(NotificationService::class);
$shouldSend = $service->shouldNotify(
    $user, 
    'teacher_payment_processed', 
    'mail'
);
```

### Update User Preference

```php
use App\Models\NotificationPreference;

NotificationPreference::updateOrCreate(
    [
        'user_id' => $user->id,
        'key' => 'grade_published',
        'channel' => 'database',
    ],
    [
        'enabled' => false
    ]
);
```

### Bulk Disable for User

```php
// Disable all email notifications for a user
NotificationPreference::where('user_id', $user->id)
    ->where('channel', 'mail')
    ->update(['enabled' => false]);
```

---

## Security & Privacy

### Privacy Considerations

1. **User Consent**: Users can opt-out of non-critical notifications
2. **Transparency**: Clear descriptions of what each notification does
3. **Data Retention**: Notification data follows general GDPR policies
4. **Unsubscribe**: Users can disable all non-essential notifications

### Critical Notifications

Some notifications **cannot be disabled by users**:
- Security alerts (password changes, 2FA events)
- Account lockouts
- Legal/compliance notifications

These are enforced at the listener level:

```php
// Security alerts ignore user preferences
if ($key === NotificationKeys::SECURITY_ALERT) {
    // Force send regardless of preferences
    return true;
}
```

---

## Admin Best Practices

### Communication

Before disabling a notification type:
1. **Announce to users**: Explain why it's being disabled
2. **Provide alternatives**: Offer manual ways to get information
3. **Set timeline**: If temporary, communicate when it will be re-enabled

### Testing

When enabling a new notification type:
1. **Test with test users first**
2. **Enable for admins only initially**
3. **Monitor for spam/bugs**
4. **Gradually roll out to all users**

### Monitoring

Regularly review:
- **Queue metrics**: Are notifications being sent?
- **User feedback**: Too many notifications?
- **Failed jobs**: Are notifications failing?
- **Opt-out rates**: Are users disabling specific types?

---

## User Best Practices

### Managing Notification Overload

If receiving too many notifications:
1. **Disable non-essential types**: Keep only critical ones
2. **Choose one channel**: Email OR in-app, not both
3. **Check daily**: Disable real-time, check once per day
4. **Contact admin**: Request policy changes if needed

### Important Notifications

Never disable:
- **Security alerts**: Critical for account safety
- **Payment confirmations**: Important financial records
- **Grade published**: Academic performance tracking

---

## Troubleshooting

### User Not Receiving Notifications

1. **Check admin setting**: Settings → Notifications
2. **Check user preference**: Account → Notifications
3. **Verify email address**: Valid and confirmed
4. **Check spam folder**: Email notifications may be filtered
5. **Test notification**: Trigger a test event

### Unwanted Notifications

1. **User disables in preferences**: Account → Notifications
2. **Admin disables globally**: If affecting many users
3. **Review event trigger**: May be firing too frequently
4. **Implement rate limiting**: Prevent notification spam

### Preferences Not Saving

1. **Check database connection**: Verify `notification_preferences` table
2. **Check user permissions**: Ensure authenticated
3. **Review browser console**: Look for JavaScript errors
4. **Check server logs**: `storage/logs/laravel.log`

---

## Future Enhancements

- [ ] **Notification Digest**: Daily/weekly summary emails
- [ ] **Smart Defaults**: AI-suggested preferences based on role
- [ ] **Priority Levels**: Critical, important, informational
- [ ] **Quiet Hours**: Don't send during specified times
- [ ] **Group Notifications**: Batch similar notifications
- [ ] **Mobile App**: Push notification preferences
- [ ] **Export Preferences**: Backup and restore settings
- [ ] **Admin Templates**: Pre-configured preference sets by role
