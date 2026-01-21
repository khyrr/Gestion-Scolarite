# Phase 0: Laravel 11 Upgrade (Prerequisites)

**Estimated Time**: 1-2 days  
**Start Date**: _____________  
**Completion Date**: _____________

---

## 🎯 Phase Objectives

Upgrade from Laravel 10 to Laravel 11 to ensure compatibility with Filament 3 and modern packages.

---

## ✅ Tasks

### 0.1 Backup Everything
- [ ] Backup database using your preferred method
- [ ] Verify backup integrity
- [ ] Commit all current changes to git
  ```bash
  cd /home/mohamed/Documents/projects/Gestion-Scolarite
  git add .
  git commit -m "Pre-Laravel 11 upgrade backup"
  ```
- [ ] Create new branch for upgrade
  ```bash
  git checkout -b upgrade/laravel-11
  ```

---

### 0.2 Update Composer Dependencies

**⚠️ CRITICAL: Consider using Laravel Shift for automated upgrade or follow official guide meticulously**

- [ ] Update `composer.json` Laravel framework version
  ```bash
  composer require laravel/framework:^11.0
  ```
- [ ] Let Laravel manage testing dependencies
  ```bash
  # Laravel will pull correct Collision/PHPUnit versions
  # Do NOT manually pin PHPUnit unless composer complains
  composer update
  ```
- [ ] Check for any dependency conflicts
- [ ] Resolve conflicts if any appear
- [ ] **Review dependencies carefully** - some packages may not support Laravel 11 yet

---

### 0.3 Update Config Files

**⚠️ WARNING: Don't blindly delete files. Laravel 11 introduces new structure but migration is gradual.**

Laravel 11 streamlined configuration - many config files can be removed.

- [ ] **Follow official Laravel 11 upgrade guide** 
  - https://laravel.com/docs/11.x/upgrade
  - Consider using Laravel Shift (paid but saves hours of debugging)
  
- [ ] **Update `bootstrap/app.php`** - New Laravel 11 structure
  - Laravel 11 uses new application builder pattern
  - Middleware configuration moves here
  
- [ ] **Migrate middleware from `app/Http/Kernel.php`**
  - **DON'T just delete Kernel.php yet**
  - Carefully move middleware config to new structure
  - Keep file until fully migrated and tested
  
- [ ] **Common upgrade mistakes to avoid**:
  - ⚠️ Breaking middleware order
  - ⚠️ Breaking CSRF/auth redirects  
  - ⚠️ Sanctum config mismatch
  - ⚠️ Route caching errors
  
- [ ] **Review and clean up config files**
  - Laravel 11 uses fewer config files by default
  - Keep only customized configs
  
- [ ] **Run system check**
  ```bash
  php artisan about
  ```
  - Verify Laravel version is 11.x
  - Check all environment requirements

---

### 0.4 Test Existing Functionality

- [ ] Check migration status
  ```bash
  php artisan migrate:status
  ```
  
- [ ] Run existing tests (if available)
  ```bash
  php artisan test
  ```
  
- [ ] **Manual testing checklist**:
  - [ ] Application loads without errors
  - [ ] User authentication works
  - [ ] Admin dashboard accessible
  - [ ] Student CRUD operations work
  - [ ] Teacher CRUD operations work
  - [ ] Class management works
  - [ ] Grade entry and viewing works
  - [ ] Payment records accessible
  - [ ] No console errors in browser
  
- [ ] Check Laravel logs for errors
  ```bash
  tail -f storage/logs/laravel.log
  ```
  
- [ ] Clear all caches
  ```bash
  php artisan optimize:clear
  ```

---

## 🎯 Deliverables Checklist

- [ ] ✅ Laravel 11 installed and running
- [ ] ✅ All existing features working as before
- [ ] ✅ Database migrations successful
- [ ] ✅ No breaking changes in your code
- [ ] ✅ All tests passing (if applicable)
- [ ] ✅ **Authentication + session + CSRF verified** (CRITICAL)
- [ ] ✅ Middleware order preserved and working
- [ ] ✅ Git commit with upgrade changes

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

**Helpful Resources**:
- [Laravel 11 Upgrade Guide](https://laravel.com/docs/11.x/upgrade)
- [Laravel 11 Release Notes](https://laravel.com/docs/11.x/releases)

---

## ⚠️ Rollback Plan

If upgrade fails:
```bash
# Rollback git changes
git checkout main  # or your main branch
git branch -D upgrade/laravel-11

# Restore database if modified
# (Use your backup restoration method)
```

---

## ✅ Phase Complete

- [ ] **All tasks completed**
- [ ] **All deliverables verified**
- [ ] **Ready to proceed to Phase 1**

**Completion Date**: _____________  
**Notes**: _____________

---

[← Back to Overview](README.md) | [Next: Phase 1 →](phase-01.md)
