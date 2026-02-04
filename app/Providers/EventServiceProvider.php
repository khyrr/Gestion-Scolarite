<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\UpdateLastLoginAt;
use App\Listeners\SendLockoutNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [
            UpdateLastLoginAt::class,
        ],
        Lockout::class => [
            SendLockoutNotification::class,
        ],
        \App\Events\GradePublished::class => [
            \App\Listeners\SendGradePublishedNotification::class,
        ],
        \App\Events\EvaluationCreated::class => [
            \App\Listeners\SendEvaluationCreatedNotification::class,
        ],
        \App\Events\StudentPaymentReceived::class => [
            \App\Listeners\SendStudentPaymentNotification::class,
        ],
        \App\Events\TeacherPaymentProcessed::class => [
            \App\Listeners\SendTeacherPaymentNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
