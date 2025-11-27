# Security Implementation Plan - Gestion Scolaire

## 🔴 CRITICAL PRIORITY (Implement First)

### 1. Separate Admin Authentication System
**Why Critical:** Prevents unauthorized access to sensitive school data and administrative functions.

**Implementation:**
- [x] Create `/admin/login` route (separate from teacher login)
- [x] Create `AdminController` for admin authentication
- [x] Design admin login view (distinct from teacher login)
- [x] Create `admin` authentication guard in `config/auth.php`
- [x] Update `Administrateur` model to use new guard
- [x] Add `AdminMiddleware` to verify admin role (Implemented via `auth:admin` guard)

**Files to Create/Modify:**
```
routes/web.php
app/Http/Controllers/Admin/AdminAuthController.php
app/Http/Middleware/AdminMiddleware.php
config/auth.php
resources/views/admin/auth/login.blade.php
```

**Estimated Time:** 2-3 hours

---

### 2. IP Whitelist Security
**Why Critical:** Protects admin panel from unauthorized access outside school network.

**Implementation:**
- [x] Create `IpWhitelistMiddleware`
- [x] Add IP configuration in `config/admin.php`
- [x] Make reject status configurable (403 vs 404) so the admin endpoint can be hidden when desired
- [x] Store allowed IPs in database table `admin_allowed_ips`
- [x] Create admin interface to manage allowed IPs
- [x] Add IP check before admin authentication
- [x] Log all blocked IP attempts
- [x] Add automated tests to verify whitelist behavior (allowed IP, reject 403, hide with 404)

**Files to Create/Modify:**
```
app/Http/Middleware/IpWhitelistMiddleware.php
config/admin.php
tests/Feature/IpWhitelistMiddlewareTest.php
database/migrations/2025_11_24_200124_create_admin_allowed_ips_table.php
app/Models/AdminAllowedIp.php
resources/views/admin/settings/ip_whitelist.blade.php
```

**Configuration Example:**
```php
// config/admin.php
'security' => [
    'ip_whitelist_enabled' => env('ADMIN_IP_WHITELIST_ENABLED', true),
    'default_allowed_ips' => [
        '127.0.0.1',          // Localhost
        '::1',                // IPv6 localhost
        '192.168.1.0/24',     // School local network
    ],
],
```

**Estimated Time:** 3-4 hours

---

### 3. Disable Admin Registration
**Why Critical:** Admins should only be created internally, never through public registration.

**Implementation:**
- [x] Remove admin registration routes
- [x] Create database seeder for default admin account
- [x] Add admin creation command: `php artisan admin:create`
- [x] Add admin management interface (admins can create other admins)
- [x] Ensure registration routes only work for teachers

**Files to Create/Modify:**
```
routes/web.php (remove admin register routes)
database/seeders/AdminSeeder.php
app/Console/Commands/CreateAdminCommand.php
app/Http/Controllers/Admin/AdminManagementController.php
resources/views/admin/users/create-admin.blade.php
```

**Default Admin Seeder:**
```php
// database/seeders/AdminSeeder.php
DB::table('administrateurs')->insert([
    'nom' => 'Super Admin',
    'email' => 'admin@school.local',
    'password' => Hash::make('change-me-immediately'),
    'role' => 'super_admin',
    'created_at' => now(),
]);
```

**Estimated Time:** 2-3 hours

---

### 4. Role-Based Authentication Guards
**Why Critical:** Separates authentication logic for different user types (admin, teacher).

**Implementation:**
- [ ] Update models to use correct guard (administrators already use `admin` guard; moving teachers to a dedicated model is still pending)
- [ ] Separate session storage for each guard
- [ ] Different login/logout flows per role

Progress updates:
- [x] Configure multiple guards in `config/auth.php` (added `teacher` guard + `teachers` provider mapping to `App\Models\Enseignant`)
- [x] Create separate middleware for teacher role (`app/Http/Middleware/TeacherMiddleware.php` and alias `auth.teacher` in Kernel)
- [x] Update models to use correct guard (Enseignant is now Authenticatable and used as `teachers` provider)
    - [x] Separate session storage for each guard (implemented via `SetSessionCookieByGuard` middleware, separate cookies for admin/teacher)
- [x] Different login/logout flows per role (LoginController/RegisterController now operate as teacher auth endpoints)

**Files to Modify:**
```
config/auth.php
app/Http/Middleware/AdminMiddleware.php
app/Http/Middleware/TeacherMiddleware.php
app/Models/Administrateur.php
app/Models/Enseignant.php
```

**Guard Configuration:**
```php
// config/auth.php
'guards' => [
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
    'teacher' => [
        'driver' => 'session',
        'provider' => 'teachers',
    ],
    // Student guard can be added later when portal is implemented
],

'providers' => [
    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Administrateur::class,
    ],
    'teachers' => [
        'driver' => 'eloquent',
        'model' => App\Models\Enseignant::class,
    ],
],
```

**Estimated Time:** 2-3 hours

---

## 🟠 HIGH PRIORITY (Implement Second)

### 5. Login Attempt Limiting
**Why Important:** Prevents brute force attacks on admin and teacher accounts.

