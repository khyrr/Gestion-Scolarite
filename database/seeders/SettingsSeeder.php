<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Organization Settings
            [
                'key' => 'school_name',
                'value' => 'My School',
                'type' => 'string',
                'group' => 'organization',
                'description' => 'Name of the educational institution',
            ],
            [
                'key' => 'school_address',
                'value' => '',
                'type' => 'string',
                'group' => 'organization',
                'description' => 'Physical address of the school',
            ],
            [
                'key' => 'school_phone',
                'value' => '',
                'type' => 'string',
                'group' => 'organization',
                'description' => 'Main contact phone number',
            ],
            [
                'key' => 'school_email',
                'value' => '',
                'type' => 'string',
                'group' => 'organization',
                'description' => 'Main contact email address',
            ],
            [
                'key' => 'academic_year_start',
                'value' => '09-01',
                'type' => 'string',
                'group' => 'organization',
                'description' => 'Academic year start date (MM-DD format)',
            ],
            [
                'key' => 'academic_year_end',
                'value' => '06-30',
                'type' => 'string',
                'group' => 'organization',
                'description' => 'Academic year end date (MM-DD format)',
            ],

            // System Settings
            [
                'key' => 'timezone',
                'value' => 'UTC',
                'type' => 'string',
                'group' => 'system',
                'description' => 'Default system timezone',
            ],
            [
                'key' => 'date_format',
                'value' => 'Y-m-d',
                'type' => 'string',
                'group' => 'system',
                'description' => 'Default date format',
            ],
            [
                'key' => 'language',
                'value' => 'en',
                'type' => 'string',
                'group' => 'system',
                'description' => 'Default system language',
            ],
            [
                'key' => 'currency',
                'value' => 'USD',
                'type' => 'string',
                'group' => 'system',
                'description' => 'Default currency code',
            ],
            [
                'key' => 'items_per_page',
                'value' => '25',
                'type' => 'integer',
                'group' => 'system',
                'description' => 'Default number of items per page in lists',
            ],

            // Academic Settings
            [
                'key' => 'grading_system',
                'value' => 'percentage',
                'type' => 'string',
                'group' => 'academic',
                'description' => 'Grading system type: percentage, gpa, letter',
            ],
            [
                'key' => 'passing_grade',
                'value' => '60',
                'type' => 'integer',
                'group' => 'academic',
                'description' => 'Minimum passing grade',
            ],
            [
                'key' => 'max_grade',
                'value' => '100',
                'type' => 'integer',
                'group' => 'academic',
                'description' => 'Maximum possible grade',
            ],
            [
                'key' => 'terms_per_year',
                'value' => '2',
                'type' => 'integer',
                'group' => 'academic',
                'description' => 'Number of academic terms per year',
            ],
            [
                'key' => 'attendance_required',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'academic',
                'description' => 'Whether attendance tracking is mandatory',
            ],
            [
                'key' => 'min_attendance_percentage',
                'value' => '75',
                'type' => 'integer',
                'group' => 'academic',
                'description' => 'Minimum required attendance percentage',
            ],

            // Security Settings
            [
                'key' => 'password_min_length',
                'value' => '8',
                'type' => 'integer',
                'group' => 'security',
                'description' => 'Minimum password length requirement',
            ],
            [
                'key' => 'password_require_uppercase',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'security',
                'description' => 'Require uppercase letters in passwords',
            ],
            [
                'key' => 'password_require_numbers',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'security',
                'description' => 'Require numbers in passwords',
            ],
            [
                'key' => 'session_timeout',
                'value' => '120',
                'type' => 'integer',
                'group' => 'security',
                'description' => 'Session timeout in minutes',
            ],
            [
                'key' => 'max_login_attempts',
                'value' => '5',
                'type' => 'integer',
                'group' => 'security',
                'description' => 'Maximum login attempts before lockout',
            ],
            [
                'key' => 'two_factor_required',
                'value' => '0',
                'type' => 'boolean',
                'group' => 'security',
                'description' => 'Whether 2FA is required for all users',
            ],

            // Application Settings
            [
                'key' => 'registration_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'application',
                'description' => 'Allow new user registration',
            ],
            [
                'key' => 'email_verification_required',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'application',
                'description' => 'Require email verification for new accounts',
            ],
            [
                'key' => 'notifications_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'application',
                'description' => 'Enable system notifications',
            ],
            [
                'key' => 'file_upload_max_size',
                'value' => '10',
                'type' => 'integer',
                'group' => 'application',
                'description' => 'Maximum file upload size in MB',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
