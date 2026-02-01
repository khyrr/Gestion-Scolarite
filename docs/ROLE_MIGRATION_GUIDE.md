# Migration from users.role to Spatie Laravel Permission

## Overview
This migration removes the redundant `role` column from the `users` table and migrates all role data to Spatie's `laravel-permission` package.

## Migration Steps

### 1. Run the Migration Command

First, migrate existing role data to Spatie roles:

```bash
php artisan roles:migrate-to-spatie
```

This command will:
- Find all users with a `role` value
- Create the role in Spatie if it doesn't exist
- Assign the role to the user using `assignRole()`
- Skip users who already have the role assigned

### 2. Run the Database Migration

After successfully migrating the data, drop the redundant `role` column:

```bash
php artisan migrate
```

This will execute the `2026_01_22_210000_drop_role_column_from_users.php` migration.

## Code Changes Summary

### User Model (`app/Models/User.php`)

**Removed:**
- `'role'` from `$fillable` array
- Custom `hasRole()` method (now provided by Spatie)
- Custom `hasAnyRole()` method (now provided by Spatie)

**Updated Methods:**
- `isAdmin()`: Now uses `$this->hasAnyRole(['admin', 'super_admin'])`
- `isTeacher()`: Now uses `$this->hasAnyRole(['teacher', 'enseignant'])`
- `isStudent()`: Now uses `$this->hasAnyRole(['student', 'etudiant'])`
- `scopeRole()`: Now uses Spatie's `role()` scope
- `getAdmins()`: Now uses `self::role('admin')`

### Middleware Updates

**RequireSuperAdmin** (`app/Http/Middleware/RequireSuperAdmin.php`):
- Changed: `$user->role !== 'super_admin'` → `!$user->hasRole('super_admin')`
- Uses `$user->getRoleNames()->first()` for logging

**RequireTwoFactor** (`app/Http/Middleware/RequireTwoFactor.php`):
- Changed: `$user->role === 'super_admin'` → `$user->hasRole('super_admin')`

**RoleMiddleware** (`app/Http/Middleware/RoleMiddleware.php`):
- Changed: `$user->role` → `$user->getRoleNames()->implode(', ')`
- Updated redirect logic to use `hasAnyRole()`

### Controller Updates

**AdminManagementController**:
```php
// Before
'role' => $request->role,

// After
$user = User::create([...]);
if ($request->role) {
    $user->assignRole($request->role);
}
```

**LoginController**:
```php
// Before
switch ($user->role) {
    case 'admin':
        return route('admin.dashboard');
}

// After
if ($user->hasAnyRole(['super_admin', 'admin'])) {
    return route('admin.dashboard');
}
```

**HomeController**, **ActivityLogController**, **TwoFactorController**:
- All updated to use `hasRole()` or `hasAnyRole()`

### View Updates

**admin/users/index.blade.php**:
```blade
{{-- Before --}}
<td>{{ __('app.' . $a->role) }}</td>

{{-- After --}}
<td>{{ $a->getRoleNames()->first() ? __('app.' . $a->getRoleNames()->first()) : '-' }}</td>
```

**admin/dashboard.blade.php**:
```blade
{{-- Before --}}
@if(auth()->user()->role === 'super_admin')

{{-- After --}}
@if(auth()->user()->hasRole('super_admin'))
```

**admin/academic/cours/spectacle.blade.php**:
```javascript
// Before
const isAdmin = @json(auth()->user()->role === 'admin');

// After
const isAdmin = @json(auth()->user()->hasRole('admin'));
```

## Spatie Methods Reference

### Check if user has a specific role:
```php
$user->hasRole('admin');
$user->hasRole(['admin', 'super_admin']); // has ANY of these roles
```

### Check if user has all roles:
```php
$user->hasAllRoles(['admin', 'writer']);
```

### Check if user has any role:
```php
$user->hasAnyRole(['admin', 'super_admin']);
```

### Assign/Remove roles:
```php
$user->assignRole('admin');
$user->removeRole('admin');
$user->syncRoles(['admin', 'super_admin']); // Remove all other roles
```

### Get user roles:
```php
$user->getRoleNames(); // Collection of role names
$user->roles; // Collection of Role models
```

### Query users by role:
```php
User::role('admin')->get();
User::role(['admin', 'super_admin'])->get();
```

### In Blade templates:
```blade
@role('admin')
    {{-- User has admin role --}}
@endrole

@hasrole('admin')
    {{-- User has admin role --}}
@endhasrole

@hasanyrole(['admin', 'super_admin'])
    {{-- User has any of these roles --}}
@endhasanyrole
```

## Testing Checklist

- [ ] Run `php artisan roles:migrate-to-spatie`
- [ ] Verify all users have correct Spatie roles assigned
- [ ] Run `php artisan migrate` to drop role column
- [ ] Test login redirects for each role type
- [ ] Test admin access restrictions
- [ ] Test super_admin only features (IP security, admin management)
- [ ] Test 2FA flow for super_admin vs regular admin
- [ ] Test role display in admin users list
- [ ] Test course schedule admin check
- [ ] Test dashboard recent activity visibility

## Rollback

If you need to rollback:

```bash
php artisan migrate:rollback
```

This will restore the `role` column. You'll need to manually populate it from Spatie roles if needed.

## Benefits

1. **Single Source of Truth**: Roles are only in `model_has_roles` table
2. **Permissions Support**: Can now use Spatie's permission system
3. **Role Inheritance**: Super admins can inherit admin permissions
4. **Flexibility**: Easy to add/modify roles without schema changes
5. **Consistency**: All role checks use the same Spatie methods