**Implementation:**
    - [x] Install/configure Laravel rate limiting (configured via controllers)
    - [x] Set admin login limit: 3 attempts per 15 minutes
    - [x] Set teacher login limit: 5 attempts per 10 minutes
    - [ ] Add CAPTCHA after 2 failed attempts
    - [ ] Email notification on repeated failures
    - [ ] Temporary account lock after limit exceeded

**Files to Create/Modify:**
```
app/Http/Controllers/Auth/LoginController.php
app/Http/Controllers/Admin/AdminAuthController.php
tests/Feature/AdminLoginThrottleTest.php
tests/Feature/TeacherLoginThrottleTest.php
config/auth.php
resources/views/auth/login.blade.php (add CAPTCHA)
```

**Estimated Time:** 2-3 hours

---

### 6. Two-Factor Authentication (2FA) for Admin
**Why Important:** Adds critical extra layer of security for administrative access.

**Implementation:**
    - [x] Implement minimal TOTP helper and internal verification (TwoFactorService)
    - [x] Add `two_factor_secret`, `two_factor_enabled` and recovery code columns to `administrateurs` via migration
    - [x] Create 2FA setup interface and challenge routes/controllers
    - [x] Generate provisioning URI for authenticator apps (QR generation remains optional)
    - [x] Add 2FA verification step after password and session flagging
    - [x] Backup codes generation and simple consumption flow implemented

**Files to Create/Modify:**
```
database/migrations/2025_11_25_210000_add_two_factor_to_administrateurs_table.php
app/Services/TwoFactorService.php
app/Http/Controllers/Admin/TwoFactorController.php
app/Http/Middleware/RequireTwoFactor.php
resources/views/admin/auth/2fa/setup.blade.php
resources/views/admin/auth/2fa/challenge.blade.php
tests/Feature/AdminTwoFactorTest.php
```

**Estimated Time:** 4-5 hours

---

### 7. Activity Logging & Audit Trail
**Why Important:** Track all sensitive operations for security and accountability.

**Implementation:**
    - [x] Create `activity_logs` table
    - [x] Log all admin actions (create, update, delete) — implemented for create
    - [x] Log authentication events (login, logout, failed attempts)
    - [ ] Log IP changes and new device logins (future enhancement)
    - [x] Create activity log viewer interface (admin UI: index, filtering, pagination, export)
    - [x] Export logs to CSV (permissioned to super_admin; PDF export optional later)

Planned next steps (short-term):
    - [x] Admin UI: add `Admin/ActivityLogController` + routes and views for listing logs
    - [x] Index page: filtering (user_type, action, date range), pagination, and simple search
    - [x] Export: CSV export implemented
    - [x] Permissions: ensured only `super_admin` can view/export logs
    - [x] Tests: added feature tests for listing, filtering, and export

**Files to Create/Modify:**
```
database/migrations/2025_11_25_230000_create_activity_logs_table.php
app/Models/ActivityLog.php
app/Services/ActivityLogger.php
tests/Feature/ActivityLogTest.php
```

**Log Table Structure:**
```php
Schema::create('activity_logs', function (Blueprint $table) {
    $table->id();
    $table->string('user_type'); // admin, teacher (student in future)
    $table->unsignedBigInteger('user_id');
    $table->string('action'); // login, create, update, delete
    $table->string('resource')->nullable(); // classe, etudiant, note
    $table->unsignedBigInteger('resource_id')->nullable();
    $table->text('description');
    $table->json('changes')->nullable(); // before/after data
    $table->ipAddress('ip_address');
    $table->text('user_agent');
    $table->timestamps();
});
```

**Estimated Time:** 4-5 hours

---

### 8. Teacher Account Approval Workflow
**Why Important:** Ensures only legitimate teachers can access the system.

**Implementation:**
- [ ] Add `status` column to `enseignants` table (pending, approved, rejected)
- [ ] Teachers register but cannot login until approved
- [ ] Email notification to admin when teacher registers
- [ ] Admin approval interface
- [ ] Email notification to teacher on approval/rejection
- [ ] Reject with reason functionality

**Files to Create/Modify:**
```
database/migrations/xxxx_add_status_to_enseignants.php
app/Models/Enseignant.php
app/Http/Controllers/Admin/TeacherApprovalController.php
app/Notifications/TeacherRegisteredNotification.php
app/Notifications/TeacherApprovedNotification.php
resources/views/admin/teachers/approvals.blade.php
resources/views/emails/teacher-approval.blade.php
```

**Estimated Time:** 3-4 hours

---

## 🟡 MEDIUM PRIORITY (Implement Third)

### 9. Session Security & Management
**Why Important:** Prevents session hijacking and unauthorized access.

**Implementation:**
- [ ] Different session lifetime for each role
- [ ] Admin sessions: 30 minutes idle timeout
- [ ] Teacher sessions: 2 hours idle timeout
- [ ] Force logout on password change
- [ ] Concurrent session limiting (1 active session per user)
- [ ] Session management dashboard
- [ ] Remote session termination

**Files to Modify:**
```
config/session.php
app/Http/Middleware/SessionTimeout.php
app/Http/Controllers/Admin/SessionController.php
resources/views/admin/settings/sessions.blade.php
```

