<?php

namespace App\Services;

use App\Models\Setting;

class SettingsService
{
    /**
     * Organization Settings - with ENV fallbacks
     */
    public function getOrganizationSettings(): array
    {
        return Setting::getGroup('organization') + [
            'school_name' => env('SCHOOL_NAME', 'My School'),
            'school_address' => env('SCHOOL_ADDRESS', ''),
            'school_phone' => env('SCHOOL_PHONE', ''),
            'school_email' => env('SCHOOL_EMAIL', ''),
            'school_website' => env('SCHOOL_WEBSITE', ''),
            'school_logo' => env('SCHOOL_LOGO', ''),
            'academic_year_start' => env('ACADEMIC_YEAR_START', '09-01'),
            'academic_year_end' => env('ACADEMIC_YEAR_END', '06-30'),
        ];
    }

    /**
     * System Settings - with ENV fallbacks
     */
    public function getSystemSettings(): array
    {
        return Setting::getGroup('system') + [
            'timezone' => env('APP_TIMEZONE', 'UTC'),
            'date_format' => env('DATE_FORMAT', 'Y-m-d'),
            'time_format' => env('TIME_FORMAT', 'H:i:s'),
            'language' => env('APP_LOCALE', 'en'),
            'currency' => env('CURRENCY', 'USD'),
            'currency_symbol' => env('CURRENCY_SYMBOL', '$'),
            'items_per_page' => (int) env('ITEMS_PER_PAGE', 25),
            'maintenance_mode' => env('APP_MAINTENANCE', false),
        ];
    }

    /**
     * Academic Settings - with ENV fallbacks
     */
    public function getAcademicSettings(): array
    {
        return Setting::getGroup('academic') + [
            'grading_system' => env('GRADING_SYSTEM', 'percentage'),
            'passing_grade' => (int) env('PASSING_GRADE', 60),
            'max_grade' => (int) env('MAX_GRADE', 100),
            'grade_scale' => [
                'A' => ['min' => 90, 'max' => 100],
                'B' => ['min' => 80, 'max' => 89],
                'C' => ['min' => 70, 'max' => 79],
                'D' => ['min' => 60, 'max' => 69],
                'F' => ['min' => 0, 'max' => 59],
            ],
            'terms_per_year' => (int) env('TERMS_PER_YEAR', 2),
            'attendance_required' => env('ATTENDANCE_REQUIRED', true),
            'min_attendance_percentage' => (int) env('MIN_ATTENDANCE_PERCENTAGE', 75),
            'late_submission_penalty' => (int) env('LATE_SUBMISSION_PENALTY', 10),
            'max_absences_per_term' => (int) env('MAX_ABSENCES_PER_TERM', 5),
        ];
    }

    /**
     * Security Settings - with ENV fallbacks
     */
    public function getSecuritySettings(): array
    {
        return Setting::getGroup('security') + [
            'password_min_length' => (int) env('PASSWORD_MIN_LENGTH', 8),
            'password_require_uppercase' => env('PASSWORD_REQUIRE_UPPERCASE', true),
            'password_require_lowercase' => env('PASSWORD_REQUIRE_LOWERCASE', true),
            'password_require_numbers' => env('PASSWORD_REQUIRE_NUMBERS', true),
            'password_require_symbols' => env('PASSWORD_REQUIRE_SYMBOLS', false),
            'session_timeout' => (int) env('SESSION_TIMEOUT', 120),
            'max_login_attempts' => (int) env('MAX_LOGIN_ATTEMPTS', 5),
            'lockout_duration' => (int) env('LOCKOUT_DURATION', 15),
            'two_factor_required' => env('TWO_FACTOR_REQUIRED', false),
            'password_expiry_days' => (int) env('PASSWORD_EXPIRY_DAYS', 90),
            'force_https' => env('FORCE_HTTPS', true),
        ];
    }

    /**
     * Application Settings - with ENV fallbacks
     */
    public function getApplicationSettings(): array
    {
        return Setting::getGroup('application') + [
            'app_name' => env('APP_NAME', config('app.name')),
            'app_version' => env('APP_VERSION', '1.0.0'),
            'default_user_role' => env('DEFAULT_USER_ROLE', 'student'),
            'registration_enabled' => env('REGISTRATION_ENABLED', true),
            'email_verification_required' => env('EMAIL_VERIFICATION_REQUIRED', true),
            'notifications_enabled' => env('NOTIFICATIONS_ENABLED', true),
            'file_upload_max_size' => (int) env('FILE_UPLOAD_MAX_SIZE', 10),
            'allowed_file_types' => ['pdf', 'doc', 'docx', 'jpg', 'png', 'gif'],
            'backup_frequency' => env('BACKUP_FREQUENCY', 'daily'),
            'auto_backup_enabled' => env('AUTO_BACKUP_ENABLED', true),
        ];
    }

    /**
     * Update organization settings
     */
    public function updateOrganizationSettings(array $data): void
    {
        foreach ($data as $key => $value) {
            $type = $this->getDataType($value);
            Setting::set($key, $value, $type, 'organization');
        }
    }

    /**
     * Update system settings
     */
    public function updateSystemSettings(array $data): void
    {
        foreach ($data as $key => $value) {
            $type = $this->getDataType($value);
            Setting::set($key, $value, $type, 'system');
        }
    }

    /**
     * Update academic settings
     */
    public function updateAcademicSettings(array $data): void
    {
        foreach ($data as $key => $value) {
            $type = $this->getDataType($value);
            Setting::set($key, $value, $type, 'academic');
        }
    }

    /**
     * Update security settings
     */
    public function updateSecuritySettings(array $data): void
    {
        foreach ($data as $key => $value) {
            $type = $this->getDataType($value);
            Setting::set($key, $value, $type, 'security');
        }
    }

    /**
     * Update application settings
     */
    public function updateApplicationSettings(array $data): void
    {
        foreach ($data as $key => $value) {
            $type = $this->getDataType($value);
            Setting::set($key, $value, $type, 'application');
        }
    }

    /**
     * Get data type for setting value
     */
    private function getDataType($value): string
    {
        if (is_bool($value)) {
            return 'boolean';
        }

        if (is_int($value)) {
            return 'integer';
        }

        if (is_float($value)) {
            return 'float';
        }

        if (is_array($value)) {
            return 'json';
        }

        return 'string';
    }

    /**
     * Get a single setting
     */
    public function get(string $key, $default = null)
    {
        return Setting::get($key, $default);
    }

    /**
     * Set a single setting
     */
    public function set(string $key, $value, string $group = 'general'): void
    {
        $type = $this->getDataType($value);
        Setting::set($key, $value, $type, $group);
    }

    /**
     * Reset settings to default for a group
     */
    public function resetGroup(string $group): void
    {
        Setting::where('group', $group)->delete();
        Setting::clearCache();
    }

    /**
     * Export all settings
     */
    public function exportSettings(): array
    {
        return Setting::all()->groupBy('group')->map(function ($settings) {
            return $settings->mapWithKeys(function ($setting) {
                return [$setting->key => [
                    'value' => $setting->value,
                    'type' => $setting->type,
                    'description' => $setting->description,
                ]];
            });
        })->toArray();
    }

    /**
     * Import settings from array
     */
    public function importSettings(array $settings): void
    {
        foreach ($settings as $group => $groupSettings) {
            foreach ($groupSettings as $key => $data) {
                Setting::set(
                    $key,
                    $data['value'] ?? $data,
                    $data['type'] ?? 'string',
                    $group,
                    $data['description'] ?? null
                );
            }
        }
    }
}