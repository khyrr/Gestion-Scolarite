# Phase 3: Teacher Dashboard

**Estimated Time**: 10-14 days (Weeks 4-5)  
**Start Date**: _____________  
**Completion Date**: _____________

---

## 🎯 Phase Objectives

Build modern teacher dashboard using Livewire + Tailwind. Old teacher interface remains accessible.

**Important**: Build separate from existing teacher views. Use old code as reference only.

---

## ✅ Tasks

### 3.1 Authentication & Authorization

**Note**: We're using Spatie's role middleware, NOT creating custom middleware.

- [ ] **Define teacher route group** (`routes/web.php`)
  ```php
  use Spatie\Permission\Middleware\RoleMiddleware;
  
  Route::prefix('teacher')
      ->middleware(['auth', RoleMiddleware::using('teacher')])
      ->group(function () {
          Route::get('/dashboard', \App\Livewire\Teacher\Dashboard::class)->name('teacher.dashboard');
          Route::get('/classes', \App\Livewire\Teacher\MyClasses::class)->name('teacher.classes');
          Route::get('/courses', \App\Livewire\Teacher\MyCourses::class)->name('teacher.courses');
          Route::get('/students', \App\Livewire\Teacher\StudentsList::class)->name('teacher.students');
          Route::get('/evaluations', \App\Livewire\Teacher\EvaluationManager::class)->name('teacher.evaluations');
          Route::get('/grades', \App\Livewire\Teacher\GradeEntry::class)->name('teacher.grades');
          Route::get('/gradebook', \App\Livewire\Teacher\GradeBook::class)->name('teacher.gradebook');
      });
  ```
  
- [ ] **Test authentication**
  - [ ] Admin cannot access teacher routes
  - [ ] Student cannot access teacher routes
  - [ ] Teacher can access all teacher routes

---

### 3.2 Teacher Layout

**⚠️ UI Stack Decision**: Based on Phase 1 decision (Bootstrap vs Tailwind)

- [ ] **Create teacher layout** (`resources/views/layouts/teacher.blade.php`)
  - [ ] Include CSS framework (Bootstrap OR Tailwind based on Phase 1 decision)
  - [ ] Include Alpine.js
  - [ ] Include Livewire scripts/styles
  - [ ] Responsive navigation menu
  - [ ] User profile dropdown
  - [ ] Notifications area
  - [ ] Footer
  
  **Recommended**: Use Bootstrap + Livewire for fastest development and consistency with existing UI
  
- [ ] **Design navigation menu**
  - [ ] Dashboard link
  - [ ] My Classes link
  - [ ] My Courses link
  - [ ] Students link
  - [ ] Evaluations link
  - [ ] Gradebook link
  - [ ] Profile link
  - [ ] Logout link
  
- [ ] **Add dark mode support** (optional)
  
- [ ] **Test responsive layout**
  - [ ] Desktop view
  - [ ] Tablet view
  - [ ] Mobile view

---

### 3.3 Week 4: Essential Features

#### Component 1: Dashboard
- [ ] **Generate component**
  ```bash
  php artisan make:livewire Teacher/Dashboard
  ```
  
- [ ] **Implement dashboard** (`app/Livewire/Teacher/Dashboard.php`)
  - [ ] Load teacher's statistics
  - [ ] Count of assigned classes
  - [ ] Count of assigned courses
  - [ ] Count of students taught
  - [ ] Pending evaluations count
  - [ ] Recent activity feed
  
- [ ] **Design view** (`resources/views/livewire/teacher/dashboard.blade.php`)
  - [ ] Welcome message with teacher name
  - [ ] Stats cards (Tailwind)
  - [ ] Upcoming evaluations widget
  - [ ] Recent grades entered widget
  - [ ] Quick actions (create evaluation, enter grades)
  
- [ ] **Test component**
  - [ ] Verify all statistics are correct
  - [ ] Test real-time updates
  - [ ] Check responsiveness

