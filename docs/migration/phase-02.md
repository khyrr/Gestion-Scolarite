# Phase 2: Admin Panel Migration

**Estimated Time**: 10-14 days (Weeks 2-3)  
**Start Date**: January 21, 2026  
**Completion Date**: _____________

---

## 🎯 Phase Objectives

Build all admin CRUD interfaces in Filament. Old admin dashboard remains functional during this phase.

**Important**: Do NOT modify existing controllers or views. Build everything fresh in Filament.

---

## ✅ Tasks

### 2.1 Core Entities (Week 2)

#### Resource 1: Classes (Classe)
- [ ] **Generate resource**
  ```bash
  php artisan make:filament-resource Classe --generate
  ```
- [ ] **Customize form fields** (`app/Filament/Resources/ClasseResource.php`)
  - [ ] Class name
  - [ ] Level/Grade
  - [ ] Capacity
  - [ ] Academic year
  - [ ] Status (active/inactive)
- [ ] **Customize table columns**
  - [ ] Searchable name
  - [ ] Filterable level
  - [ ] Student count badge
  - [ ] Status toggle
- [ ] **Add relationships**
  - [ ] Students relation
  - [ ] Courses relation
- [ ] **Add bulk actions**
  - [ ] Bulk activate/deactivate
- [ ] **Test CRUD operations**
  - [ ] Create new class
  - [ ] Edit existing class
  - [ ] View class details
  - [ ] Delete class (with confirmation)

---

#### Resource 2: Subjects (Matiere)
- [ ] **Generate resource**
  ```bash
  php artisan make:filament-resource Matiere --generate
  ```
- [ ] **Customize form fields**
  - [ ] Subject name
  - [ ] Subject code
  - [ ] Credits/Hours
  - [ ] Description
  - [ ] Department
- [ ] **Customize table columns**
  - [ ] Searchable name and code
  - [ ] Sortable credits
  - [ ] Course count
- [ ] **Add relationships**
  - [ ] Courses using this subject
- [ ] **Test CRUD operations**

---

#### Resource 3: Teachers (Enseignant)
- [ ] **Generate resource**
  ```bash
  php artisan make:filament-resource Enseignant --generate
  ```
- [ ] **Customize form fields**
  - [ ] Full name
  - [ ] Email (unique)
  - [ ] Phone
  - [ ] Specialization
  - [ ] Hire date
  - [ ] Status
  - [ ] Associated user account
- [ ] **Customize table columns**
  - [ ] Searchable name and email
  - [ ] Filterable specialization
  - [ ] Status badge
  - [ ] Course count
- [ ] **Add relationships**
  - [ ] Courses taught
  - [ ] Payments received
- [ ] **Add custom actions**
  - [ ] View payment history
  - [ ] Export teacher info PDF
- [ ] **Add activity logging**
  - Verify all changes are logged
- [ ] **Test CRUD operations**

---

#### Resource 4: Students (Etudiant)
- [ ] **Generate resource**
  ```bash
  php artisan make:filament-resource Etudiant --generate
  ```
- [ ] **Customize form fields**
  - [ ] Full name
  - [ ] Email (unique)
  - [ ] Phone
  - [ ] Date of birth
  - [ ] Class (relation select)
  - [ ] Enrollment date
  - [ ] Status (active/inactive/graduated)
  - [ ] Photo upload (optional)
  - [ ] Associated user account
- [ ] **Customize table columns**
  - [ ] Searchable name and email
  - [ ] Class name (with link)
  - [ ] Status badge
  - [ ] Enrollment date
- [ ] **Add filters**
  - [ ] Filter by class
  - [ ] Filter by status
  - [ ] Filter by enrollment year
- [ ] **Add relationships**
  - [ ] Class relation
  - [ ] Grades
  - [ ] Payments
- [ ] **Add custom actions**
  - [ ] View student transcript (PDF)
  - [ ] View payment history
  - [ ] Export student data
- [ ] **Add bulk actions**
  - [ ] Bulk class assignment
  - [ ] Bulk status update
- [ ] **Add activity logging**
  - Verify all changes are logged
- [ ] **Test CRUD operations**

---

### 2.2 Academic Management (Week 3)

#### Resource 5: Courses (Cours)
- [ ] **Generate resource**
  ```bash
  php artisan make:filament-resource Cours --generate
  ```
