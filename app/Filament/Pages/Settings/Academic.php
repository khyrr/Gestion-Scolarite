<?php

namespace App\Filament\Pages\Settings;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class Academic extends Page
{
    protected static ?string $navigationIcon = null;
    
    protected static string $view = 'filament.pages.settings.academic';
    
    protected static ?string $title = 'Academic Settings';
    
    protected static ?string $slug = 'settings/academic';
    
    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'current_academic_year' => '2025-2026',
            'academic_year_start' => now()->startOfYear(),
            'academic_year_end' => now()->endOfYear(),
            'grading_scale' => '0-20',
            'passing_grade' => 10,
            'allow_grade_modification' => true,
            'enable_attendance' => true,
            'enable_parent_portal' => true,
            'attendance_threshold' => 75,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Academic Year')
                    ->schema([
                        Forms\Components\TextInput::make('current_academic_year')
                            ->label('Current Academic Year')
                            ->placeholder('2025-2026')
                            ->required(),
                        Forms\Components\DatePicker::make('academic_year_start')
                            ->label('Academic Year Start Date')
                            ->required(),
                        Forms\Components\DatePicker::make('academic_year_end')
                            ->label('Academic Year End Date')
                            ->required(),
                    ])->columns(3),
                
                Forms\Components\Section::make('Grading System')
                    ->schema([
                        Forms\Components\Select::make('grading_scale')
                            ->label('Grading Scale')
                            ->options([
                                '0-20' => '0-20 Scale',
                                'A-F' => 'Letter Grades (A-F)',
                                '0-100' => '0-100 Percentage',
                                'custom' => 'Custom Scale',
                            ])
                            ->default('0-20'),
                        Forms\Components\TextInput::make('passing_grade')
                            ->label('Minimum Passing Grade')
                            ->numeric()
                            ->default(10),
                        Forms\Components\Toggle::make('allow_grade_modification')
                            ->label('Allow Grade Modification')
                            ->helperText('Allow teachers to modify submitted grades')
                            ->default(true),
                    ])->columns(2),
                
                Forms\Components\Section::make('Features')
                    ->schema([
                        Forms\Components\Toggle::make('enable_attendance')
                            ->label('Enable Attendance Tracking')
                            ->default(true),
                        Forms\Components\Toggle::make('enable_parent_portal')
                            ->label('Enable Parent Portal')
                            ->default(true),
                        Forms\Components\TextInput::make('attendance_threshold')
                            ->label('Minimum Attendance Percentage')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->default(75)
                            ->suffix('%'),
                    ])->columns(2),
                
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('save')
                        ->label('Save Academic Settings')
                        ->icon('heroicon-m-academic-cap')
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

        // Save settings logic here
        Notification::make()
            ->title('Academic settings saved successfully')
            ->success()
            ->send();
    }
}