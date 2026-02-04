# Teacher Payment Notification System

## Overview
The system automatically sends notifications to teachers when they receive payments. This is already fully implemented and working.

## How It Works

### 1. Payment Creation/Update
When a teacher payment is created or updated in the system:
- Location: `app/Models/EnseignPaiement.php`
- The `booted()` method listens for `created` and `updated` events
- When payment status is set to `'paye'`, it fires the `TeacherPaymentProcessed` event

```php
protected static function booted()
{
    static::created(function ($payment) {
        if ($payment->statut === 'paye') {
            event(new \App\Events\TeacherPaymentProcessed($payment));
        }
    });

    static::updated(function ($payment) {
        if ($payment->isDirty('statut') && $payment->statut === 'paye') {
            event(new \App\Events\TeacherPaymentProcessed($payment));
        }
    });
}
```

### 2. Event Processing
- Event: `app/Events/TeacherPaymentProcessed.php`
- Contains the payment object
- Registered in `app/Providers/EventServiceProvider.php`

### 3. Notification Dispatch
- Listener: `app/Listeners/SendTeacherPaymentNotification.php`
- Implements `ShouldQueue` for async processing
- Uses `NotificationService` to send the notification

```php
public function handle(TeacherPaymentProcessed $event): void
{
    $payment = $event->payment;
    $user = $payment->enseignant; // User model

    if ($user) {
        $this->notificationService->dispatch(
            NotificationKeys::TEACHER_PAYMENT_PROCESSED,
            $user,
            [
                'subject' => 'Versement de Salaire / Paiement Effectué',
                'message' => sprintf(
                    "Votre paiement de %s (%s) pour '%s' a été traité avec succès le %s.",
                    number_format($payment->montant, 2, ',', ' '),
                    config('app.currency', 'FCFA'),
                    $payment->typepaiement,
                    $payment->date_paiement->format('d/m/Y')
                ),
                'payment_id' => $payment->id_paiements,
                'status' => 'success',
                'icon' => 'heroicon-o-banknotes',
                'action_text' => 'Consulter mes paiements',
                'action_url' => url('/teacher/payments'), 
            ]
        );
    }
}
```

### 4. Notification Display
Teachers receive notifications in:
- In-app notification center (Filament panel)
- Database notifications table
- Optionally via email (if configured)

## Payment Statuses

The system recognizes three payment statuses:
- `'paye'` - Fully paid (triggers notification)
- `'non_paye'` - Not paid (no notification)
- `'partiel'` - Partially paid (no notification)

## Testing the Notification

### Create a Test Payment via Filament Admin Panel:
1. Go to **Financial Management > Teacher Payments**
2. Click **New Payment**
3. Fill in:
   - Teacher: Select a teacher
   - Payment Type: Select type (salaire, prime, avance, autre)
   - Amount: Enter amount
   - Status: Select **Payé** (paye)
   - Payment Date: Select date
4. Save

The teacher will receive a notification immediately.

### Update Existing Payment:
1. Find a payment with status `'non_paye'`
2. Edit it and change status to `'paye'`
3. Save

The teacher will receive a notification.

## Payment Types

The system supports various payment types:
- **salaire** - Monthly salary
- **prime** - Bonus/incentive
- **heures_supp** - Overtime pay
- **formation** - Training allowance
- **transport** - Transport allowance
- **avance** - Advance payment
- **autre** - Other payments

## Database Schema

Table: `enseignpaiements`
```sql
- id_paiements (primary key)
- user_id (foreign key to users table)
- typepaiement (string)
- montant (decimal 10,2)
- statut (enum: paye, non_paye, partiel)
- date_paiement (date)
- created_at, updated_at (timestamps)
```

## Configuration

### Notification Key
Defined in `app/Support/NotificationKeys.php`:
```php
public const TEACHER_PAYMENT_PROCESSED = 'teacher_payment_processed';
```

### Event-Listener Mapping
Defined in `app/Providers/EventServiceProvider.php`:
```php
\App\Events\TeacherPaymentProcessed::class => [
    \App\Listeners\SendTeacherPaymentNotification::class,
],
```

## Related Files

- **Model**: `app/Models/EnseignPaiement.php`
- **Event**: `app/Events/TeacherPaymentProcessed.php`
- **Listener**: `app/Listeners/SendTeacherPaymentNotification.php`
- **Resource**: `app/Filament/Resources/EnseignPaiementResource.php`
- **Migration**: `database/migrations/2025_09_15_154850_update_enseignpaiements_table_for_users.php`
- **Seeder**: `database/seeders/EnseignPaiementSeeder.php`

## Customization

### Change Notification Message
Edit `app/Listeners/SendTeacherPaymentNotification.php` to modify:
- Subject
- Message content
- Action button text/URL
- Icon

### Add Email Notifications
Modify the listener to also send email notifications using Laravel's mail system.

### Change Notification Conditions
Edit `app/Models/EnseignPaiement.php` `booted()` method to change when notifications are sent (e.g., also send for partial payments).

## Queue Processing

The notification listener implements `ShouldQueue`, so make sure to run:
```bash
php artisan queue:work
```

If you want notifications to be sent immediately (synchronously), remove `implements ShouldQueue` from the listener class.

## Recent Fix (2026-02-04)

Fixed status comparison issue:
- **Before**: Checking for `'Payé'` and `'Complet'` (capitalized, with accent)
- **After**: Checking for `'paye'` (lowercase, no accent) to match database enum values
- This ensures notifications are properly triggered when payments are marked as paid.
