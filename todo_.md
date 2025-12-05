# Project Roadmap & Todo

## Phase 1: Authentication & Architecture Cleanup (Completed)
- [x] **Standardize Password Columns**: Renamed `mot_de_passe` to `password` in `administrateurs` and `enseignants` tables.
- [x] **Update Models**: Updated `Administrateur` and `Enseignant` models to use the new `password` column.
- [x] **Update Controllers**: Updated `RegisterController` and `AdminManagementController` to use `password`.
- [x] **Fix Middleware**: Patched `RoleMiddleware` to prevent crashes on Admin users (missing `is_active` check).
- [x] **Disable Student Access**: Temporarily disabled student dashboard routes until auth is ready.
- [x] **Clean Services**: Removed password hashing from `EtudiantService` since students don't have passwords yet.

## Phase 2: Student Features Implementation (Next Steps)
- [ ] **Enable Student Authentication**:
    - [ ] Decide on auth method (User table link vs. Etudiant table password).
    - [ ] Add `password` column to `etudiants` table (if choosing separate table).
    - [ ] Create `StudentLoginController`.
- [ ] **Student Dashboard**:
    - [ ] Re-enable `etudiant.*` routes.
    - [ ] Create/Update `EtudiantDashboardController`.
    - [ ] Implement "My Grades" view.
    - [ ] Implement "My Schedule" view.
- [ ] **Public Access**:
    - [ ] Verify "Transcript Search" (public access) works correctly without login.

## Phase 3: Admin & Teacher Features
- [ ] **Dashboard Widgets**: Ensure Admin dashboard widgets (stats) are accurate.
- [ ] **Teacher Tools**: Verify "Input Grades" (Saisir Notes) functionality.
- [ ] **Reports**: Test PDF generation for transcripts.

## Phase 4: Security & Polish
- [ ] **IP Whitelist**: Verify Admin IP filtering is active and working.
- [ ] **2FA**: Test Two-Factor Authentication for Admins.
- [ ] **Translations**: Ensure all new error messages are localized (fr/ar/en).
