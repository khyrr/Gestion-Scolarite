# Grade Entry Interface - Implementation Guide

## Overview

A spreadsheet-style grade entry interface for Filament that allows authorized users to quickly enter and update student scores for evaluations.

## Files Created

### 1. Core Page Component
- **File**: `app/Filament/Resources/EvaluationResource/Pages/ManageGrades.php`
- **Purpose**: Main page handling grade entry logic
- **Features**:
  - Spreadsheet-style table with inline editing
  - Auto-save on cell update
  - Bulk operations (assign default grade, delete grades)
  - Role-based access control
  - Validation (score ≤ max_score)
  - Progress tracking

### 2. View Template
- **File**: `resources/views/filament/resources/evaluation-resource/pages/manage-grades.blade.php`
- **Purpose**: UI layout for grade entry
- **Components**:
  - Evaluation info panel (subject, class, max score, progress)
  - Instructions banner
  - Grade entry table

### 3. View Evaluation Page
- **File**: `app/Filament/Resources/EvaluationResource/Pages/ViewEvaluation.php`
- **Purpose**: Evaluation detail view with quick access to grade entry

### 4. Translations
Updated language files:
- `resources/lang/fr/app.php`
- `resources/lang/en/app.php`
- `resources/lang/ar/app.php`

Added keys:
- `saisir_notes`, `bareme`, `progression`
- `instructions`, `cliquer_cellule_modifier`
- `notes_sauvegardees_automatiquement`
- Bulk action labels and notifications

### 5. Permission System
- **File**: `database/seeders/RolesAndPermissionsSeeder.php`
- **New Permission**: `manage grades`
- **Assigned to**: super_admin, admin, teacher

## Architecture

### Authorization Flow

```php
// Three-tier authorization
1. Route access: canAccess() checks role/permission
2. Page mount: canAccessEvaluation() verifies class assignment for teachers
3. URL parameter validation: Security checks prevent manipulation
```

### Access Rules

| Role | Access Level |
|------|--------------|
| **Super Admin** | All evaluations |
| **Admin** | All evaluations |
| **Teacher** | Only evaluations for assigned classes |
| **Student** | No access |

### Data Flow

```
Evaluation → Students in Class → Grade Table → Note Records
                                      ↓
                              Inline Edit Cell
                                      ↓
                              saveGrade() Method
                                      ↓
                          Create/Update Note Record
```

## Key Features

### 1. Inline Editable Table
- **Score Column**: Numeric input with validation
- **Comment Column**: Text input, optional
- **Status Column**: Visual indicator (graded/not graded)

### 2. Auto-Save
Changes are persisted immediately when user leaves a cell.

### 3. Bulk Operations
- **Assign Default Grade**: Apply same score to multiple students
- **Delete Grades**: Remove grades in bulk

### 4. Validation
```php
// Score validation
'numeric',
'min:0',
'max:' . $this->record->note_max
```

### 5. Progress Tracking
Visual progress bar showing graded vs. total students.

### 6. Filtering
Filter students by graded/not graded status.

## Usage

### Accessing Grade Entry

**From Evaluation List:**
1. Navigate to Evaluations resource
2. Click "Saisir Notes" action button
3. Grade entry page opens

**From Evaluation Detail:**
1. View an evaluation
2. Click "Saisir Notes" in header actions
3. Grade entry page opens

**Direct URL:**
```
/admin/evaluations/{id}/grades
```

### Entering Grades

1. **Single Entry**: Click on score cell, enter value, press Enter/Tab
2. **Comments**: Click on comment cell, type, press Enter/Tab
3. **Bulk Assignment**: Select students, use "Attribuer note par défaut" action
4. **Delete**: Click trash icon on row or select multiple and delete

## Technical Details

### Database Structure

The `saveGrade()` method handles CRUD operations:

```php
protected function saveGrade(Etudiant $student, ?float $note, ?string $commentaire): void
{
    $gradeRecord = Note::firstOrNew([
        'id_etudiant' => $student->id_etudiant,
        'id_evaluation' => $this->record->id_evaluation,
    ]);

    // Auto-fill from evaluation
    if (!$gradeRecord->exists) {
        $gradeRecord->id_matiere = $this->record->id_matiere;
        $gradeRecord->id_classe = $this->record->id_classe;
        $gradeRecord->type = $this->record->type;
    }

    // Update provided fields only
    if ($note !== null) $gradeRecord->note = $note;
    if ($commentaire !== null) $gradeRecord->commentaire = $commentaire ?: null;

    $gradeRecord->save();
}
```

### Security Considerations

1. **Permission Check**: `manage grades` permission required
2. **Teacher Restriction**: Verified against `enseignant_matiere_classe` mapping
3. **Input Validation**: Scores validated against evaluation's `note_max`
4. **CSRF Protection**: Built-in Laravel/Filament protection
5. **SQL Injection Prevention**: Eloquent ORM used throughout

## Setup Instructions

### 1. Run Migrations
Ensure all tables exist:
```bash
php artisan migrate
```

### 2. Seed Permissions
```bash
php artisan db:seed --class=RolesAndPermissionsSeeder
```

Or manually create the permission:
```bash
php artisan tinker
>>> \Spatie\Permission\Models\Permission::create(['name' => 'manage grades']);
```

### 3. Assign Permission
```bash
>>> $teacher = \Spatie\Permission\Models\Role::findByName('teacher');
>>> $teacher->givePermissionTo('manage grades');
```

### 4. Clear Cache
```bash
php artisan optimize:clear
```

## Customization

### Modify Table Columns
Edit `table()` method in `ManageGrades.php`:
```php
->columns([
    // Add custom columns here
    Tables\Columns\TextColumn::make('custom_field'),
])
```

### Add Bulk Actions
```php
->bulkActions([
    Tables\Actions\BulkAction::make('custom_action')
        ->label('Custom Action')
        ->action(fn (Collection $records) => /* logic */),
])
```

### Customize Validation
```php
Tables\Columns\TextInputColumn::make('note')
    ->rules([
        'nullable',
        'numeric',
        'min:0',
        'max:' . $this->record->note_max,
        // Add custom rules
        'regex:/^\d+(\.\d{1,2})?$/', // Max 2 decimals
    ])
```

## Troubleshooting

### Issue: "Access Denied" for Teachers
**Solution**: Verify teacher is assigned to the evaluation's class in `enseignant_matiere_classe` table.

### Issue: Grades Not Saving
**Solution**: 
1. Check browser console for JavaScript errors
2. Verify `Note` model relationships
3. Check database permissions

### Issue: Progress Bar Not Updating
**Solution**: The progress is calculated on page load. Refresh the page to see updates.

## Future Enhancements

- [ ] Real-time collaboration (multiple users entering grades)
- [ ] Import grades from CSV/Excel
- [ ] Export grade sheet as PDF
- [ ] Grade statistics (average, median, distribution)
- [ ] Keyboard shortcuts (Tab navigation, Ctrl+S save)
- [ ] Undo/Redo functionality
- [ ] Grade history/audit trail

## Related Resources

- [Filament Documentation](https://filamentphp.com/docs)
- [Spatie Permission](https://spatie.be/docs/laravel-permission)
- Laravel Eloquent ORM

## Support

For issues or questions:
1. Check the troubleshooting section
2. Review Laravel logs: `storage/logs/laravel.log`
3. Inspect browser console for JavaScript errors
4. Verify permissions in database: `model_has_permissions` table
