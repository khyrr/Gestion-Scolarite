<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Academic Year Configuration
    |--------------------------------------------------------------------------
    | 
    | Configure when your academic year starts and how trimesters are divided
    |
    */

    // Month when the academic year starts (1-12)
    // 10 = October, 9 = September, 8 = August, etc.
    'academic_year_start_month' => env('ACADEMIC_YEAR_START_MONTH', 10),

    /*
    |--------------------------------------------------------------------------
    | Trimester Configuration
    |--------------------------------------------------------------------------
    |
    | Define the start and end dates for each trimester
    | Each trimester has: start_month, start_day, end_month, end_day
    |
    */
    'trimestres' => [
        '1' => [
            'start_month' => env('TRIMESTRE_1_START_MONTH', 10),  // October
            'start_day' => env('TRIMESTRE_1_START_DAY', 1),       // 1st
            'end_month' => env('TRIMESTRE_1_END_MONTH', 12),      // December  
            'end_day' => env('TRIMESTRE_1_END_DAY', 31),          // 31st
        ],
        '2' => [
            'start_month' => env('TRIMESTRE_2_START_MONTH', 1),   // January
            'start_day' => env('TRIMESTRE_2_START_DAY', 1),       // 1st
            'end_month' => env('TRIMESTRE_2_END_MONTH', 4),       // April
            'end_day' => env('TRIMESTRE_2_END_DAY', 30),          // 30th
        ],
        '3' => [
            'start_month' => env('TRIMESTRE_3_START_MONTH', 5),   // May
            'start_day' => env('TRIMESTRE_3_START_DAY', 1),       // 1st
            'end_month' => env('TRIMESTRE_3_END_MONTH', 9),       // September
            'end_day' => env('TRIMESTRE_3_END_DAY', 30),          // 30th
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Alternative: Semester System
    |--------------------------------------------------------------------------
    |
    | If you prefer semesters instead of trimesters, set this to true
    | and configure the semester dates below
    |
    */
    'use_semesters' => env('USE_SEMESTERS', false),
    
    'semesters' => [
        '1' => [
            'start_month' => env('SEMESTER_1_START_MONTH', 10),   // October
            'start_day' => env('SEMESTER_1_START_DAY', 1),        // 1st
            'end_month' => env('SEMESTER_1_END_MONTH', 2),        // February
            'end_day' => env('SEMESTER_1_END_DAY', 28),           // 28th
        ],
        '2' => [
            'start_month' => env('SEMESTER_2_START_MONTH', 3),    // March
            'start_day' => env('SEMESTER_2_START_DAY', 1),        // 1st
            'end_month' => env('SEMESTER_2_END_MONTH', 7),        // July
            'end_day' => env('SEMESTER_2_END_DAY', 31),           // 31st
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | School Information
    |--------------------------------------------------------------------------
    */
    'school_name' => env('SCHOOL_NAME', 'École'),
    'school_address' => env('SCHOOL_ADDRESS', ''),
    'school_phone' => env('SCHOOL_PHONE', ''),
    'school_email' => env('SCHOOL_EMAIL', ''),

    /*
    |--------------------------------------------------------------------------
    | Matricule Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for automatic student matricule generation
    | Supports multi-tenant systems with unique school codes
    |
    */
    'matricule' => [
        'school_code' => env('SCHOOL_CODE', 'SCH'),
        'format' => '{school_code}{year}{sequence}', // e.g., SCH26001
        'sequence_length' => 4, // Number of digits for sequence
        'year_format' => 'y', // 'y' for 2-digit year, 'Y' for 4-digit
    ],
];