<?php

namespace App\Filament\Pages\Settings;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class Application extends Page
{
    protected static ?string $navigationIcon = null;
    
    protected static string $view = 'filament.pages.settings.application';
    
    protected static ?string $title = 'Application Settings';
    
    protected static ?string $slug = 'settings/application';
    
    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'maintenance_mode' => false,
            'maintenance_message' => 'The application is currently under maintenance. Please try again later.',
            'allow_registration' => false,
            'default_user_role' => 'student',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Maintenance')
                    ->schema([
                        Forms\Components\Toggle::make('maintenance_mode')
                            ->label('Maintenance Mode')
                            ->helperText('Put the application in maintenance mode')
                            ->default(false),
                        Forms\Components\Textarea::make('maintenance_message')
                            ->label('Maintenance Message')
                            ->placeholder('The application is currently under maintenance. Please try again later.')
                            ->rows(3)
                            ->visible(fn (callable $get) => $get('maintenance_mode')),
                    ]),
                
                Forms\Components\Section::make('Registration & Access')
                    ->schema([
                        Forms\Components\Toggle::make('allow_registration')
                            ->label('Allow User Registration')
                            ->default(false)
                            ->helperText('Allow new users to register accounts'),
                        Forms\Components\Select::make('default_user_role')
                            ->label('Default User Role')
                            ->options([
                                'student' => 'Student',
                                'teacher' => 'Teacher',
                                'parent' => 'Parent',
                            ])
                            ->default('student'),
                    ])->columns(2),
                
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('save')
                        ->label('Save Application Settings')
                        ->icon('heroicon-m-computer-desktop')
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
            ->title('Application settings saved successfully')
            ->success()
            ->send();
    }
}