# Phase 5: Public Pages & Student Portal

**Estimated Time**: 5-7 days (Week 7)  
**Start Date**: _____________  
**Completion Date**: _____________

---

## 🎯 Phase Objectives

Build student portal and update public-facing pages using Livewire components and Tailwind CSS.

---

## ✅ Tasks

### 5.1 Student Authentication & Authorization

**Note**: Using Spatie's role middleware, NOT custom middleware.

- [ ] **Define student route group** (`routes/web.php`)
  ```php
  use Spatie\Permission\Middleware\RoleMiddleware;
  
  Route::prefix('student')
      ->middleware(['auth', RoleMiddleware::using('student')])
      ->group(function () {
          Route::get('/dashboard', \App\Livewire\Student\Dashboard::class)->name('student.dashboard');
          Route::get('/grades', \App\Livewire\Student\MyGrades::class)->name('student.grades');
          Route::get('/courses', \App\Livewire\Student\MyCourses::class)->name('student.courses');
          Route::get('/payments', \App\Livewire\Student\MyPayments::class)->name('student.payments');
          Route::get('/profile', \App\Livewire\Student\Profile::class)->name('student.profile');
      });
  ```

---

### 5.2 Student Layout

- [ ] **Create student layout** (`resources/views/layouts/student.blade.php`)
  - [ ] Include Tailwind CSS
  - [ ] Include Alpine.js
  - [ ] Include Livewire scripts/styles
  - [ ] Responsive navigation menu
  - [ ] User profile dropdown
  - [ ] Notifications area
  - [ ] Footer
  
- [ ] **Design navigation menu**
  - [ ] Dashboard link
  - [ ] My Grades link
  - [ ] My Courses link
  - [ ] Payments link
  - [ ] Profile link
  - [ ] Logout link
  
- [ ] **Test responsive layout**
  - [ ] Desktop view
  - [ ] Tablet view
  - [ ] Mobile view

---

### 5.3 Student Components

#### Component 1: Student Dashboard
- [ ] **Generate component**
  ```bash
  php artisan make:livewire Student/Dashboard
  ```
  
- [ ] **Implement dashboard**
  - [ ] Welcome message with student name
  - [ ] Display class information
  - [ ] Show current academic year/semester
  - [ ] Display statistics
    - [ ] Total courses enrolled
    - [ ] Overall GPA/average
    - [ ] Attendance percentage (if applicable)
  - [ ] Recent grades widget
  - [ ] Upcoming evaluations widget
  - [ ] Payment status summary
  - [ ] Announcements/notifications
  
- [ ] **Design view**
  - [ ] Clean, student-friendly interface
  - [ ] Stats cards
  - [ ] Recent activity feed
  - [ ] Quick actions (view grades, download transcript)
  
- [ ] **Test component**

---

#### Component 2: My Grades
- [ ] **Generate component**
  ```bash
  php artisan make:livewire Student/MyGrades
  ```
  
- [ ] **Implement component**
  - [ ] Fetch all grades for logged-in student
  - [ ] Group by course
  - [ ] Show evaluation details (type, date, max score)
  - [ ] Show score and percentage
  - [ ] Calculate course averages
  - [ ] Calculate overall GPA
  - [ ] Filter by semester/year
  - [ ] Export transcript as PDF
  
- [ ] **Design view**
  - [ ] Course tabs or accordion
  - [ ] Grade table per course
  - [ ] Visual indicators (color-coded scores)
  - [ ] Average calculations prominently displayed
  - [ ] Download transcript button
  
- [ ] **Integrate PDF**
  - [ ] Button to download full transcript
  - [ ] Use PdfService from Phase 4
  
- [ ] **Test component**
  - [ ] View grades for multiple courses
  - [ ] Verify calculations
  - [ ] Download transcript
  - [ ] Test filters

---

#### Component 3: My Courses
- [ ] **Generate component**
  ```bash
  php artisan make:livewire Student/MyCourses
  ```
  
- [ ] **Implement component**
  - [ ] Fetch courses for student's class
  - [ ] Show course details
    - [ ] Subject name
    - [ ] Teacher name
    - [ ] Schedule/time
    - [ ] Room
  - [ ] Show upcoming evaluations per course
  - [ ] Show course materials (if applicable)
  
- [ ] **Design view**
  - [ ] Course cards or table
  - [ ] Teacher contact info
  - [ ] Upcoming evaluations list
  - [ ] Course description
  
- [ ] **Test component**

---

#### Component 4: My Payments
- [ ] **Generate component**
  ```bash
  php artisan make:livewire Student/MyPayments
  ```
  
- [ ] **Implement component**
  - [ ] Fetch all payments for logged-in student
  - [ ] Show payment history
    - [ ] Date
    - [ ] Amount
    - [ ] Payment type
    - [ ] Payment method
    - [ ] Reference number
    - [ ] Status
  - [ ] Calculate total paid
  - [ ] Show balance due (if applicable)
  - [ ] Download receipt for each payment
  
- [ ] **Design view**
  - [ ] Payment history table
  - [ ] Summary card (total paid, balance)
  - [ ] Download receipt buttons
  - [ ] Payment status badges
  
- [ ] **Integrate PDF**
  - [ ] Download receipt button per payment
  - [ ] Use PdfService from Phase 4
  
