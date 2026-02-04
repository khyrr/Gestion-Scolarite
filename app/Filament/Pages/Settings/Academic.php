<?php

namespace App\Filament\Pages\Settings;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use App\Services\SettingsService;

class Academic extends Page
{
    protected static ?string $navigationIcon = null;
    
    protected static string $view = 'filament.pages.settings.academic';
    
    protected static ?string $title = 'Academic Settings';
    
    protected static ?string $slug = 'settings/academic';
    
    protected static bool $shouldRegisterNavigation = false;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin') || auth()->user()?->hasPermissionTo('setting.manage');
    }

    public ?array $data = [];

    protected SettingsService $settingsService;

    public function boot(SettingsService $settingsService): void
    {
        $this->settingsService = $settingsService;
    }

    public function mount(): void
    {
        $academicSettings = $this->settingsService->getAcademicSettings();
        
        $this->form->fill([
            'grading_system' => $academicSettings['academic.grading_system'],
            'passing_grade' => $academicSettings['academic.passing_grade'],
            'max_grade' => $academicSettings['academic.max_grade'],
            'terms_per_year' => $academicSettings['academic.terms_per_year'],
            'attendance_required' => $academicSettings['academic.attendance_required'],
            'min_attendance_percentage' => $academicSettings['academic.min_attendance_percentage'],
            'late_submission_penalty' => $academicSettings['academic.late_submission_penalty'],
            'max_absences_per_term' => $academicSettings['academic.max_absences_per_term'],
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Grading System')
                    ->description('Configure grading scales and academic standards')
                    ->schema([
                        Forms\Components\Select::make('grading_system')
                            ->label('Grading System')
                            ->options([
                                'percentage' => 'Percentage (0-100)',
                                'gpa' => 'GPA (0-4.0)',
                                'letter' => 'Letter Grades (A-F)',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('passing_grade')
                            ->label('Passing Grade')
                            ->integer()
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix('%')
                            ->required(),
                        Forms\Components\TextInput::make('max_grade')
                            ->label('Maximum Grade')
                            ->integer()
                            ->minValue(50)
                            ->maxValue(100)
                            ->suffix('%')
                            ->required(),
                    ])->columns(3),
                
                Forms\Components\Section::make('Academic Structure')
                    ->description('Configure academic year and term structure')
                    ->schema([
                        Forms\Components\Select::make('terms_per_year')
                            ->label('Terms Per Academic Year')
                            ->options([
                                '1' => '1 Term (Annual)',
                                '2' => '2 Terms (Semesters)',
                                '3' => '3 Terms (Trimesters)',
                                '4' => '4 Terms (Quarters)',
                            ])
                            ->required(),
                    ])->columns(2),
                
                Forms\Components\Section::make('Attendance Policies')
                    ->description('Configure attendance tracking and requirements')
                    ->schema([
                        Forms\Components\Toggle::make('attendance_required')
                            ->label('Attendance Tracking Required')
                            ->helperText('Enable mandatory attendance tracking for all courses'),
                        Forms\Components\TextInput::make('min_attendance_percentage')
                            ->label('Minimum Attendance Required (%)')
                            ->integer()
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix('%')
                            ->required(),
                        Forms\Components\TextInput::make('max_absences_per_term')
                            ->label('Maximum Absences Per Term')
                            ->integer()
                            ->minValue(0)
                            ->maxValue(50)
                            ->required(),
                    ])->columns(2),
                
                Forms\Components\Section::make('Assignment Policies')
                    ->description('Configure assignment and submission policies')
                    ->schema([
                        Forms\Components\TextInput::make('late_submission_penalty')
                            ->label('Late Submission Penalty (%)')
                            ->integer()
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix('%')
                            ->helperText('Percentage penalty for late assignments'),
                    ])->columns(2),
                
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('save')
                        ->label('Save changes')
                        ->icon('heroicon-m-check-circle')
                        ->color('primary')
                        ->action(function () {
                            $this->save();
                        }),
                ])
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $academicData = [
            'academic.grading_system' => $data['grading_system'],
            'academic.passing_grade' => (int) $data['passing_grade'],
            'academic.max_grade' => (int) $data['max_grade'],
            'academic.terms_per_year' => (int) $data['terms_per_year'],
            'academic.attendance_required' => $data['attendance_required'],
            'academic.min_attendance_percentage' => (int) $data['min_attendance_percentage'],
            'academic.max_absences_per_term' => (int) $data['max_absences_per_term'],
            'academic.late_submission_penalty' => (int) $data['late_submission_penalty'],
        ];

        $this->settingsService->updateAcademicSettings($academicData);

        Notification::make()
            ->title('Academic settings saved successfully')
            ->success()
            ->send();
    }
}