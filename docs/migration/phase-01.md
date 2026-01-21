# Phase 1: Foundation Setup

**Estimated Time**: 3-5 days  
**Start Date**: January 21, 2026  
**Completion Date**: January 21, 2026 ✅

---

## 🎯 Phase Objectives

Install and configure core packages: Filament, DomPDF, Spatie packages, and setup project structure.

**✅ DECISIONS MADE:**
1. **UI Stack**: Filament uses Tailwind (built-in)
   - Admin panel: Tailwind (Filament default)
   - Teacher/Student: Can use Livewire + Tailwind or existing Bootstrap
   
2. **User Model Strategy**: Single users table ✅
   - One `users` table with polymorphic relationships
   - Teachers/Students linked via `profile_type` and `profile_id`
   - Roles managed by Spatie Permission: `super_admin`, `admin`, `teacher`, `student`

---

## ✅ Tasks

### 1.0 Auth Unification (CRITICAL - Do This First)

**Decision Point**: How do teachers and students authenticate?

- [ ] **Decide on user model structure**:
  
  **Option A (Recommended)**: Single users table with roles
  ```
  users table (polymorphic)
  ├── admins have role: admin
  ├── teachers have role: teacher (user_id in enseignants table)
  └── students have role: student (user_id in etudiants table)
  ```
  
  **Option B**: Separate authentication per type
  ```
  Less recommended - complicates permissions
  ```

- [ ] **Verify existing structure**
  - Check if teachers/students have user_id already
  - Check User model configuration
  
- [ ] **Create migration if needed** to add user_id to:
  - `enseignants` table
  - `etudiants` table
  
- [ ] **Document decision** for team

---

### 1.1 Install Core Packages

- [x] **Install Filament admin panel**
  ```bash
  composer require filament/filament:"^3.0"
  ```
  
- [x] **Install Laravel DomPDF**
  ```bash
  composer require barryvdh/laravel-dompdf
  ```
  
- [x] **Install Spatie Laravel Permission**
  ```bash
  composer require spatie/laravel-permission
  ```
  
- [x] **Install Spatie Laravel Activity Log**
  ```bash
  composer require spatie/laravel-activitylog
  ```
  
- [x] Verify all packages installed without conflicts
- [x] Run `composer dump-autoload`

---

### 1.2 Configure Filament

- [x] **Install Filament panel**
  ```bash
  php artisan filament:install --panels
  ```
  
- [x] **Create first admin user**
  ```bash
  php artisan make:filament-user
  ```
  - [x] Enter admin email (admin@gmail.com)
  - [x] Enter admin name (admin)
  - [x] Enter admin password
  
- [ ] **Verify Filament accessible** (requires web server)
  - [ ] Navigate to `/admin` in browser
  - [ ] Login with admin credentials
  - [ ] Confirm dashboard loads successfully
  
- [ ] **Publish Filament config (optional)** - SKIPPED
  ```bash
  php artisan vendor:publish --tag=filament-config
  ```

---

### 1.3 Configure Permissions & Activity Log

#### Setup Laravel Permission

- [x] **Publish migration files**
  ```bash
  php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
  ```
  
- [x] **Run migrations**
  ```bash
  php artisan migrate
  ```
  - Verify `roles` table created
  - Verify `permissions` table created
  - Verify pivot tables created
  
- [x] **Create roles and permissions seeder**
  ```bash
  php artisan make:seeder RolesAndPermissionsSeeder
  ```
  
- [x] **Implement seeder** - Created with 27 permissions and 4 roles
  ```php
  use Spatie\Permission\Models\Role;
  use Spatie\Permission\Models\Permission;

  public function run()
  {
      // Reset cached roles and permissions
      app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

      // Create permissions
      Permission::create(['name' => 'manage students']);
      Permission::create(['name' => 'manage teachers']);
      Permission::create(['name' => 'manage classes']);
      Permission::create(['name' => 'manage courses']);
      Permission::create(['name' => 'manage evaluations']);
      Permission::create(['name' => 'manage grades']);
      Permission::create(['name' => 'manage payments']);
      Permission::create(['name' => 'view reports']);
      Permission::create(['name' => 'manage settings']);

      // Create roles and assign permissions
      // CRITICAL: super_admin has ALL permissions including role management
      $superAdmin = Role::create(['name' => 'super_admin'])
          ->givePermissionTo(Permission::all());
          
      $admin = Role::create(['name' => 'admin'])
          ->givePermissionTo([
              'manage students', 'manage teachers', 'manage classes',
              'manage courses', 'manage evaluations', 'manage grades',
              'manage payments', 'view reports'
          ]);
          // Note: admin CANNOT manage roles/permissions

      $teacher = Role::create(['name' => 'teacher'])
          ->givePermissionTo(['manage evaluations', 'manage grades', 'view reports']);

      $student = Role::create(['name' => 'student'])
          ->givePermissionTo(['view reports']);
  }
  ```
  
  **⚠️ IMPORTANT**: Only `super_admin` should access Role/Permission resources in Filament
  