---

#### Component 2: My Classes
- [ ] **Generate component**
  ```bash
  php artisan make:livewire Teacher/MyClasses
  ```
  
- [ ] **Implement component**
  - [ ] Fetch classes assigned to teacher
  - [ ] Show student count per class
  - [ ] Show courses taught in each class
  - [ ] Search/filter functionality
  
- [ ] **Design view**
  - [ ] Class cards with details
  - [ ] Student roster preview
  - [ ] Link to view full student list
  - [ ] Course list per class
  
- [ ] **Test component**

---

#### Component 3: My Courses
- [ ] **Generate component**
  ```bash
  php artisan make:livewire Teacher/MyCourses
  ```
  
- [ ] **Implement component**
  - [ ] Fetch courses taught by teacher
  - [ ] Show course details (subject, class, schedule)
  - [ ] Show evaluation count per course
  - [ ] Filter by class/semester
  
- [ ] **Design view**
  - [ ] Course table with sortable columns
  - [ ] Quick actions (view evaluations, add evaluation)
  - [ ] Course statistics
  
- [ ] **Test component**

---

#### Component 4: Students List
- [ ] **Generate component**
  ```bash
  php artisan make:livewire Teacher/StudentsList
  ```
  
- [ ] **Implement component**
  - [ ] Fetch all students taught by teacher
  - [ ] Group by class (optional)
  - [ ] Search functionality
  - [ ] Filter by class
  - [ ] Sortable columns
  
- [ ] **Design view**
  - [ ] Student data table
  - [ ] Student photo/avatar
  - [ ] Class name
  - [ ] Quick link to student grades
  
- [ ] **Test component**

---

### 3.4 Week 5: Grading & Evaluation

#### Component 5: Evaluation Manager
- [ ] **Generate component**
  ```bash
  php artisan make:livewire Teacher/EvaluationManager
  ```
  
- [ ] **Implement component**
  - [ ] List all evaluations created by teacher
  - [ ] Filter by course/class
  - [ ] Search by name
  - [ ] Sort by date
  - [ ] Create new evaluation (modal/slide-over)
  - [ ] Edit evaluation
  - [ ] Delete evaluation (with confirmation)
  - [ ] View grades for evaluation
  
- [ ] **Design view**
  - [ ] Evaluation table
  - [ ] "Create Evaluation" button
  - [ ] Modal form for create/edit
  - [ ] Validation messages
  
