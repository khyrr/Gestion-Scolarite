# Phase 4: PDF Generation Service

**Estimated Time**: 5-7 days (Week 6)  
**Start Date**: _____________  
**Completion Date**: _____________

---

## 🎯 Phase Objectives

Implement centralized PDF generation using Laravel DomPDF for reports, transcripts, receipts, and rosters.

**⚠️ Performance Reality Check**:
- Target: PDF generation < 2 seconds
- This may be optimistic for:
  - Class rosters with 50+ students
  - Transcripts with many evaluations
  - Heavy CSS/tables
- **Mitigation strategies**:
  - Cache PDFs per trimester (generate once, store in storage)
  - Generate asynchronously with queues (for later)
  - Keep CSS simple and print-optimized

---

## ✅ Tasks

### 4.1 Create PDF Service

- [ ] **Create service class**
  ```bash
  touch app/Services/PdfService.php
  ```
  
- [ ] **Implement PdfService** (`app/Services/PdfService.php`)
  ```php
  <?php

  namespace App\Services;

  use Barryvdh\DomPDF\Facade\Pdf;
  use App\Models\Etudiant;
  use App\Models\Classe;
  use App\Models\Evaluation;
  use App\Models\EnseignPaiement;
  use App\Models\EtudePaiement;

  class PdfService
  {
      public function generateStudentTranscript($studentId)
      {
          // Implementation
      }

      public function generateClassRoster($classeId)
      {
          // Implementation
      }

      public function generateGradeReport($evaluationId)
      {
          // Implementation
      }

      public function generateTeacherPaymentReceipt($paymentId)
      {
          // Implementation
      }

      public function generateStudentPaymentReceipt($paymentId)
      {
          // Implementation
      }

      public function generateCourseReport($courseId)
      {
          // Implementation
      }
  }
  ```

- [ ] **Register service in container** (if needed)

---

### 4.2 PDF Templates

#### Template 1: Student Transcript
- [ ] **Create template** (`resources/views/pdf/student-transcript.blade.php`)
  
- [ ] **Design includes**:
  - [ ] School header/logo
  - [ ] Student information block
    - [ ] Full name
    - [ ] Student ID
    - [ ] Class
    - [ ] Photo
  - [ ] Academic year
  - [ ] Grade table
    - [ ] Course name
    - [ ] Evaluations
    - [ ] Scores
    - [ ] Average per course
  - [ ] Overall GPA/Average
  - [ ] Footer with signature area
  - [ ] Generation date
  
- [ ] **Implement method** in PdfService
  ```php
  public function generateStudentTranscript($studentId)
  {
      $student = Etudiant::with(['notes.evaluation.cours', 'classe'])->findOrFail($studentId);
      
      $data = [
          'student' => $student,
          'grades' => $this->calculateGrades($student),
          'average' => $this->calculateAverage($student),
          'generatedAt' => now(),
      ];

      $pdf = Pdf::loadView('pdf.student-transcript', $data);
      return $pdf->download('transcript-' . $student->nom . '.pdf');
  }
  ```
  
- [ ] **Style with CSS** (inline or embedded)
  - [ ] Professional formatting
  - [ ] Print-friendly colors
  - [ ] Clear typography
  
- [ ] **Test generation**
  - [ ] Generate for student with grades
  - [ ] Generate for student without grades
  - [ ] Check all data displays correctly

---

#### Template 2: Class Roster
- [ ] **Create template** (`resources/views/pdf/class-roster.blade.php`)
  
- [ ] **Design includes**:
  - [ ] School header/logo
  - [ ] Class information
    - [ ] Class name
    - [ ] Level
    - [ ] Academic year
    - [ ] Teacher/Coordinator
  - [ ] Student list table
    - [ ] Number
    - [ ] Student name
    - [ ] Student ID
    - [ ] Date of birth
    - [ ] Contact info
    - [ ] Photo (optional)
  - [ ] Total student count
  - [ ] Generation date
  
- [ ] **Implement method** in PdfService
  ```php
  public function generateClassRoster($classeId)
  {
      $classe = Classe::with('etudiants')->findOrFail($classeId);
      
      $data = [
          'classe' => $classe,
          'students' => $classe->etudiants()->orderBy('nom')->get(),
          'generatedAt' => now(),
      ];

      $pdf = Pdf::loadView('pdf.class-roster', $data);
      return $pdf->download('roster-' . $classe->nom . '.pdf');
  }
  ```
  
- [ ] **Test generation**

---

