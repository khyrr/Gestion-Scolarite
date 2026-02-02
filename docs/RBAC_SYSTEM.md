# Role-Based Access Control (RBAC) System

## Overview

This school management system implements a comprehensive role-based access control system with 7 distinct roles and 55+ granular permissions.

## Roles Definition

### 1. **Super Admin** (`super_admin`)
- **Purpose**: Full system administration and configuration
- **Users**: System administrators, IT support
- **Access**: Complete system access including user management, roles, permissions, and system settings
- **Login**: admin@ecole.com

### 2. **Director** (`director`) 
- **Purpose**: Overall school management and academic oversight
- **Users**: School director, principal
- **Access**: Full academic and administrative management, financial oversight, all reports
- **Restrictions**: Cannot manage system settings or user roles
- **Login**: directeur@ecole.com

### 3. **Academic Coordinator** (`academic_coordinator`)
- **Purpose**: Academic program management and curriculum oversight
- **Users**: Academic coordinators, curriculum supervisors
- **Access**: Classes, subjects, courses, schedules, evaluations, academic reports
- **Restrictions**: Limited student/teacher management, no financial access
- **Login**: coordinatrice@ecole.com

### 4. **Teacher** (`teacher`)
- **Purpose**: Classroom teaching and student assessment
- **Users**: Teaching staff
- **Access**: Their assigned classes, create evaluations, grade students, view academic progress
- **Restrictions**: Can only access their own classes and subjects
- **Login**: Individual teacher emails (e.g., enseignant1@ecole.com)

### 5. **Secretary** (`secretary`)
- **Purpose**: Administrative support and student registration
- **Users**: Administrative staff, registrars
- **Access**: Student/teacher registration, basic information management, payment processing
- **Restrictions**: No academic content management, limited reporting
- **Login**: secretaire@ecole.com

### 6. **Accountant** (`accountant`)
- **Purpose**: Financial management and payment processing
- **Users**: Finance staff, accountants
- **Access**: Payment management, financial reports, student/teacher financial data
- **Restrictions**: No academic content access
- **Login**: comptable@ecole.com

### 7. **Student** (`student`)
- **Purpose**: Self-service access to academic information
- **Users**: Students
- **Access**: View own grades, courses, and academic progress
- **Restrictions**: Read-only access to personal data only
- **Login**: Individual student emails

## Permission Structure

Permissions are organized by resource and action type:

### Student Management
- `view students` - View student information
- `create students` - Register new students
- `edit students` - Update student information
- `delete students` - Remove students
- `manage student accounts` - Handle student user accounts
- `view student grades` - Access grade information
- `export student data` - Export student reports

### Teacher Management
- `view teachers` - View teacher information
- `create teachers` - Register new teachers
- `edit teachers` - Update teacher information
- `delete teachers` - Remove teachers
- `manage teacher accounts` - Handle teacher user accounts
- `assign teacher subjects` - Assign subjects to teachers

### Academic Management
- `view/create/edit/delete classes` - Class management
- `manage class assignments` - Student-class assignments
- `view/create/edit/delete subjects` - Subject management
- `view/create/edit/delete courses` - Course scheduling
- `manage timetables` - Schedule management

### Assessment Management
- `view/create/edit/delete evaluations` - Assessment management
- `view all evaluations` - Access all assessments
- `view/create/edit/delete grades` - Grade management
- `view all grades` - Access all grades
- `edit grade comments` - Modify grade feedback

### Financial Management
- `view/create/edit/delete payments` - Payment processing
- `manage financial reports` - Financial analytics

### Reporting & Analytics
- `view reports` - Access reports
- `generate reports` - Create custom reports
- `export data` - Data export capabilities
- `view statistics` - Analytics dashboard

### System Administration
- `manage users` - User account management
- `manage roles` - Role assignment
- `manage permissions` - Permission management
- `view activity logs` - System monitoring
- `manage system settings` - System configuration
- `backup database` - Data backup

