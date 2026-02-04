<?php

namespace App\Filament\Pages\Settings;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use App\Services\SettingsService;

class Application extends Page
{
    protected static ?string $navigationIcon = null;
    
    protected static string $view = 'filament.pages.settings.application';
    
    protected static ?string $title = 'Application Settings';
    
    protected static ?string $slug = 'settings/application';
    
    protected static bool $shouldRegisterNavigation = false;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin') || auth()->user()?->hasPermissionTo('manage settings');
    }

    public ?array $data = [];

    protected SettingsService $settingsService;

    public function boot(SettingsService $settingsService): void
    {
        $this->settingsService = $settingsService;
    }

    public function mount(): void
    {
        $applicationSettings = $this->settingsService->getApplicationSettings();
        
        $this->form->fill([
            'app_name' => $applicationSettings['app_name'],
            'default_user_role' => $applicationSettings['default_user_role'],
            'registration_enabled' => $applicationSettings['registration_enabled'],
            'email_verification_required' => $applicationSettings['email_verification_required'],
            'notifications_enabled' => $applicationSettings['notifications_enabled'],
            'file_upload_max_size' => $applicationSettings['file_upload_max_size'],
            'backup_frequency' => $applicationSettings['backup_frequency'],
            'auto_backup_enabled' => $applicationSettings['auto_backup_enabled'],
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Application Information')
                    ->description('Basic application configuration')
                    ->schema([
                        Forms\Components\TextInput::make('app_name')
                            ->label('Application Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('default_user_role')
                            ->label('Default User Role')
                            ->options([
                                'student' => 'Student',
                                'teacher' => 'Teacher',
                                'parent' => 'Parent',
                                'staff' => 'Staff',
                            ])
                            ->required(),
                    ])->columns(2),
                
                Forms\Components\Section::make('User Registration & Access')
                    ->description('Configure user registration and verification')
                    ->schema([
                        Forms\Components\Toggle::make('registration_enabled')
                            ->label('Allow User Registration')
                            ->helperText('Enable new user registration'),
                        Forms\Components\Toggle::make('email_verification_required')
                            ->label('Require Email Verification')
                            ->helperText('Require email verification for new accounts'),
                        Forms\Components\Toggle::make('notifications_enabled')
                            ->label('Enable System Notifications')
                            ->helperText('Allow system to send notifications to users'),
                    ])->columns(2),
                
                Forms\Components\Section::make('File Management')
                    ->description('Configure file upload and storage settings')
                    ->schema([
                        Forms\Components\TextInput::make('file_upload_max_size')
                            ->label('Maximum File Upload Size (MB)')
                            ->integer()
                            ->minValue(1)
                            ->maxValue(100)
                            ->required(),
                    ])->columns(2),
                
                Forms\Components\Section::make('System Backup')
                    ->description('Configure automatic backup settings')
                    ->schema([
                        Forms\Components\Toggle::make('auto_backup_enabled')
                            ->label('Enable Automatic Backups')
                            ->helperText('Enable scheduled automatic backups'),
                        Forms\Components\Select::make('backup_frequency')
                            ->label('Backup Frequency')
                            ->options([
                                'daily' => 'Daily',
                                'weekly' => 'Weekly',
                                'monthly' => 'Monthly',
                            ])
                            ->required(),
                    ])->columns(2),
                
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('save')
                        ->label('Save Changes')
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

        $applicationData = [
            'app_name' => $data['app_name'],
            'default_user_role' => $data['default_user_role'],
            'registration_enabled' => $data['registration_enabled'],
            'email_verification_required' => $data['email_verification_required'],
            'notifications_enabled' => $data['notifications_enabled'],
            'file_upload_max_size' => (int) $data['file_upload_max_size'],
            'backup_frequency' => $data['backup_frequency'],
            'auto_backup_enabled' => $data['auto_backup_enabled'],
        ];

        $this->settingsService->updateApplicationSettings($applicationData);

        Notification::make()
            ->title('Application settings saved successfully')
            ->success()
            ->send()
            ->refresh();
    }
}