- [ ] **Customize form fields**
  - [ ] Course name
  - [ ] Subject (relation select)
  - [ ] Teacher (relation select)
  - [ ] Class (relation select)
  - [ ] Schedule/Time
  - [ ] Room
  - [ ] Academic year/semester
  - [ ] Status
- [ ] **Customize table columns**
  - [ ] Course name
  - [ ] Subject name
  - [ ] Teacher name
  - [ ] Class name
  - [ ] Status badge
- [ ] **Add filters**
  - [ ] By teacher
  - [ ] By class
  - [ ] By semester
- [ ] **Add relationships**
  - [ ] Evaluations
  - [ ] Students (through class)
- [ ] **Add activity logging**
- [ ] **Test CRUD operations**

---

#### Resource 6: Evaluations (Evaluation)
- [ ] **Generate resource**
  ```bash
  php artisan make:filament-resource Evaluation --generate
  ```
- [ ] **Customize form fields**
  - [ ] Title/Name
  - [ ] Course (relation select)
  - [ ] Type (exam, quiz, homework, project)
  - [ ] Date
  - [ ] Max score
  - [ ] Weight/Coefficient
  - [ ] Description
- [ ] **Customize table columns**
  - [ ] Title
  - [ ] Course name
  - [ ] Type badge
  - [ ] Date
  - [ ] Max score
  - [ ] Grades count
- [ ] **Add filters**
  - [ ] By course
  - [ ] By type
  - [ ] By date range
- [ ] **Add relationships**
  - [ ] Grades (notes)
- [ ] **Add custom actions**
  - [ ] Quick grade entry
  - [ ] Export evaluation report
- [ ] **Add activity logging**
- [ ] **Test CRUD operations**

---

#### Resource 7: Grades (Note)
- [ ] **Generate resource**
  ```bash
  php artisan make:filament-resource Note --generate
  ```
- [ ] **Customize form fields**
  - [ ] Student (relation select)
  - [ ] Evaluation (relation select)
  - [ ] Score
  - [ ] Comments (optional)
  - [ ] Date entered
- [ ] **Customize table columns**
  - [ ] Student name
  - [ ] Evaluation name
  - [ ] Score (with max score)
  - [ ] Percentage badge
  - [ ] Date
- [ ] **Add filters**
  - [ ] By student
  - [ ] By evaluation
  - [ ] By course
  - [ ] By score range
- [ ] **Add validation**
  - [ ] Score cannot exceed max score
  - [ ] Prevent duplicate entries
- [ ] **Add bulk actions**
  - [ ] Bulk grade import (CSV)
- [ ] **Add activity logging** (CRITICAL - track all grade changes)
- [ ] **Test CRUD operations**

---

### 2.3 Financial & Logs

#### Resource 8: Teacher Payments (EnseignPaiement)
- [ ] **Generate resource**
  ```bash
  php artisan make:filament-resource EnseignPaiement --generate
  ```
- [ ] **Customize form fields**
  - [ ] Teacher (relation select)
  - [ ] Amount
  - [ ] Payment date
  - [ ] Payment method
  - [ ] Period (month/year)
  - [ ] Reference number
  - [ ] Status
  - [ ] Notes
- [ ] **Customize table columns**
  - [ ] Teacher name
  - [ ] Amount (formatted)
  - [ ] Date
  - [ ] Status badge
  - [ ] Method
- [ ] **Add filters**
  - [ ] By teacher
  - [ ] By date range
  - [ ] By status
- [ ] **Add custom actions**
  - [ ] Generate receipt PDF
- [ ] **Add activity logging**
- [ ] **Test CRUD operations**

---

#### Resource 9: Student Payments (EtudePaiement)
- [ ] **Generate resource**
  ```bash
  php artisan make:filament-resource EtudePaiement --generate
  ```
- [ ] **Customize form fields**
  - [ ] Student (relation select)
  - [ ] Amount
  - [ ] Payment date
  - [ ] Payment type (tuition, fees, etc.)
  - [ ] Payment method
  - [ ] Reference number
  - [ ] Status
  - [ ] Notes
- [ ] **Customize table columns**
  - [ ] Student name
  - [ ] Amount (formatted)
  - [ ] Type
  - [ ] Date
  - [ ] Status badge
- [ ] **Add filters**
  - [ ] By student
  - [ ] By payment type
  - [ ] By date range
  - [ ] By status
- [ ] **Add custom actions**
  - [ ] Generate receipt PDF
- [ ] **Add activity logging**
- [ ] **Test CRUD operations**

---