- [ ] **Test component**
  - [ ] View payment history
  - [ ] Download receipts
  - [ ] Verify calculations

---

#### Component 5: Profile
- [ ] **Generate component**
  ```bash
  php artisan make:livewire Student/Profile
  ```
  
- [ ] **Implement component**
  - [ ] Display student information (read-only or editable)
    - [ ] Name
    - [ ] Email
    - [ ] Phone
    - [ ] Date of birth
    - [ ] Class
    - [ ] Student ID
    - [ ] Photo
  - [ ] Change password functionality
  - [ ] Update contact information (if allowed)
  - [ ] Upload/change photo (if allowed)
  
- [ ] **Design view**
  - [ ] Profile card with photo
  - [ ] Information display/edit form
  - [ ] Change password section
  
- [ ] **Test component**

---

### 5.4 Public Pages

#### Page 1: Homepage
- [ ] **Update homepage** (`resources/views/welcome.blade.php` or new)
  - [ ] Modern hero section
  - [ ] School overview
  - [ ] Key features/highlights
  - [ ] Call-to-action (login, contact)
  - [ ] News/announcements section (optional)
  
- [ ] **Use Tailwind CSS** for styling
  
- [ ] **Add Alpine.js** for interactivity (optional)
  
- [ ] **Test responsiveness**

---

#### Page 2: About Page
- [ ] **Create about page** (`resources/views/about.blade.php`)
  - [ ] School history
  - [ ] Mission and vision
  - [ ] Team/staff information
  - [ ] Facilities
  - [ ] Contact information
  
- [ ] **Design with Tailwind**
  
- [ ] **Test page**

---

#### Component 6: Contact Form
- [ ] **Generate Livewire component**
  ```bash
  php artisan make:livewire Public/ContactForm
  ```
  
- [ ] **Implement component**
  - [ ] Form fields
    - [ ] Name
    - [ ] Email
    - [ ] Subject
    - [ ] Message
  - [ ] Validation
  - [ ] Send email to school admin
  - [ ] Success/error messages
  - [ ] CAPTCHA (optional, for spam prevention)
  
- [ ] **Design view**
  - [ ] Clean form layout
  - [ ] Validation feedback
  - [ ] Success message
  
- [ ] **Test component**
  - [ ] Submit form
  - [ ] Verify email sent
  - [ ] Test validation

---

#### Page 3: Course Catalog (Optional)
- [ ] **Create Livewire component**
  ```bash
  php artisan make:livewire Public/CourseCatalog
  ```
  
- [ ] **Implement component**
  - [ ] List all subjects/courses offered
  - [ ] Search functionality
  - [ ] Filter by level/department
  - [ ] Course details
  
- [ ] **Design view**
  - [ ] Course cards
  - [ ] Search bar
  - [ ] Filters
  
- [ ] **Test component**

---

### 5.5 Navigation & Routes

- [ ] **Update main navigation** to include:
  - [ ] Home
  - [ ] About
  - [ ] Courses (if applicable)
  - [ ] Contact
  - [ ] Login/Dashboard (context-aware)
  
- [ ] **Create public routes** (`routes/web.php`)
  ```php
  Route::get('/', function () {
      return view('welcome');
  })->name('home');

  Route::get('/about', function () {
      return view('about');
  })->name('about');

  Route::get('/contact', \App\Livewire\Public\ContactForm::class)->name('contact');
  ```
  
- [ ] **Test all routes**

---

### 5.6 Email Configuration

- [ ] **Configure email settings** in `.env`
  ```env
  MAIL_MAILER=smtp
  MAIL_HOST=mailhog
  MAIL_PORT=1025
  MAIL_USERNAME=null
  MAIL_PASSWORD=null
  MAIL_ENCRYPTION=null
  MAIL_FROM_ADDRESS="admin@school.com"
  MAIL_FROM_NAME="${APP_NAME}"
  ```
  
- [ ] **Test email sending** (contact form)
  
- [ ] **Create email template** for contact form submissions

---

## 🎯 Deliverables Checklist

- [ ] ✅ Student can login and access dashboard
- [ ] ✅ Student can view all their grades
- [ ] ✅ Student can view enrolled courses
- [ ] ✅ Student can check payment history
- [ ] ✅ Student can download transcript PDF
- [ ] ✅ Student can download payment receipts
- [ ] ✅ Public pages updated with modern design
- [ ] ✅ Contact form functional
- [ ] ✅ All components responsive
- [ ] ✅ **OLD student routes still functional** (if they exist)

---

## 📝 Testing Checklist

- [ ] Test as student user
- [ ] View all grades and verify accuracy
- [ ] Download transcript
- [ ] Download payment receipts
- [ ] Update profile information
- [ ] Change password
- [ ] Submit contact form
- [ ] Test on mobile devices
- [ ] Check browser console for errors
- [ ] Test with students having no grades
- [ ] Test with students having no payments

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

**Student Feedback**:
```
(Document student feedback during testing)
```

---

## ✅ Phase Complete

- [ ] **All tasks completed**
- [ ] **All 5 student components functional**
- [ ] **Public pages updated**
- [ ] **Testing complete**
- [ ] **Ready to proceed to Phase 6**

**Completion Date**: _____________  
**Notes**: _____________

---

[← Back to Overview](README.md) | [← Phase 4](phase-04.md) | [Next: Phase 6 →](phase-06.md)