## Role-Permission Matrix

| Permission Category | Super Admin | Director | Coordinator | Teacher | Secretary | Accountant | Student |
|-------------------|-------------|----------|-------------|---------|-----------|------------|---------|
| Student Management | ✅ All | ✅ All | ✅ View/Edit | ✅ View (own classes) | ✅ Basic CRUD | ✅ View | ❌ |
| Teacher Management | ✅ All | ✅ All | ✅ View/Assign | ❌ | ✅ Basic CRUD | ✅ View | ❌ |
| Academic Content | ✅ All | ✅ All | ✅ All | ✅ View (own subjects) | ✅ View | ❌ | ✅ View (own) |
| Assessment | ✅ All | ✅ All | ✅ View/Create | ✅ Full (own) | ❌ | ❌ | ✅ View (own) |
| Grades | ✅ All | ✅ All | ✅ View | ✅ Full (own) | ❌ | ❌ | ✅ View (own) |
| Financial | ✅ All | ✅ All | ❌ | ❌ | ✅ Basic | ✅ All | ❌ |
| Reports | ✅ All | ✅ All | ✅ Academic | ✅ Basic | ✅ Basic | ✅ Financial | ❌ |
| System Admin | ✅ All | ❌ | ❌ | ❌ | ❌ | ❌ | ❌ |

## Policy Implementation

### Student-Specific Access
- Students can only view their own grades, courses, and information
- Teachers can only access students in their assigned classes
- Admins have full student management access

### Teacher-Specific Access  
- Teachers can only create/edit evaluations for subjects they teach
- Teachers can only grade students in their assigned classes
- Academic coordinators can assign subjects to teachers

### Multi-tenancy Features
- Role-based filtering in all Filament resources
- Automatic context filtering based on user role
- Permission-based navigation menu visibility

## Security Features

### Middleware Protection
- `EnsureAdminRole`: Protects admin panel access
- `EnsureTeacherRole`: Protects teacher-specific features
- Automatic policy enforcement on all models

### Data Privacy
- Students only see their own data
- Teachers only access their assigned classes
- Financial data restricted to appropriate roles

## Usage Examples

### Checking Permissions in Code
```php
// In controllers
if (!auth()->user()->can('create', Student::class)) {
    abort(403);
}

// In Blade templates
@can('view students')
    <a href="{{ route('students.index') }}">View Students</a>
@endcan

// In policies
public function view(User $user, Student $student): bool
{
    return $user->hasPermissionTo('view students');
}
```

### Filament Resource Authorization
```php
// In Filament resources
public static function canViewAny(): bool
{
    return auth()->user()->can('viewAny', static::getModel());
}

protected function getTableQuery(): Builder
{
    return parent::getTableQuery()->when(
        auth()->user()->hasRole('teacher'),
        fn($query) => $query->whereIn('classe_id', $this->getTeacherClasses())
    );
}
```

## Migration and Seeding

Run the following commands to set up the role-based system:

```bash
# Fresh database with roles and permissions
php artisan migrate:fresh
php artisan db:seed

# Or update existing database
php artisan db:seed --class=RolesAndPermissionsSeeder
php artisan db:seed --class=AdministrateursSeeder
```

## Test Accounts

| Role | Email | Password | Access Level |
|------|-------|----------|--------------|
| Super Admin | admin@ecole.com | password123 | Full system |
| Director | directeur@ecole.com | password123 | Academic + Admin |
| Coordinator | coordinatrice@ecole.com | password123 | Academic |
| Secretary | secretaire@ecole.com | password123 | Administrative |
| Accountant | comptable@ecole.com | password123 | Financial |
| Teachers | enseignant1@ecole.com | password123 | Teaching |
| Students | Individual emails | password123 | Self-service |

This role-based system ensures secure, appropriate access to school management features while maintaining flexibility for different organizational needs.