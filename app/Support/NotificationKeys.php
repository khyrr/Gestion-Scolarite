<?php

namespace App\Support;

/**
 * Centralized registry of all notification keys used in the system.
 * This prevents magic strings and allows for easy refactoring.
 */
class NotificationKeys
{
    // Authentication & Security
    public const LOGIN_ATTEMPT = 'login_attempt';
    public const SECURITY_ALERT = 'security_alert';
    
    // System
    public const SYSTEM_UPDATE = 'system_update';
    public const GENERAL_UPDATES = 'general_updates';
    
    // Academic
    public const GRADE_PUBLISHED = 'grade_published';
    public const COURSE_UPDATED = 'course_updated';
    public const ASSIGNMENT_CREATED = 'assignment_created';
    public const EVALUATION_CREATED = 'evaluation_created';
    // Financial
    public const STUDENT_PAYMENT_RECEIVED = 'student_payment_received';
    public const TEACHER_PAYMENT_PROCESSED = 'teacher_payment_processed';
}
