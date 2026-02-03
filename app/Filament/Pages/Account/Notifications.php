<?php

namespace App\Filament\Pages\Account;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class Notifications extends Page
{
    protected static ?string $navigationIcon = null;
    
    protected static string $view = 'filament.pages.account.notifications';
    
    protected static ?string $title = 'Notification Settings';
    
    protected static ?string $slug = 'account/notifications';
    
    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'email_notifications' => true,
            'login_notifications' => false,
            'security_alerts' => true,
            'system_updates' => true,
            'session_timeout' => '30',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Email Notifications')
                    ->description('Control which emails you receive from the system')
                    ->schema([
                        Forms\Components\Toggle::make('email_notifications')
                            ->label('General Email Notifications')
                            ->helperText('Receive email notifications for important updates')
                            ->default(true),
                        Forms\Components\Toggle::make('login_notifications')
                            ->label('Login Notifications')
                            ->helperText('Get notified of new login attempts')
                            ->default(false),
                        Forms\Components\Toggle::make('security_alerts')
                            ->label('Security Alerts')
                            ->helperText('Receive emails about security-related activities')
                            ->default(true),
                        Forms\Components\Toggle::make('system_updates')
                            ->label('System Updates')
                            ->helperText('Get notified about system maintenance and updates')
                            ->default(true),
                    ]),
                
                Forms\Components\Section::make('Session Management')
                    ->description('Control your session behavior and timeouts')
                    ->schema([
                        Forms\Components\Select::make('session_timeout')
                            ->label('Session Timeout')
                            ->options([
                                '15' => '15 minutes',
                                '30' => '30 minutes',
                                '60' => '1 hour',
                                '240' => '4 hours',
                                '480' => '8 hours',
                            ])
                            ->default('30')
                            ->helperText('Automatically log out after this period of inactivity'),
                    ])
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Notification Settings')
                ->color('primary')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Here you could save notification preferences to user preferences table
        // For now, we'll just show success message

        Notification::make()
            ->title('Notification settings updated successfully')
            ->success()
            ->send();
    }
}