# Phase 1: Foundation Setup

**Estimated Time**: 5-7 days (Week 1)  
**Start Date**: _____________  
**Completion Date**: _____________

---

## 🎯 Phase Objectives

Install and configure core packages: Filament, DomPDF, Spatie packages, and setup project structure.

**⚠️ CRITICAL DECISIONS:**
1. **UI Stack**: Filament forces Tailwind. Your existing app uses Bootstrap.
   - **Recommendation**: Keep existing Bootstrap pages as-is for now
   - Teacher dashboard: Use **Bootstrap + Livewire** (fastest, consistent with existing)
   - Only admin panel uses Tailwind (Filament)
   - Avoid mixing 2 CSS frameworks in same interface

2. **User Model Strategy**: Define auth structure before building
   - One `users` table for all
   - Teachers/Students have `user_id` (recommended)
   - Roles: `admin`, `teacher`, `student`, `super_admin`

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

- [ ] **Install Filament admin panel**
  ```bash
  composer require filament/filament:"^3.0"
  ```
  
- [ ] **Install Laravel DomPDF**
  ```bash
  composer require barryvdh/laravel-dompdf
  ```
  
- [ ] **Install Spatie Laravel Permission**
  ```bash
  composer require spatie/laravel-permission
  ```
  
- [ ] **Install Spatie Laravel Activity Log**
  ```bash
  composer require spatie/laravel-activitylog
  ```
  
- [ ] Verify all packages installed without conflicts
- [ ] Run `composer dump-autoload`

---

### 1.2 Configure Filament

- [ ] **Install Filament panel**
  ```bash
  php artisan filament:install --panels
  ```
  
- [ ] **Create first admin user**
  ```bash
  php artisan make:filament-user
  ```
  - [ ] Enter admin email
  - [ ] Enter admin name
  - [ ] Enter admin password
  
- [ ] **Verify Filament accessible**
  - [ ] Navigate to `/admin` in browser
  - [ ] Login with admin credentials
  - [ ] Confirm dashboard loads successfully
  
- [ ] **Publish Filament config (optional)**
  ```bash
  php artisan vendor:publish --tag=filament-config
  ```

---

### 1.3 Configure Permissions & Activity Log

#### Setup Laravel Permission

- [ ] **Publish migration files**
  ```bash
  php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
  ```
  
- [ ] **Run migrations**
  ```bash
  php artisan migrate
  ```
  - Verify `roles` table created
  - Verify `permissions` table created
  - Verify pivot tables created
  
- [ ] **Create roles and permissions seeder**
  ```bash
  php artisan make:seeder RolesAndPermissionsSeeder
  ```
  
- [ ] **Implement seeder** (`database/seeders/RolesAndPermissionsSeeder.php`)
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
  
- [ ] **Language consistency decision**:
  - Models: French (Etudiant, Enseignant) ✅
  - Roles: English (admin, teacher, student) ✅
  - Permissions: English ✅
  - Routes: English ✅
  
- [ ] **Run seeder**
  ```bash
  php artisan db:seed --class=RolesAndPermissionsSeeder
  ```
  
- [ ] **Update User model** (`app/Models/User.php`)
  ```php
  use Spatie\Permission\Traits\HasRoles;

  class User extends Authenticatable
  {
      use HasRoles;
      // ...
  }
  ```
  
- [ ] **Assign admin role to your admin user**
  ```php
  // Run in tinker or create migration
  php artisan tinker
  >>> $user = User::where('email', 'admin@example.com')->first();
  >>> $user->assignRole('super_admin'); // First user = super_admin
  ```

#### Setup Activity Log

**⚠️ WARNING**: Activity log can become heavy. Use it carefully for critical data only.

- [ ] **Publish activity log migrations**
  ```bash
  php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-migrations"
  ```
  
- [ ] **Run migrations**
  ```bash
  php artisan migrate
  ```
  - Verify `activity_log` table created
  
- [ ] **Publish config file**
  ```bash
  php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-config"
  ```
  
- [ ] **Add logging to Note model** (`app/Models/Note.php`)
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
  