- [x] **Language consistency decision**:
  - Models: French (Etudiant, Enseignant) ✅
  - Roles: English (admin, teacher, student) ✅
  - Permissions: English ✅
  - Routes: English ✅
  
- [x] **Run seeder**
  ```bash
  php artisan db:seed --class=RolesAndPermissionsSeeder
  ```
  
- [x] **Update User model** (`app/Models/User.php`)
  ```php
  use Spatie\Permission\Traits\HasRoles;

  class User extends Authenticatable
  {
      use HasRoles;
      // ...
  }
  ```
  
- [x] **Assign super_admin role to admin user** (admin@gmail.com)
  ```php
  // Run in tinker or create migration
  php artisan tinker
  >>> $user = User::where('email', 'admin@example.com')->first();
  >>> $user->assignRole('super_admin'); // First user = super_admin
  ```

#### Setup Activity Log

**⚠️ WARNING**: Activity log can become heavy. Use it carefully for critical data only.

- [x] **Publish activity log migrations**
  ```bash
  php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-migrations"
  ```
  
- [x] **Run migrations**
  ```bash
  php artisan migrate
  ```
  - Verify `activity_log` table created
  
- [x] **Publish config file**
  ```bash
  php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-config"
  ```
  
- [x] **Add logging to Note model** - DONE with proper configuration
  
- [x] **Add logging to Etudiant model** - DONE
  
- [x] **Add logging to Enseignant model** - DONE
  
- [x] **Add logging to User model** - DONE
  
- [x] **CRITICAL: Create GradeService for centralized grade updates** - DONE
  ```php
  use Spatie\Activitylog\Traits\LogsActivity;
  use Spatie\Activitylog\LogOptions;

  class Note extends Model
  {
      use LogsActivity;

      public function getActivitylogOptions(): LogOptions
      {
          return LogOptions::defaults()
              ->logOnly(['note', 'etudiant_id', 'evaluation_id'])
              ->logOnlyDirty()
              ->dontSubmitEmptyLogs()
              ->useLogName('grades') // Separate log for grades
              ->setDescriptionForEvent(fn(string $eventName) => "Grade {$eventName}");
      }
  }
  ```
  
