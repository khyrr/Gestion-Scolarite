# Role-Aware Filament Resources Implementation Guide

## Overview
This guide shows how to implement role-aware behavior in Filament resources where:
- **Admins** see everything and can perform all actions
- **Teachers** see only records related to their classes/students
- **Students** see only their own records

## Key Components

### 1. Base Trait: `HasRoleBasedAccess`
Located in `/app/Filament/Concerns/HasRoleBasedAccess.php`, this trait provides reusable methods for implementing role-based access control.

### 2. Implementation Pattern

#### Step 1: Add the trait to your resource
```php
<?php
namespace App\Filament\Resources;

use App\Filament\Concerns\HasRoleBasedAccess;

class YourResource extends Resource
{
    use HasRoleBasedAccess;
    // ...
}
```

#### Step 2: Implement role-aware permissions
```php
public static function canViewAny(): bool
{
    return auth()->user()->hasRole('super_admin') || 
           auth()->user()->hasRole('enseignant') || 
           auth()->user()->can('manage_permission');
}

public static function canCreate(): bool
{
    // Usually only admins can create
    return auth()->user()->hasRole('super_admin') || auth()->user()->can('manage_permission');
}

public static function canEdit(Model $record): bool
{
    $user = auth()->user();
    
    if ($user->hasRole('super_admin')) {
        return true;
    }
    
    if ($user->hasRole('enseignant')) {
        return static::canTeacherAccessRecord($record);
    }
    
    return false;
}
```

#### Step 3: Add table query scoping
```php
public static function table(Table $table): Table
{
    return $table
        ->modifyQueryUsing(function (Builder $query) {
            return static::applyRoleBasedTableScope($query, [
                'classColumn' => 'id_classe',           // For direct class column
                'classRelation' => 'classe',            // For class relationship
                'studentIdColumn' => 'id_etudiant',     // For student records
                'teacherScope' => true,                 // Whether teachers should see filtered data
                'studentScope' => true,                 // Whether students should see filtered data
            ]);
        })
        ->columns([
            // Your columns here
        ]);
}
```

#### Step 4: Make relationship selects role-aware
```php
Forms\Components\Select::make('id_classe')
    ->relationship('classe', 'nom_classe', function (Builder $query) {
        return static::applyRoleBasedRelationScope($query, [
            'classColumn' => 'id_classe'
        ]);
    })
    ->required()
    ->searchable()
    ->preload(),
```

#### Step 5: Make table actions role-aware
```php
->actions([
    Tables\Actions\ViewAction::make()
        ->visible(function (Model $record) {
            $user = auth()->user();
            
            if ($user->hasRole('super_admin')) {
                return true;
            }
            
            if ($user->hasRole('enseignant')) {
                return static::canTeacherAccessRecord($record);
            }
            
            if ($user->hasRole('etudiant')) {
                return static::canStudentAccessRecord($record);
            }
            
            return false;
        }),
    Tables\Actions\EditAction::make()
        ->visible(fn (Model $record) => static::canEdit($record)),
    Tables\Actions\DeleteAction::make()
        ->visible(fn (Model $record) => static::canDelete($record)),
])
```

## Resource-Specific Examples

### EtudiantResource (Students)
- **Admins**: See all students
- **Teachers**: See only students from their classes
- **Students**: See only their own record

### NoteResource (Grades)
- **Admins**: See all notes
- **Teachers**: See notes for students in their classes
- **Students**: See only their own notes

### ClasseResource (Classes)
- **Admins**: See and manage all classes
- **Teachers**: See only classes they teach (read-only)
- **Students**: See only their own class (read-only)

### EvaluationResource (Evaluations/Exams)
- **Admins**: See all evaluations
- **Teachers**: See evaluations for their classes/subjects
- **Students**: See evaluations for their class

## Advanced Customization

For complex relationships, you can override the trait methods:

```php
protected static function customTeacherScope(Builder $query): Builder
{
    $user = auth()->user();
    $enseignant = $user->profile;
    
    if (!$enseignant) {
        return $query->whereRaw('1 = 0');
    }
    
    // Custom logic for this specific resource
    return $query->whereHas('someComplexRelation', function (Builder $q) use ($enseignant) {
        // Your custom scoping logic
    });
}

// Then use in table:
->modifyQueryUsing(function (Builder $query) {
    return static::applyRoleBasedTableScope($query, [
        'teacherScopeMethod' => 'customTeacherScope'
    ]);
})
```

## Benefits

1. **Consistent Security**: All resources follow the same security model
2. **Single Source of Truth**: Security logic is centralized in the trait
3. **Maintainable**: Easy to update security rules across all resources
4. **Role Flexibility**: Easy to add new roles or modify existing permissions
5. **Performance**: Queries are scoped at the database level

## Navigation Visibility

You can also make navigation items role-aware by checking permissions in the resource or using Filament's built-in navigation authorization.

Remember: This approach ensures that users only see and interact with data they're authorized to access, maintaining both security and user experience.