- [ ] **CRITICAL: Create GradeService for centralized grade updates**
  ```bash
  mkdir -p app/Services
  touch app/Services/GradeService.php
  ```
  
  ```php
  // app/Services/GradeService.php
  namespace App\Services;
  
  use App\Models\Note;
  use App\Models\Etudiant;
  use App\Models\Evaluation;
  
  class GradeService
  {
      public function updateGrade(int $noteId, float $newGrade, ?string $comment = null)
      {
          $note = Note::findOrFail($noteId);
          
          // Validation
          if ($newGrade > $note->evaluation->note_max) {
              throw new \Exception('Grade exceeds maximum');
          }
          
          // Update (activity log will capture this automatically)
          $note->update([
              'note' => $newGrade,
              'commentaire' => $comment,
          ]);
          
          return $note;
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
  - [ ] `EnseignPaiement` (Payment tracking)
  - [ ] `EtudePaiement` (Payment tracking)
  - [ ] DON'T log: Classe, Cours (too much noise)

---

### 1.4 Setup Directory Structure

- [ ] **Create Filament directories**
  ```bash
  mkdir -p app/Filament/Resources
  mkdir -p app/Filament/Pages
  mkdir -p app/Filament/Widgets
  ```
  
- [ ] **Create Livewire directories**
  ```bash
  mkdir -p app/Livewire/Teacher
  mkdir -p app/Livewire/Student
  mkdir -p app/Livewire/Public
  ```
  
- [ ] **Create Services directory**
  ```bash
  mkdir -p app/Services
  ```
  
- [ ] **Create view directories**
  ```bash
  mkdir -p resources/views/filament
  mkdir -p resources/views/livewire/teacher
  mkdir -p resources/views/livewire/student
  mkdir -p resources/views/livewire/public
  mkdir -p resources/views/pdf
  mkdir -p resources/views/layouts
  ```
  
- [ ] **Optional: Create legacy directory** (for old views reference)
  ```bash
  mkdir -p resources/views/legacy
  ```

---

### 1.6 Create Policies (Authorization Layer)

**Why**: Filament + Spatie Permission work best with Laravel Policies

- [ ] **Generate policies for key models**
  ```bash
  php artisan make:policy EtudiantPolicy --model=Etudiant
  php artisan make:policy NotePolicy --model=Note
  php artisan make:policy EvaluationPolicy --model=Evaluation
  php artisan make:policy EnseignantPolicy --model=Enseignant
  ```
  
- [ ] **Implement policy example** (`app/Policies/NotePolicy.php`)
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
  
  **Note**: Using Spatie's middleware instead of custom `EnsureIsTeacher`
  
- [ ] Verify no route conflicts between old and new routes
- [ ] Test route list:
  ```bash
  php artisan route:list | grep -E "(admin|teacher|student)"
  ```

---

### 1.8 Environment Configuration

- [ ] **Add environment variables** to `.env`:
  ```env
  FILAMENT_ADMIN_URL=/admin
  
  # PDF Config (these need to be coded into PdfService, not auto-used)
  PDF_PAPER_SIZE=a4
  PDF_ORIENTATION=portrait
  ```
  
  **Note**: Dompdf doesn't auto-read these. You'll code them in Phase 4.
  
- [ ] **Install frontend dependencies**:
  ```bash
  npm install
  # Only install Tailwind for Filament admin panel
  npm install -D tailwindcss @tailwindcss/forms @tailwindcss/typography
  npm install -D alpinejs
  ```
  
  **⚠️ UI Stack Decision Point**:
  - **Option A (Recommended)**: Keep Bootstrap for teacher/public pages
    - Faster development
    - Consistent with existing design
    - Only Filament admin uses Tailwind
    
  - **Option B**: Migrate everything to Tailwind
    - Modern but slower
    - Need to redesign all UI
    - More initial work
  
- [ ] **Update tailwind.config.js** (for Filament only):
  ```javascript
  export default {
    content: [
      './app/Filament/**/*.php',
      './vendor/filament/**/*.blade.php',
      // DON'T include teacher/student views if using Bootstrap there
    ],
    theme: {
      extend: {},
    },
    plugins: [
      require('@tailwindcss/forms'),
      require('@tailwindcss/typography'),
    ],
  }
  ```

---

## 🎯 Deliverables Checklist

- [ ] ✅ All packages installed (Filament, DomPDF, Spatie packages)
- [ ] ✅ Filament accessible at `/admin`
- [ ] ✅ Roles created: **super_admin**, admin, teacher, student
- [ ] ✅ Permissions configured (9 permissions)
- [ ] ✅ Activity logging enabled on **critical models only** (Note, Etudiant, Enseignant, Payments)
- [ ] ✅ **GradeService created** for centralized grade management
- [ ] ✅ **Policies created** for authorization
- [ ] ✅ Directory structure ready
- [ ] ✅ First admin user created with **super_admin** role
- [ ] ✅ New route groups added (using Spatie middleware)
- [ ] ✅ Environment variables configured
- [ ] ✅ **Auth structure decided and documented**
- [ ] ✅ **UI stack decision made** (Bootstrap vs Tailwind for teacher pages)
- [ ] ✅ Old dashboard still functional

---

## 📝 Notes & Issues

**Issues Encountered**:
```
(Document any issues here)
```

**Solutions Applied**:
```
(Document solutions here)
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