#### Template 3: Grade Report (Evaluation)
- [ ] **Create template** (`resources/views/pdf/grade-report.blade.php`)
  
- [ ] **Design includes**:
  - [ ] School header/logo
  - [ ] Evaluation information
    - [ ] Title
    - [ ] Course name
    - [ ] Class
    - [ ] Teacher
    - [ ] Date
    - [ ] Type
    - [ ] Max score
  - [ ] Grades table
    - [ ] Student name
    - [ ] Score
    - [ ] Percentage
    - [ ] Rank (optional)
  - [ ] Statistics
    - [ ] Average score
    - [ ] Highest score
    - [ ] Lowest score
    - [ ] Pass rate
  - [ ] Chart/visualization (optional)
  - [ ] Generation date
  
- [ ] **Implement method** in PdfService
  ```php
  public function generateGradeReport($evaluationId)
  {
      $evaluation = Evaluation::with(['notes.etudiant', 'cours.classe'])->findOrFail($evaluationId);
      
      $data = [
          'evaluation' => $evaluation,
          'grades' => $evaluation->notes()->with('etudiant')->orderByDesc('note')->get(),
          'statistics' => $this->calculateStatistics($evaluation),
          'generatedAt' => now(),
      ];

      $pdf = Pdf::loadView('pdf.grade-report', $data);
      return $pdf->download('grades-' . $evaluation->titre . '.pdf');
  }
  ```
  
- [ ] **Test generation**

---

#### Template 4: Teacher Payment Receipt
- [ ] **Create template** (`resources/views/pdf/teacher-payment-receipt.blade.php`)
  
- [ ] **Design includes**:
  - [ ] School header/logo
  - [ ] Receipt number
  - [ ] Teacher information
    - [ ] Name
    - [ ] ID
  - [ ] Payment details
    - [ ] Amount (large, prominent)
    - [ ] Date
    - [ ] Period (month/year)
    - [ ] Payment method
    - [ ] Reference number
  - [ ] Amount in words
  - [ ] Signature area
  - [ ] Generation date
  
- [ ] **Implement method** in PdfService
  ```php
  public function generateTeacherPaymentReceipt($paymentId)
  {
      $payment = EnseignPaiement::with('enseignant')->findOrFail($paymentId);
      
      $data = [
          'payment' => $payment,
          'teacher' => $payment->enseignant,
          'amountInWords' => $this->numberToWords($payment->montant),
          'generatedAt' => now(),
      ];

      $pdf = Pdf::loadView('pdf.teacher-payment-receipt', $data);
      return $pdf->download('receipt-teacher-' . $payment->id . '.pdf');
  }
  ```
  
- [ ] **Test generation**

---

#### Template 5: Student Payment Receipt
- [ ] **Create template** (`resources/views/pdf/student-payment-receipt.blade.php`)
  
- [ ] **Design includes**:
  - [ ] School header/logo
  - [ ] Receipt number
  - [ ] Student information
    - [ ] Name
    - [ ] Student ID
    - [ ] Class
  - [ ] Payment details
    - [ ] Amount (large, prominent)
    - [ ] Date
    - [ ] Payment type (tuition, fees, etc.)
    - [ ] Payment method
    - [ ] Reference number
  - [ ] Amount in words
  - [ ] Balance remaining (if applicable)
  - [ ] Signature area
  - [ ] Generation date
  
- [ ] **Implement method** in PdfService
  ```php
  public function generateStudentPaymentReceipt($paymentId)
  {
      $payment = EtudePaiement::with('etudiant.classe')->findOrFail($paymentId);
      
      $data = [
          'payment' => $payment,
          'student' => $payment->etudiant,
          'amountInWords' => $this->numberToWords($payment->montant),
          'generatedAt' => now(),
      ];

      $pdf = Pdf::loadView('pdf.student-payment-receipt', $data);
      return $pdf->download('receipt-student-' . $payment->id . '.pdf');
  }
  ```
  
- [ ] **Test generation**

---

#### Template 6: Course Report (Optional)
- [ ] **Create template** (`resources/views/pdf/course-report.blade.php`)
  
- [ ] **Design includes**:
  - [ ] Course overview
  - [ ] Enrolled students
  - [ ] All evaluations
  - [ ] Grade distribution
  - [ ] Student performance summary
  
- [ ] **Implement method** in PdfService
  
- [ ] **Test generation**

---

### 4.3 Integration Points

