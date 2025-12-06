# Project Roadmap

## Phase 1: Cleanup & Standardization (Completed)
- [x] Scan project structure and logic.
- [x] Rename `mot_de_passe` to `password` in `administrateurs` table.
- [x] Rename `mot_de_passe` to `password` in `enseignants` table.
- [x] Update Models (`Administrateur`, `Enseignant`) to use `password`.
- [x] Update Controllers (`RegisterController`, `AdminManagementController`) to use `password`.
- [x] Disable Student Dashboard routes (temporarily).
- [x] Fix `RoleMiddleware` crash (check for `is_active` column existence).

## Phase 2: Single Table Authentication Refactor (Completed)
- [x] **Database Migration**:
    - [x] Add `role`, `profile_type`, `profile_id` to `users` table.
    - [x] Create migration script to move existing Admins and Teachers into `users` table.
- [x] **Model Updates**:
    - [x] Update `User` model (add polymorphic relationship `profile`).
    - [x] Update `Administrateur` model (remove Auth traits, add `user` relationship).
    - [x] Update `Enseignant` model (remove Auth traits, add `user` relationship).
    - [x] Update `Etudiant` model (add `user` relationship).
- [x] **Config Updates**:
    - [x] Update `config/auth.php` to use single `web` guard and `users` provider.
- [x] **Controller Refactoring**:
    - [x] Refactor `LoginController` to handle role-based redirection.
    - [x] Refactor `AdminAuthController` (or deprecate).
    - [x] Refactor `TwoFactorController` to use `Auth::user()`.
    - [x] Refactor `RegisterController` to create `User` + Profile.
    - [x] Refactor `AdminManagementController` to create `User` + Profile.
- [x] **Middleware Refactoring**:
    - [x] Update `RoleMiddleware` to check `User` role.
    - [x] Update `TeacherMiddleware` / `RequireSuperAdmin` etc.
- [x] **View Updates**:
    - [x] Update Sidebar and Dashboard to use `Auth::user()` and check roles.
- [x] **Route Updates**:
    - [x] Update `web.php` to use standard `auth` middleware and role checks.
    - [x] Update `RedirectIfAuthenticated` middleware.

## Phase 3: Feature Implementation & Verification
- [ ] **Teacher Tools**:
    - [ ] Verify "Input Grades" functionality.
    - [ ] Verify "Attendance" functionality.
- [ ] **Student Features**:
    - [ ] Re-enable Student Dashboard (using new Auth system).
    - [ ] Verify Student "View Grades" functionality.
- [ ] **Admin Features**:
    - [ ] Verify "Manage Users" (now managing `User` model with profiles).

## Phase 4: Optimization & Polish
- [ ] Optimize Admin Dashboard queries (already started).
- [ ] Review and optimize database indexes.
