<?php

namespace App\Listeners;

use App\Events\GradePublished;
use App\Services\NotificationService;
use App\Support\NotificationKeys;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * Listener to handle GradePublished events.
 * Delegates actual notification sending to NotificationService.
 */
class SendGradePublishedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    protected NotificationService $notificationService;

    /**
     * Create the event listener.
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     */
    public function handle(GradePublished $event): void
    {
        $this->notificationService->dispatch(
            NotificationKeys::GRADE_PUBLISHED,
            $event->student,
            [
                'subject' => 'New Grade Published',
                'message' => "A new grade has been published: {$event->gradeDetails}",
                'action_text' => 'View Grades',
                'action_url' => url('/student/grades'), // access via route helper in real app
            ]
        );
    }
}
