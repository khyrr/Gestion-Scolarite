<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GradePublished
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $student;
    public string $gradeDetails;

    /**
     * Create a new event instance.
     *
     * @param User $student
     * @param string $gradeDetails
     */
    public function __construct(User $student, string $gradeDetails)
    {
        $this->student = $student;
        $this->gradeDetails = $gradeDetails;
    }
}
