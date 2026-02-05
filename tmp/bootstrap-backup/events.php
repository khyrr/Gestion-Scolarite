<?php return array (
  'App\\Providers\\EventServiceProvider' => 
  array (
    'Illuminate\\Auth\\Events\\Registered' => 
    array (
      0 => 'Illuminate\\Auth\\Listeners\\SendEmailVerificationNotification',
    ),
    'Illuminate\\Auth\\Events\\Login' => 
    array (
      0 => 'App\\Listeners\\UpdateLastLoginAt',
    ),
    'Illuminate\\Auth\\Events\\Lockout' => 
    array (
      0 => 'App\\Listeners\\SendLockoutNotification',
    ),
    'App\\Events\\GradePublished' => 
    array (
      0 => 'App\\Listeners\\SendGradePublishedNotification',
    ),
    'App\\Events\\EvaluationCreated' => 
    array (
      0 => 'App\\Listeners\\SendEvaluationCreatedNotification',
    ),
    'App\\Events\\StudentPaymentReceived' => 
    array (
      0 => 'App\\Listeners\\SendStudentPaymentNotification',
    ),
    'App\\Events\\TeacherPaymentProcessed' => 
    array (
      0 => 'App\\Listeners\\SendTeacherPaymentNotification',
    ),
  ),
  'Illuminate\\Foundation\\Support\\Providers\\EventServiceProvider' => 
  array (
    'App\\Events\\GradePublished' => 
    array (
      0 => 'App\\Listeners\\SendGradePublishedNotification@handle',
    ),
    'App\\Events\\StudentPaymentReceived' => 
    array (
      0 => 'App\\Listeners\\SendStudentPaymentNotification@handle',
    ),
    'Illuminate\\Auth\\Events\\Login' => 
    array (
      0 => 'App\\Listeners\\UpdateLastLoginAt@handle',
    ),
    'Illuminate\\Auth\\Events\\Lockout' => 
    array (
      0 => 'App\\Listeners\\SendLockoutNotification@handle',
    ),
    'App\\Events\\EvaluationCreated' => 
    array (
      0 => 'App\\Listeners\\SendEvaluationCreatedNotification@handle',
    ),
    'App\\Events\\TeacherPaymentProcessed' => 
    array (
      0 => 'App\\Listeners\\SendTeacherPaymentNotification@handle',
    ),
  ),
);