# School Settings Management System

## Overview

A flexible, scalable, and performant settings management system for school administration applications. The system uses a key-value database approach with type safety, caching, and grouping capabilities.

## Settings Priority System

The settings system follows a **three-tier priority cascade**:

### **Priority Order: Database → ENV → Default**

```php
// 1. Database Setting (Highest Priority)
// Super admin sets in /admin/settings
Setting::set('school.name', 'Harvard University', 'string', 'organization');

// 2. Environment Variable (Middle Priority)  
// Set in .env file
SCHOOL_NAME="MIT University"

// 3. Default Value (Lowest Priority)
// Hardcoded in service or helper
setting('school.name', 'Default School')

// Result: Database value takes precedence if it exists
setting('school.name') // Returns "Harvard University"
```

### **Resolution Flow**

```php
function setting($key, $default = null) {
    // 1. Check database first
    $dbValue = Setting::where('key', $key)->first();
    if ($dbValue) return $dbValue->value;
    
    // 2. Check environment variable
    $envValue = env(strtoupper(str_replace('.', '_', $key)));
    if ($envValue !== null) return $envValue;
    
    // 3. Return default
    return $default;
}
```

### **Environment Variable Naming**

Settings keys are automatically converted to ENV format:
```php
'school.name' → 'SCHOOL_NAME'
'security.password_min_length' → 'PASSWORD_MIN_LENGTH'  
'school.academic_year_start' → 'ACADEMIC_YEAR_START'
```

### **Use Cases**

1. **Development**: Override via .env for local testing
2. **Staging**: Environment-specific values without database changes
3. **Production**: Database settings managed by super admin
4. **Docker**: Container-specific configuration via environment

### **Benefits**

- ✅ **Flexible Deployment**: Environment-specific overrides
- ✅ **Admin Control**: Database settings take precedence
- ✅ **Safe Defaults**: Always have fallback values
- ✅ **DevOps Friendly**: Easy CI/CD configuration

**Table: `settings`**
```sql
id                  - Primary key
key                 - Unique setting identifier (string)
value               - Setting value (text, nullable)
type                - Data type (string, integer, boolean, json)
group               - Setting category (system, academic, security, etc.)
description         - Human-readable description (text, nullable)
is_public           - Whether non-admin users can access (boolean)
created_at          - Creation timestamp
updated_at          - Last modification timestamp

Indexes:
- Unique index on 'key'
- Composite index on 'group' and 'key'
```

### Core Components

#### 1. Setting Model (`app/Models/Setting.php`)
- **Purpose**: Eloquent model for settings table
- **Features**:
  - Static methods for get/set operations
  - Automatic type casting
  - Built-in caching (1 hour TTL)
  - Cache invalidation on save/delete
  - Support for group-based operations

**Key Methods**:
```php
Setting::get(string $key, $default = null)           // Get single setting
Setting::set(string $key, $value, $type, $group)     // Set single setting
Setting::getGroup(string $group)                     // Get all settings in group
Setting::clearCache()                                // Clear all cached settings
```

#### 2. Settings Service (`app/Services/SettingsService.php`)
- **Purpose**: Business logic layer for settings management
- **Features**:
  - Group-specific getters with defaults
  - Type-aware data handling
  - Batch update operations
  - Import/export functionality

**Main Methods**:
```php
getSchoolSettings()          // School info, academic year
getSystemSettings()          // Timezone, language, currency
getAcademicSettings()        // Grading, attendance rules
getSecuritySettings()        // Password policies, session config
getApplicationSettings()     // File uploads, notifications
updateXXXSettings(array)     // Update specific setting groups
```

#### 3. Helper Function (`app/helpers.php`)
- **Purpose**: Global helper for easy setting access
- **Usage**:
```php
setting('school.name')                   // Get setting value
setting('academic.passing_grade', 60)    // Get with default
setting()->set('key', 'value', 'system') // Set using service
```

## Settings Categories

### 1. Organization Settings (`group: 'organization'`)
School/institution basic information:
```php
school.name                  // Institution name
school.address               // Physical address
school.phone                 // Contact phone
school.email                 // Contact email
school.website               // Website URL
school.logo                  // Logo path/URL
school.academic_year_start   // Academic year start (MM-DD)
school.academic_year_end     // Academic year end (MM-DD)
```

### 2. System Settings (`group: 'system'`)
System-wide configuration:
```php
system.timezone           // Default timezone
system.date_format        // Date display format
system.time_format        // Time display format
system.language           // Default language
system.currency           // Default currency
system.currency_symbol    // Currency symbol
system.items_per_page     // Pagination size
system.maintenance_mode   // System maintenance flag
```

### 3. Academic Settings (`group: 'academic'`)
Educational system configuration:
```php
academic.grading_system            // percentage, gpa, letter
academic.passing_grade             // Minimum passing grade
academic.max_grade                 // Maximum possible grade
academic.grade_scale               // JSON grade boundaries
academic.terms_per_year            // Academic terms per year
academic.attendance_required       // Mandatory attendance tracking
academic.min_attendance_percentage // Required attendance %
academic.late_submission_penalty   // Late work penalty %
academic.max_absences_per_term     // Maximum absences allowed
```

