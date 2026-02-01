# How User Roles Are Assigned

## Overview
After migrating to Spatie Laravel Permission, roles are now assigned using the `assignRole()` method instead of setting a `role` column.

## Role Assignment by User Type

### 1. Students (Étudiants)

**When Created:**
- Location: [CreateEtudiant.php](app/Filament/Resources/EtudiantResource/Pages/CreateEtudiant.php#L35-L45)
- Role Assigned: `student`
- Trigger: After creating the student record, if email is provided

```php
protected function afterCreate(): void
{
    if (filled($email)) {
        $user = User::create([
            'email' => $email,
            'password' => bcrypt($password),
            'is_active' => $this->data['is_active'] ?? true,
            'profile_type' => \App\Models\Etudiant::class,
            'profile_id' => $this->record->id_etudiant,
        ]);
        
        // Assign student role
        $user->assignRole('student');
    }
}
```

**When Edited:**
- Location: [EditEtudiant.php](app/Filament/Resources/EtudiantResource/Pages/EditEtudiant.php#L70-L76)
- If a user account is created during edit, `student` role is assigned

### 2. Teachers (Enseignants)

**When Created:**
- Location: [CreateEnseignant.php](app/Filament/Resources/EnseignantResource/Pages/CreateEnseignant.php#L13-L23)
- Role Assigned: `teacher`
- Trigger: After the teacher record and associated user are created

```php
protected function afterCreate(): void
{
    $user = User::where('profile_type', \App\Models\Enseignant::class)
        ->where('profile_id', $this->record->id_enseignant)
        ->first();
    
    if ($user && !$user->hasAnyRole(['teacher', 'enseignant'])) {
        $user->assignRole('teacher');
    }
}
```

**When Edited:**
- Location: [EditEnseignant.php](app/Filament/Resources/EnseignantResource/Pages/EditEnseignant.php#L20-L30)
- Ensures the user has the `teacher` role

### 3. Administrators (Administrateurs)

**When Created:**
- Location: [CreateAdministrateur.php](app/Filament/Resources/AdministrateurResource/Pages/CreateAdministrateur.php#L13-L23)
- Role Assigned: `admin` or `super_admin` (from form selection)
- Trigger: After the administrator record is created

```php
protected function afterCreate(): void
{
    $user = User::where('profile_type', \App\Models\Administrateur::class)
        ->where('profile_id', $this->record->id_administrateur)
        ->first();
    
    if ($user) {
        // Assign the role selected in the form
        $roleFromForm = $this->data['user']['role'] ?? 'admin';
        $user->assignRole($roleFromForm);
    }
}
```

**When Edited:**
- Location: [EditAdministrateur.php](app/Filament/Resources/AdministrateurResource/Pages/EditAdministrateur.php#L20-L30)
- Updates the role based on form selection using `syncRoles()`

```php
protected function afterSave(): void
{
    $user = User::where('profile_type', \App\Models\Administrateur::class)
        ->where('profile_id', $this->record->id_administrateur)
        ->first();
    
    if ($user) {
        $roleFromForm = $this->data['user']['role'] ?? 'admin';
        $user->syncRoles([$roleFromForm]); // Removes old roles, assigns new one
    }
}
```

### 4. Legacy Users (From Migration)

**Via Command:**
- Location: [MigrateRolesToSpatie.php](app/Console/Commands/MigrateRolesToSpatie.php)
- Command: `php artisan roles:migrate-to-spatie`
- Migrates existing `users.role` column values to Spatie roles

## Available Roles

Current roles in the system:
- `student` / `etudiant` - Students
- `teacher` / `enseignant` - Teachers  
- `admin` - Regular administrators
- `super_admin` - Super administrators (full access)

## How to Assign Roles Manually

### In Code:

```php
// Assign a single role
$user->assignRole('admin');

// Assign multiple roles
$user->assignRole(['admin', 'teacher']);

// Remove all other roles and assign new one(s)
$user->syncRoles(['super_admin']);

// Remove a role
$user->removeRole('admin');
```

### In Database Seeder:

```php
use Spatie\Permission\Models\Role;

// Create roles if they don't exist
Role::firstOrCreate(['name' => 'student']);
Role::firstOrCreate(['name' => 'teacher']);
Role::firstOrCreate(['name' => 'admin']);
Role::firstOrCreate(['name' => 'super_admin']);

// Assign to user
$user = User::find(1);
$user->assignRole('super_admin');
```

### Via Tinker:

```bash
php artisan tinker

# Find user
$user = User::where('email', 'admin@ecole.com')->first();

# Assign role
$user->assignRole('super_admin');

# Check roles
$user->getRoleNames(); // Collection ['super_admin']

# Check if has role
$user->hasRole('admin'); // true/false
```

## Checking Roles in Code

### In Controllers:

```php
// Check single role
if (auth()->user()->hasRole('admin')) {
    // ...
}

// Check multiple roles (has ANY of these)
if (auth()->user()->hasAnyRole(['admin', 'super_admin'])) {
    // ...
}

// Check multiple roles (has ALL of these)
if (auth()->user()->hasAllRoles(['admin', 'writer'])) {
    // ...
}
```

### In Blade Templates:

```blade
@role('admin')
    <p>You are an admin</p>
@endrole

@hasrole('super_admin')
    <p>Super admin content</p>
@endhasrole

@hasanyrole(['admin', 'super_admin'])
    <p>Admin or super admin</p>
@endhasanyrole
```

### In Middleware:

Already implemented in:
- `RequireSuperAdmin` - Checks for `super_admin` role
- `RoleMiddleware` - Flexible role checking

## Database Structure

Spatie stores roles in these tables:

- `roles` - List of all roles
- `model_has_roles` - Junction table linking users to roles
  - `role_id`
  - `model_type` (e.g., "App\Models\User")
  - `model_id` (user ID)

## Troubleshooting

### User has no role after creation:
1. Check that `afterCreate()` or `afterSave()` hooks are defined in the Create/Edit page
2. Verify the role exists: `Role::where('name', 'student')->exists()`
3. Check for errors in logs: `storage/logs/laravel.log`

### Role not updating:
- Use `syncRoles()` instead of `assignRole()` in edit operations to replace roles
- Clear cache: `php artisan cache:clear`

### Permission denied errors:
- Ensure user has been assigned a role: `$user->getRoleNames()`
- Check role spelling is consistent
- Verify middleware is using `hasRole()` not the old `$user->role` column

## Best Practices

1. **Always assign roles after user creation** - Use `afterCreate()` hooks
2. **Use syncRoles() for updates** - Prevents duplicate role assignments
3. **Check role existence** - Use `!$user->hasAnyRole()` before assigning
4. **Use hasRole() consistently** - Never check `$user->role` anymore
5. **Create roles in seeders** - Ensure all required roles exist before assignment

## Related Files

- [User Model](app/Models/User.php) - Uses `HasRoles` trait
- [Role Migration Guide](ROLE_MIGRATION_GUIDE.md) - Full migration documentation
- [Spatie Docs](https://spatie.be/docs/laravel-permission) - Official documentation