- [ ] **Form fields**
  - [ ] Title
  - [ ] Course (select from teacher's courses)
  - [ ] Type (dropdown: exam, quiz, homework, project)
  - [ ] Date
  - [ ] Max score
  - [ ] Weight/coefficient
  - [ ] Description (textarea)
  
- [ ] **Validation**
  - [ ] Required fields
  - [ ] Date validation
  - [ ] Max score must be positive
  
- [ ] **Test component**
  - [ ] Create evaluation
  - [ ] Edit evaluation
  - [ ] Delete evaluation
  - [ ] Verify in database

---

#### Component 6: Grade Entry
- [ ] **Generate component**
  ```bash
  php artisan make:livewire Teacher/GradeEntry
  ```
  
- [ ] **Implement component**
  - [ ] Select evaluation from dropdown
  - [ ] Load students for that evaluation's course
  - [ ] Display student roster
  - [ ] Inline grade entry (input fields)
  - [ ] Bulk save functionality
  - [ ] Validate scores (cannot exceed max)
  - [ ] Show previously entered grades
  - [ ] Update existing grades
  - [ ] **USE GradeService from Phase 1** for all grade updates
  
- [ ] **Design view**
  - [ ] Evaluation selector
  - [ ] Student table with grade input
  - [ ] Visual feedback (saved, error, etc.)
  - [ ] "Save All" button
  - [ ] Individual save buttons (optional)
  - [ ] Progress indicator
  
- [ ] **Integration with GradeService**
  ```php
  use App\Services\GradeService;
  
  public function saveGrade($noteId, $newGrade)
  {
      app(GradeService::class)->updateGrade($noteId, $newGrade);
      // Activity log happens automatically
  }
  ```
  
- [ ] **Optimization**
  - [ ] Debounce input for auto-save
  - [ ] Loading states
  - [ ] Success/error notifications
  
- [ ] **Validation**
  - [ ] Score cannot exceed max score
  - [ ] Prevent duplicate entries
  - [ ] Numeric validation
  
- [ ] **Test component**
  - [ ] Enter grades for all students
  - [ ] Update existing grades
  - [ ] Validation works correctly
  - [ ] **Activity log tracks changes with teacher context**

---

#### Component 7: Grade Book
- [ ] **Generate component**
  ```bash
  php artisan make:livewire Teacher/GradeBook
  ```
  
- [ ] **Implement component**
  - [ ] Select course from dropdown
  - [ ] Display matrix: Students × Evaluations
  - [ ] Show all grades for selected course
  - [ ] Calculate averages per student
  - [ ] Calculate averages per evaluation
  - [ ] Filter by class
  - [ ] Export to Excel/PDF
  
- [ ] **Design view**
  - [ ] Course selector
  - [ ] Responsive data table
  - [ ] Color-coded scores (red for low, green for high)
  - [ ] Student averages column
  - [ ] Evaluation averages row
  - [ ] Export buttons
  
- [ ] **Statistics**
  - [ ] Class average
  - [ ] Highest score
  - [ ] Lowest score
  - [ ] Pass/fail rate
  
- [ ] **Test component**
  - [ ] View gradebook for different courses
  - [ ] Verify calculations are correct
  - [ ] Test export functionality

---

### 3.5 Additional Features

- [ ] **Profile Management**
  - [ ] View/edit teacher profile
  - [ ] Change password
  - [ ] Update contact information
  
- [ ] **Notifications**
  - [ ] New evaluation reminders
  - [ ] Grade entry reminders
  - [ ] System announcements
  
- [ ] **Help/Documentation**
  - [ ] User guide for teachers
  - [ ] FAQ section
  - [ ] Contact support

---

## 🎯 Deliverables Checklist

- [ ] ✅ Teacher login and dashboard functional
- [ ] ✅ All 7 teacher components working
- [ ] ✅ Responsive UI on all pages (Bootstrap OR Tailwind based on Phase 1 decision)
- [ ] ✅ Real-time Livewire interactions smooth
- [ ] ✅ Grade entry and management complete
- [ ] ✅ Evaluation creation and management complete
- [ ] ✅ **GradeService used for all grade updates**
- [ ] ✅ Activity logging on grade changes (with teacher context)
- [ ] ✅ **OLD teacher routes still functional** (parallel system)
- [ ] ✅ Role-based access enforced (using Spatie middleware)

---

## 📝 Testing Checklist

- [ ] Test as teacher user
- [ ] Create evaluation end-to-end
- [ ] Enter grades for multiple students
- [ ] Update existing grades
- [ ] View gradebook with real data
- [ ] Test all filters and searches
- [ ] Test on mobile devices
- [ ] Verify performance with 100+ students
- [ ] Check browser console for errors
- [ ] Verify activity logs record grade changes

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

**User Feedback**:
```
(Document teacher feedback during testing)
```

---

## ✅ Phase Complete

- [ ] **All tasks completed**
- [ ] **All 7 components fully functional**
- [ ] **Testing complete**
- [ ] **User acceptance testing passed**
- [ ] **Old system still working**
- [ ] **Ready to proceed to Phase 4**

**Completion Date**: _____________  
**Notes**: _____________

---

[← Back to Overview](README.md) | [← Phase 2](phase-02.md) | [Next: Phase 4 →](phase-04.md)
