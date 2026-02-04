<?php

namespace App\Filament\Pages\Settings;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use App\Services\SettingsService;

class Security extends Page
{
    protected static ?string $navigationIcon = null;
    
    protected static string $view = 'filament.pages.settings.security';
    
    protected static ?string $title = 'Security Settings';
    
    protected static ?string $slug = 'settings/security';
    
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
        $securitySettings = $this->settingsService->getSecuritySettings();
        
        $this->form->fill([
            'two_factor_required' => $securitySettings['two_factor_required'],
            'session_timeout' => $securitySettings['session_timeout'],
            'password_min_length' => $securitySettings['password_min_length'],
            'password_require_uppercase' => $securitySettings['password_require_uppercase'],
            'password_require_lowercase' => $securitySettings['password_require_lowercase'],
            'password_require_numbers' => $securitySettings['password_require_numbers'],
            'password_require_symbols' => $securitySettings['password_require_symbols'],
            'max_login_attempts' => $securitySettings['max_login_attempts'],
            'lockout_duration' => $securitySettings['lockout_duration'],
            'password_expiry_days' => $securitySettings['password_expiry_days'],
            'force_https' => $securitySettings['force_https'],
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Authentication Policies')
                    ->description('Configure authentication and session security')
                    ->schema([
                        Forms\Components\Toggle::make('two_factor_required')
                            ->label('Require Two-Factor Authentication')
                            ->helperText('Require all users to enable 2FA for account access'),
                        Forms\Components\Select::make('session_timeout')
                            ->label('Session Timeout (minutes)')
                            ->options([
                                '15' => '15 minutes',
                                '30' => '30 minutes',
                                '60' => '1 hour',
                                '120' => '2 hours',
                                '240' => '4 hours',
                                '480' => '8 hours',
                            ])
                            ->required(),
                        Forms\Components\Toggle::make('force_https')
                            ->label('Force HTTPS')
                            ->helperText('Require secure HTTPS connections for all requests'),
                    ])->columns(2),
                
                Forms\Components\Section::make('Password Policies')
                    ->description('Configure password strength and requirements')
                    ->schema([
                        Forms\Components\TextInput::make('password_min_length')
                            ->label('Minimum Password Length')
                            ->integer()
                            ->minValue(6)
                            ->maxValue(50)
                            ->required(),
                        Forms\Components\Toggle::make('password_require_uppercase')
                            ->label('Require Uppercase Letters')
                            ->helperText('Passwords must contain at least one uppercase letter'),
                        Forms\Components\Toggle::make('password_require_lowercase')
                            ->label('Require Lowercase Letters')
                            ->helperText('Passwords must contain at least one lowercase letter'),
                        Forms\Components\Toggle::make('password_require_numbers')
                            ->label('Require Numbers')
                            ->helperText('Passwords must contain at least one number'),
                        Forms\Components\Toggle::make('password_require_symbols')
                            ->label('Require Special Characters')
                            ->helperText('Passwords must contain at least one special character'),
                        Forms\Components\TextInput::make('password_expiry_days')
                            ->label('Password Expiry (days)')
                            ->integer()
                            ->minValue(0)
                            ->maxValue(365)
                            ->helperText('Set to 0 to disable password expiration'),
                    ])->columns(2),
                
                Forms\Components\Section::make('Account Security')
                    ->description('Configure login attempts and lockout policies')
                    ->schema([
                        Forms\Components\TextInput::make('max_login_attempts')
                            ->label('Maximum Login Attempts')
                            ->integer()
                            ->minValue(3)
                            ->maxValue(10)
                            ->required(),
                        Forms\Components\TextInput::make('lockout_duration')
                            ->label('Account Lockout Duration (minutes)')
                            ->integer()
                            ->minValue(1)
                            ->maxValue(1440)
                            ->required(),
                    ])->columns(2),
                
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('save')
                        ->label('Save Security Settings')
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

        $securityData = [
            'two_factor_required' => $data['two_factor_required'],
            'session_timeout' => (int) $data['session_timeout'],
            'password_min_length' => (int) $data['password_min_length'],
            'password_require_uppercase' => $data['password_require_uppercase'],
            'password_require_lowercase' => $data['password_require_lowercase'],
            'password_require_numbers' => $data['password_require_numbers'],
            'password_require_symbols' => $data['password_require_symbols'],
            'max_login_attempts' => (int) $data['max_login_attempts'],
            'lockout_duration' => (int) $data['lockout_duration'],
            'password_expiry_days' => (int) $data['password_expiry_days'],
            'force_https' => $data['force_https'],
        ];

        $this->settingsService->updateSecuritySettings($securityData);

        Notification::make()
            ->title('Security settings saved successfully')
            ->success()
            ->send();
    }
}