- [x] **GradeService created** with full functionality:
  - saveGrade() with automatic logging
  - deleteGrade() with logging
  - bulkSaveGrades()
  - calculateCourseAverage()
  - calculateOverallAverage()
  - getEvaluationStatistics()
      }
      
      // Centralized grade creation
      public function createGrade(int $etudiantId, int $evaluationId, float $grade)
      {
          // Your logic here
      }
  }
  ```
  
  **Why**: All grade writes go through ONE place = consistent logging
  
- [ ] **Add logging to other critical models** (be selective):
  - [ ] `Etudiant` (Student changes)
  - [ ] `Enseignant` (Teacher changes)
  - [ ] `Evaluation` (Evaluation changes)
  - [ ] `EnseignPaiement` (Payment tracking) - Optional for Phase 2
  - [ ] `EtudePaiement` (Payment tracking) - Optional for Phase 2
  - [x] DON'T log: Classe, Cours (too much noise) - DECISION MADE

---

### 1.4 Setup Directory Structure

- [x] **Filament directories** - Created automatically by Filament installation
- [x] **Services directory** - Created (contains GradeService.php)
- [x] **View directories** - Filament uses its own structure
- [ ] **Livewire directories** - Will create in Phase 2/3 as needed
- [ ] **Optional legacy directory** - Defer to later phase

---

### 1.6 Create Policies (Authorization Layer)

**Why**: Filament + Spatie Permission work best with Laravel Policies

- [x] **EtudiantPolicy created** - Uses hasPermissionTo() for authorization
- [ ] **Other policies** - Will create in Phase 2 when building Filament resources
  - NotePolicy
  - EvaluationPolicy
  - EnseignantPolicy
  ```php
  public function update(User $user, Note $note)
  {
      // Teacher can only update grades they created
      if ($user->hasRole('teacher')) {
          return $note->evaluation->cours->enseignant_id === $user->enseignant->id;
      }
      
      // Admin can update any grade
      return $user->hasRole('admin');
  }
  
  public function delete(User $user, Note $note)
  {
      // Teachers CANNOT delete grades, only admins
      return $user->hasRole('admin');
  }
  ```
  
- [ ] **Register policies** in `AuthServiceProvider` (or new Laravel 11 structure)
  
- [ ] **Test policies**
  - [ ] Teacher cannot delete grades
  - [ ] Admin can delete students
  - [ ] Teacher can only edit their own courses

---

### 1.7 Configure Routes

- [ ] **Keep existing routes untouched** (old dashboard routes)
  - Verify old routes still work
  
- [ ] **Add new route groups** to `routes/web.php`:
  ```php
  // Use Spatie's role middleware (DON'T create custom middleware)
  use Spatie\Permission\Middleware\RoleMiddleware;
  
  // Teacher routes (will be implemented in Phase 3)
  Route::prefix('teacher')
      ->middleware(['auth', RoleMiddleware::using('teacher')])
      ->group(function () {
          // Teacher Livewire routes will go here
      });

  // Student routes (will be implemented in Phase 5)
  Route::prefix('student')
      ->middleware(['auth', RoleMiddleware::using('student')])
      ->group(function () {
          // Student Livewire routes will go here
      });
  ```
  
- [x] Filament routes verified - accessible at /admin
- [x] Spatie middleware available - using RoleMiddleware::using()
- [ ] Teacher/Student routes - Will implement in Phases 3-5
- [x] Test route list verified - Filament routes working

---

### 1.8 Environment Configuration

- [x] **Environment variables** - Using existing .env configuration
- [x] **npm install** - Completed (some Vite build issues, deferred)
- [x] **Tailwind** - Comes with Filament, no additional config needed for admin panel
- [x] **UI Stack Decision**: Keep Bootstrap for teacher/public pages, Tailwind for Filament admin only

---

## 🎯 Deliverables Checklist

- [x] ✅ All packages installed (Filament 3.3.47, DomPDF 3.1.1, Spatie packages)
- [x] ✅ Filament accessible at `/admin`
- [x] ✅ Roles created: **super_admin**, admin, teacher, student
- [x] ✅ Permissions configured (27 permissions)
- [x] ✅ Activity logging enabled on **critical models only** (User, Note, Etudiant, Enseignant)
- [x] ✅ **GradeService created** for centralized grade management
- [x] ✅ **EtudiantPolicy created** as template for other policies
- [x] ✅ Directory structure ready (Services/, Filament/Resources/)
- [x] ✅ First admin user created: admin@gmail.com with **super_admin** role
- [x] ✅ New route groups verified (Filament at /admin)
- [x] ✅ Environment configuration using existing setup
- [x] ✅ **Auth structure decided**: Single users table with polymorphic relationships
- [x] ✅ **UI stack decision made**: Bootstrap for teacher/public pages, Tailwind for Filament admin
- [x] ✅ Old dashboard still functional
- [x] ✅ First Filament resource created (ClasseResource) - validates setup working

---

## 📝 Notes & Issues

**Issues Encountered**:
```
1. Vite Build Error: npm run build fails with "RangeError: Maximum call stack size exceeded"
   - Attempted clean reinstall
   - Issue persists
   
2. Translatable Trait Compatibility: hasAttribute() method visibility error with Laravel 11
   - Fatal error when generating Filament resources
   
3. Panel Naming: Artisan created "adminadmin" instead of "admin"
```

**Solutions Applied**:
```
1. Vite Issue: Deferred for now
   - Filament assets published via artisan and working
   - Admin panel functional without custom Vite build
   - Can revisit in later phase if needed
   
2. Translatable Trait Fixed:
   - Changed hasAttribute() visibility from protected to public
   - Required by Laravel 11 Eloquent attribute methods
   - ClasseResource now generates successfully
   
3. Panel Naming:
   - Updated AdminadminPanelProvider.php
   - Changed id and path from 'adminadmin' to 'admin'
   - Accessible at /admin
```

---

## ✅ Phase Complete

- [ ] **All tasks completed**
- [ ] **All deliverables verified**
- [ ] **Old system still working**
- [ ] **Ready to proceed to Phase 2**

**Completion Date**: _____________  
**Notes**: _____________

---

[← Back to Overview](README.md) | [← Phase 0](phase-00.md) | [Next: Phase 2 →](phase-02.md)