### 4. Security Settings (`group: 'security'`)
Security policies and authentication:
```php
security.password_min_length        // Minimum password length
security.password_require_uppercase // Require uppercase letters
security.password_require_lowercase // Require lowercase letters
security.password_require_numbers   // Require numeric characters
security.password_require_symbols   // Require special characters
security.session_timeout            // Session timeout (minutes)
security.max_login_attempts         // Login attempts before lockout
security.lockout_duration           // Lockout duration (minutes)
security.two_factor_required        // Mandatory 2FA flag
security.password_expiry_days       // Password expiration period
security.force_https                // Force HTTPS connections
```

### 5. Application Settings (`group: 'application'`)
Application behavior and features:
```php
app.name                         // Application name
app.version                      // Current version
app.default_user_role            // Default role for new users
app.registration_enabled         // Allow new registrations
app.email_verification_required  // Require email verification
app.notifications_enabled        // System notifications
app.file_upload_max_size         // Max upload size (MB)
app.allowed_file_types           // Permitted file extensions
app.backup_frequency             // Backup schedule
app.auto_backup_enabled          // Automatic backup flag
```

## Integration with Filament

### Settings Pages Structure
```
app/Filament/Pages/Settings/
├── System.php      - Organization & system settings
├── Security.php    - Security policies
├── Academic.php    - Academic configuration
└── Application.php - Application settings
```

### Page Implementation Pattern
Each settings page follows this structure:

1. **Dependency Injection**: Settings service injected via `boot()` method
2. **Data Loading**: `mount()` loads current settings into form
3. **Form Schema**: Organized sections with appropriate field types
4. **Save Method**: Validates and saves settings using service methods
5. **Navigation**: Pill-based navigation between setting sections

### Form Organization
```php
Forms\Components\Section::make('Section Title')
    ->description('Section description')
    ->schema([
        // Form fields
    ])->columns(2),

Forms\Components\Actions::make([
    Forms\Components\Actions\Action::make('save')
        ->action(fn() => $this->save())
])
```

## Performance Features

### Caching Strategy
- **Individual Settings**: Cached for 1 hour per setting
- **Group Settings**: Cached collections for efficient group access
- **Cache Keys**: 
  - `setting.{key}` for individual settings
  - `settings.group.{group}` for group collections
- **Auto-Invalidation**: Cache cleared on setting save/delete

### Database Optimization
- Indexed key field for fast lookups
- Composite index on (group, key) for group queries
- Minimal table structure for optimal performance

## Data Seeding

### Default Settings Seeder (`database/seeders/SettingsSeeder.php`)
Populates initial settings with sensible defaults:
- Organization placeholder values
- Standard system configurations
- Common academic settings
- Basic security policies
- Default application settings

**Usage**:
```bash
php artisan db:seed --class=SettingsSeeder
```

## Usage Examples

### Reading Settings
```php
// Using helper function
$schoolName = setting('school.name', 'Default School');
$passingGrade = setting('academic.passing_grade', 60);
$systemConfig = setting()->getSystemSettings();

// Using service directly
$settingsService = app(SettingsService::class);
$academicSettings = $settingsService->getAcademicSettings();
```

### Writing Settings
```php
// Individual setting
setting()->set('new_feature_enabled', true, 'application');

// Batch update
$settingsService->updateSystemSettings([
    'timezone' => 'America/New_York',
    'language' => 'en',
    'currency' => 'USD'
]);
```

### Type Handling
Settings are automatically cast to appropriate types:
```php
setting('academic.attendance_required')  // Returns boolean
setting('academic.passing_grade')        // Returns integer  
setting('academic.grade_scale')          // Returns array (from JSON)
setting('school.name')                   // Returns string
```

## Migration Guide

### From Config Files
```php
// Old way
config('school.name')

// New way (consistent dot notation)
setting('school.name')
```

### From Database Tables
```php
// Old way
SchoolConfig::where('key', 'timezone')->first()->value

// New way
setting('system.timezone', 'UTC')
```

## Best Practices

### 1. Setting Keys
- Use snake_case naming
- Include context in key names
- Group related settings logically

### 2. Default Values
- Always provide sensible defaults
- Use defaults that won't break functionality
- Document expected value types

### 3. Validation
- Validate input in form components
- Use appropriate field types in Filament
- Implement business logic validation in service

### 4. Performance
- Use group getters for related settings
- Leverage caching for frequently accessed settings
- Clear cache only when necessary

### 5. Security
- Set `is_public` appropriately
- Validate sensitive settings server-side
- Use proper field types for passwords/secrets

## File Structure Summary

```
app/
├── Models/Setting.php              # Eloquent model
├── Services/SettingsService.php    # Business logic
├── helpers.php                     # Global helper
└── Filament/Pages/Settings/        # Admin interface
    ├── System.php
    ├── Security.php  
    ├── Academic.php
    └── Application.php

database/
├── migrations/
│   └── *_create_settings_table.php # Database schema
└── seeders/
    └── SettingsSeeder.php          # Default values

resources/views/filament/
├── components/                     # Navigation components  
└── pages/settings/                 # Page templates
```

## Conclusion

This settings system provides a robust, scalable foundation for managing school administration configuration. It combines flexibility with performance, offering both simple key-value access and sophisticated group-based management through a modern admin interface.