**Estimated Time:** 3-4 hours

---

### 10. Email Notifications for Security Events
**Why Important:** Keeps administrators informed of security-related activities.

**Implementation:**
- [ ] Email on admin login from new IP
- [ ] Email on admin login from new device
- [ ] Email on multiple failed login attempts
- [ ] Email on password change
- [ ] Email on 2FA disable/enable
- [ ] Daily security summary email

**Files to Create:**
```
app/Notifications/NewIpLoginNotification.php
app/Notifications/NewDeviceLoginNotification.php
app/Notifications/FailedLoginAttemptsNotification.php
app/Notifications/PasswordChangedNotification.php
app/Notifications/SecuritySummaryNotification.php
```

**Estimated Time:** 2-3 hours

---

### 11. Password Security Policies
**Why Important:** Ensures strong passwords across all user types.

**Implementation:**
- [ ] Minimum password length: 12 characters for admin, 8 for teachers
- [ ] Require: uppercase, lowercase, number, special character
- [ ] Password history (prevent reusing last 5 passwords)
- [ ] Force password change every 90 days (admin) / 180 days (teachers)
- [ ] Password strength meter on registration
- [ ] Breach detection (check against known breaches)

**Files to Create/Modify:**
```
app/Rules/StrongPassword.php
app/Services/PasswordHistoryService.php
database/migrations/xxxx_create_password_histories_table.php
config/password-policy.php
```

**Estimated Time:** 3-4 hours

---

## 🟢 LOW PRIORITY (Nice to Have)

### 12. Student Portal (Future Enhancement)
**Why Future:** Students currently access grades via public interface (relevé de notes). Authentication portal can be added later.

**Current Implementation:**
- ✅ Public interface for students to view their grades (relevé de notes)
- ✅ No login required for basic grade viewing
- ✅ Secure but accessible grade reports

**Future Portal Implementation (When Needed):**
- [ ] Add student authentication guard
- [ ] Separate student login route (`/student/login`)
- [ ] Read-only access to their own data
- [ ] View grades, attendance, schedules, homework
- [ ] No public registration (students created by admin/teacher)
- [ ] Parent account linking for monitoring
- [ ] Student announcements and notifications
- [ ] Direct messaging with teachers

**Estimated Time:** 8-10 hours

---

### 13. Emergency Admin Access
**Why Optional:** Backup access method in case of IP change or emergency.

**Implementation:**
- [ ] Phone/SMS verification for emergency access
- [ ] Temporary access tokens valid for 1 hour
- [ ] Email + SMS for emergency login approval
- [ ] Require 2 admin approvals for emergency access

**Estimated Time:** 4-5 hours

---

### 14. Security Dashboard
**Why Optional:** Visual overview of security metrics.

**Implementation:**
- [ ] Failed login attempts graph
- [ ] Active sessions map
- [ ] Security alerts widget
- [ ] Recent activity timeline
- [ ] IP whitelist status

**Estimated Time:** 4-5 hours

---

## 📊 Implementation Summary

### Total Estimated Time by Priority:
- **Critical (Items 1-4):** ~9-13 hours
- **High (Items 5-8):** ~13-17 hours
- **Medium (Items 9-11):** ~8-11 hours
- **Low (Items 12-14):** ~16-21 hours

### Recommended Implementation Order:
1. **Week 1:** Items 1, 2, 3 (Critical - Admin separation & IP security)
2. **Week 2:** Items 4, 5 (Critical/High - Guards & rate limiting)
3. **Week 3:** Items 6, 7 (High - 2FA & logging)
4. **Week 4:** Items 8, 9 (High/Medium - Approvals & sessions)
5. **Week 5+:** Items 10-14 (Medium/Low - Enhancements)

---

## 🔧 Quick Start Commands

```bash
# Create admin account
php artisan admin:create

# Seed default admin
php artisan db:seed --class=AdminSeeder

# Clear all sessions
php artisan session:flush

# View activity logs
php artisan logs:show --type=security

# Add allowed IP
php artisan admin:whitelist:add 192.168.1.100

# Enable 2FA for admin
php artisan admin:2fa:enable admin@school.local
```

---

## 📝 Configuration Checklist

Before deploying to production:
- [ ] Change default admin password
- [ ] Enable IP whitelist in production
- [ ] Configure 2FA for all admins
- [ ] Set up email notifications
- [ ] Configure session timeouts
- [ ] Enable activity logging
- [ ] Test emergency access procedure
- [ ] Document all admin IPs
- [ ] Set up backup admin account
- [ ] Configure firewall rules

---

## 🚨 Security Best Practices

1. **Never** commit sensitive credentials to git
2. Use environment variables for all secrets
3. Keep Laravel and dependencies updated
4. Use HTTPS in production (SSL/TLS)
5. Regular security audits
6. Database backups before major changes
7. Test all security features in staging first
8. Document security procedures
9. Train staff on security policies
10. Regular password rotation for admin accounts

---

**Last Updated:** November 24, 2025
**Status:** Planning Phase
**Priority:** Critical Implementation Required
