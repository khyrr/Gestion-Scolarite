<?php

namespace App\Filament\Pages\Settings;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class Security extends Page
{
    protected static ?string $navigationIcon = null;
    
    protected static string $view = 'filament.pages.settings.security';
    
    protected static ?string $title = 'Security Settings';
    
    protected static ?string $slug = 'settings/security';
    
    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'require_2fa' => false,
            'default_session_timeout' => '30',
            'password_reset_enabled' => true,
            'min_password_length' => 8,
            'require_password_complexity' => false,
            'max_login_attempts' => 5,
            'lockout_duration' => 15,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Authentication Policies')
                    ->schema([
                        Forms\Components\Toggle::make('require_2fa')
                            ->label('Require Two-Factor Authentication')
                            ->helperText('Require all users to enable 2FA')
                            ->default(false),
                        Forms\Components\Select::make('default_session_timeout')
                            ->label('Default Session Timeout')
                            ->options([
                                '15' => '15 minutes',
                                '30' => '30 minutes',
                                '60' => '1 hour',
                                '240' => '4 hours',
                                '480' => '8 hours',
                            ])
                            ->default('30'),
                        Forms\Components\Toggle::make('password_reset_enabled')
                            ->label('Allow Password Reset')
                            ->default(true),
                    ])->columns(2),
                
                Forms\Components\Section::make('Password Policies')
                    ->schema([
                        Forms\Components\TextInput::make('min_password_length')
                            ->label('Minimum Password Length')
                            ->numeric()
                            ->minValue(6)
                            ->maxValue(50)
                            ->default(8),
                        Forms\Components\Toggle::make('require_password_complexity')
                            ->label('Require Password Complexity')
                            ->helperText('Require uppercase, lowercase, numbers, and symbols')
                            ->default(false),
                        Forms\Components\TextInput::make('max_login_attempts')
                            ->label('Max Login Attempts')
                            ->numeric()
                            ->minValue(3)
                            ->maxValue(10)
                            ->default(5),
                        Forms\Components\TextInput::make('lockout_duration')
                            ->label('Account Lockout Duration (minutes)')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(1440)
                            ->default(15),
                    ])->columns(2),
                
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('save')
                        ->label('Save Security Settings')
                        ->icon('heroicon-m-shield-check')
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
            ->title('Security settings saved successfully')
            ->success()
            ->send();
    }
}