#### Resource 10: Activity Logs (ActivityLog)
- [ ] **Generate resource (Read-only)**
  ```bash
  php artisan make:filament-resource ActivityLog --generate
  ```
- [ ] **Customize table columns**
  - [ ] Event type
  - [ ] Model
  - [ ] User who made change
  - [ ] Changes (before/after)
  - [ ] Timestamp
- [ ] **Add filters**
  - [ ] By user
  - [ ] By model type
  - [ ] By event
  - [ ] By date range
- [ ] **Disable create/edit/delete** (read-only)
- [ ] **Add search** on description and properties
- [ ] **Test viewing logs**

---

#### Resource 11: Administrators (Administrateur)
- [ ] **Generate resource**
  ```bash
  php artisan make:filament-resource Administrateur --generate
  ```
- [ ] **Customize form fields**
  - [ ] Full name
  - [ ] Email (unique)
  - [ ] Phone
  - [ ] Associated user account
  - [ ] Status
- [ ] **Customize table columns**
  - [ ] Name
  - [ ] Email
  - [ ] Status badge
- [ ] **Add activity logging**
- [ ] **Test CRUD operations**

---

### 2.4 Access Control Resources

#### Resource 12: Roles
- [ ] **Generate resource**
  ```bash
  php artisan make:filament-resource Role --generate
  ```
- [ ] **Customize form fields**
  - [ ] Role name
  - [ ] Permissions (multi-select)
  - [ ] Guard name
- [ ] **Customize table columns**
  - [ ] Role name
  - [ ] Permissions count
  - [ ] Users count
- [ ] **Add relationships**
  - [ ] Users with this role
  - [ ] Permissions assigned
- [ ] **⚠️ CRITICAL: Protect system roles**
  - [ ] Prevent deletion of admin/teacher/student/super_admin roles
  - [ ] Only show to users with role: `super_admin`
  ```php
  // In RoleResource.php
  public static function canViewAny(): bool
  {
      return auth()->user()->hasRole('super_admin');
  }
  ```
- [ ] **Test CRUD operations** (as super_admin)

---

#### Resource 13: Permissions
- [ ] **Generate resource**
  ```bash
  php artisan make:filament-resource Permission --generate
  ```
- [ ] **Customize form fields**
  - [ ] Permission name
  - [ ] Guard name
  - [ ] Description
- [ ] **Customize table columns**
  - [ ] Permission name
  - [ ] Roles count
  - [ ] Guard
- [ ] **Add relationships**
  - [ ] Roles with this permission
- [ ] **⚠️ CRITICAL: Only accessible to super_admin**
  ```php
  public static function canViewAny(): bool
  {
      return auth()->user()->hasRole('super_admin');
  }
  ```
- [ ] **Test CRUD operations**

---

### 2.5 Resource Customization

For ALL resources above:

- [ ] **Add policy-based authorization**
  - Only admins can delete records
  - Implement proper permission checks
  
- [ ] **Integrate activity logs in resource views**
  - Show audit trail in resource pages
  
- [ ] **Add export functionality**
  - CSV export for all resources
  - Excel export (optional)
  
- [ ] **Optimize queries**
  - Use eager loading to prevent N+1
  - Add database indexes where needed
  
- [ ] **Add helpful widgets to dashboard**
  - Stats overview (student count, teacher count, etc.)
  - Recent activity
  - Quick actions

---

## 🎯 Deliverables Checklist

- [ ] ✅ All 13 CRUD resources working in Filament
- [ ] ✅ Data relationships functioning correctly
- [ ] ✅ Search and filters configured on all tables
- [ ] ✅ Role-based access control enforced
- [ ] ✅ Activity logs visible and tracking changes
- [ ] ✅ Permission management interface ready
- [ ] ✅ **OLD admin routes still functional** (untouched)
- [ ] ✅ No regressions in existing system

---

## 📝 Testing Checklist

- [ ] Create test data in each resource
- [ ] Test all filters and searches
- [ ] Test bulk actions
- [ ] Verify relationships display correctly
- [ ] Check mobile responsiveness
- [ ] Verify activity logging on critical models
- [ ] Test role/permission enforcement
- [ ] Performance test with large datasets

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
- [ ] **All 13 resources fully functional**
- [ ] **Testing complete**
- [ ] **Old system still working**
- [ ] **Ready to proceed to Phase 3**

**Completion Date**: _____________  
**Notes**: _____________

---

[← Back to Overview](README.md) | [← Phase 1](phase-01.md) | [Next: Phase 3 →](phase-03.md)