#### Filament Admin Integration
- [ ] **Add PDF actions to Student resource**
  ```php
  // In StudentResource.php
  public static function table(Table $table): Table
  {
      return $table
          ->actions([
              Action::make('transcript')
                  ->icon('heroicon-o-document-text')
                  ->action(fn (Etudiant $record) => app(PdfService::class)->generateStudentTranscript($record->id)),
          ]);
  }
  ```
  
- [ ] **Add PDF actions to Class resource**
  - [ ] Generate class roster
  
- [ ] **Add PDF actions to Evaluation resource**
  - [ ] Generate grade report
  
- [ ] **Add PDF actions to Payment resources**
  - [ ] Generate receipt for teacher payments
  - [ ] Generate receipt for student payments
  
- [ ] **Test all Filament PDF actions**

---

#### Teacher Dashboard Integration
- [ ] **Add export button to GradeBook component**
  ```php
  // In GradeBook.php
  public function exportPdf($evaluationId)
  {
      return app(PdfService::class)->generateGradeReport($evaluationId);
  }
  ```
  
- [ ] **Add download buttons in views**
  - [ ] Evaluation list (export grades)
  - [ ] Gradebook (export course report)
  
- [ ] **Test all teacher dashboard PDF exports**

---

#### Student Portal Integration (Phase 5)
- [ ] **Add transcript download button** (will implement in Phase 5)
- [ ] **Add payment receipt downloads** (will implement in Phase 5)

---

### 4.4 Helper Methods

- [ ] **Implement number to words converter**
  ```php
  private function numberToWords($number)
  {
      // Convert number to words for receipts
      // e.g., 1500 -> "One Thousand Five Hundred"
  }
  ```
  
- [ ] **Implement grade calculation methods**
  ```php
  private function calculateGrades($student) { }
  private function calculateAverage($student) { }
  private function calculateStatistics($evaluation) { }
  ```
  
- [ ] **Implement formatting helpers**
  ```php
  private function formatCurrency($amount) { }
  private function formatDate($date) { }
  ```

---

### 4.5 Configuration & Optimization

- [ ] **Configure PDF settings** in `.env`
  ```env
  PDF_PAPER_SIZE=a4
  PDF_ORIENTATION=portrait
  ```
  
  **⚠️ NOTE**: Dompdf doesn't auto-read these. You must code them in PdfService:
  ```php
  $pdf = Pdf::loadView('pdf.transcript', $data)
      ->setPaper(config('app.pdf_paper_size', 'a4'))
      ->setOrientation(config('app.pdf_orientation', 'portrait'));
  ```
  
- [ ] **Add school logo** to `public/img/logo.png`
  
- [ ] **Create CSS file for PDF styling** (`resources/views/pdf/styles.blade.php`)
  - [ ] Reusable styles
  - [ ] Professional formatting
  - [ ] Print-optimized
  
- [ ] **Optimize PDF generation**
  - [ ] Use eager loading to prevent N+1 queries
  - [ ] Cache complex calculations
  - [ ] Limit image sizes
  
- [ ] **Test performance**
  - [ ] Generate PDF with 100+ students
  - [ ] Measure generation time (target < 2 seconds, but 3-5s is acceptable for complex PDFs)
  - [ ] If slow, consider:
    - [ ] Caching generated PDFs
    - [ ] Simplifying CSS
    - [ ] Reducing image sizes
    - [ ] Queue-based generation for later phases

---

## 🎯 Deliverables Checklist

- [ ] ✅ PdfService class created and functional
- [ ] ✅ 5-6 PDF templates designed and working
- [ ] ✅ All templates styled professionally
- [ ] ✅ Filament integration complete (download buttons)
- [ ] ✅ Teacher dashboard integration complete
- [ ] ✅ PDF generation under 2 seconds
- [ ] ✅ All PDFs display correct data
- [ ] ✅ Print-friendly styling

---

## 📝 Testing Checklist

- [ ] Generate each PDF type
- [ ] Test with real data
- [ ] Test with edge cases (no data, lots of data)
- [ ] Print PDFs to verify formatting
- [ ] Test on different browsers
- [ ] Verify calculations are accurate
- [ ] Check for missing images/logos
- [ ] Test download functionality

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
- [ ] **All PDF templates functional**
- [ ] **Integration points working**
- [ ] **Testing complete**
- [ ] **Ready to proceed to Phase 5**

**Completion Date**: _____________  
**Notes**: _____________

---

[← Back to Overview](README.md) | [← Phase 3](phase-03.md) | [Next: Phase 5 →](phase-05.md)
