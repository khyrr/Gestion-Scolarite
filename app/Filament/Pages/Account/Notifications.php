<?php

namespace App\Filament\Pages\Account;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use App\Models\NotificationPreference;
use App\Support\NotificationKeys;
use App\Support\NotificationChannels;
use Illuminate\Support\Facades\DB;

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
        $user = auth()->user();
        
        // Load existing preferences or default to true
        $preferences = NotificationPreference::where('user_id', $user->id)
            ->get()
            ->groupBy('key');

        $this->form->fill([
            // Login Notifications
            'login_attempt_mail' => $this->getPreference($preferences, NotificationKeys::LOGIN_ATTEMPT, NotificationChannels::MAIL),
            'login_attempt_database' => $this->getPreference($preferences, NotificationKeys::LOGIN_ATTEMPT, NotificationChannels::DATABASE),
            
            // Security Alerts
            'security_alert_mail' => $this->getPreference($preferences, NotificationKeys::SECURITY_ALERT, NotificationChannels::MAIL),
            'security_alert_database' => $this->getPreference($preferences, NotificationKeys::SECURITY_ALERT, NotificationChannels::DATABASE),
            
            // System Updates
            'system_update_mail' => $this->getPreference($preferences, NotificationKeys::SYSTEM_UPDATE, NotificationChannels::MAIL),
            'system_update_database' => $this->getPreference($preferences, NotificationKeys::SYSTEM_UPDATE, NotificationChannels::DATABASE),
            
            // Academic Updates (Grades)
            'grade_published_mail' => $this->getPreference($preferences, NotificationKeys::GRADE_PUBLISHED, NotificationChannels::MAIL),
            'grade_published_database' => $this->getPreference($preferences, NotificationKeys::GRADE_PUBLISHED, NotificationChannels::DATABASE),
        ]);
    }

    protected function getPreference($preferences, $key, $channel): bool
    {
        if (isset($preferences[$key])) {
            $pref = $preferences[$key]->firstWhere('channel', $channel);
            return $pref ? $pref->enabled : true; // Default to true if not found
        }
        return true;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Security Notifications')
                    ->description('Manage alerts related to your account security')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Placeholder::make('label_login')
                                    ->label('Login Attempts')
                                    ->content('Get notified when a new login occurs.'),
                                Forms\Components\Toggle::make('login_attempt_mail')
                                    ->label('Email'),
                                Forms\Components\Toggle::make('login_attempt_database')
                                    ->label('In-App'),
                            ]),
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Placeholder::make('label_security')
                                    ->label('Security Alerts')
                                    ->content('Critical security warnings and password changes.'),
                                Forms\Components\Toggle::make('security_alert_mail')
                                    ->label('Email'),
                                Forms\Components\Toggle::make('security_alert_database')
                                    ->label('In-App'),
                            ]),
                    ]),

                Forms\Components\Section::make('System Notifications')
                    ->description('Updates about system maintenance and new features')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Placeholder::make('label_system')
                                    ->label('System Updates')
                                    ->content('Maintenance schedules and feature releases.'),
                                Forms\Components\Toggle::make('system_update_mail')
                                    ->label('Email'),
                                Forms\Components\Toggle::make('system_update_database')
                                    ->label('In-App'),
                            ]),
                    ]),
                
                Forms\Components\Section::make('Academic Notifications')
                    ->description('Grades, assignments, and course updates')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Placeholder::make('label_grades')
                                    ->label('Grade Published')
                                    ->content('When a new grade is posted.'),
                                Forms\Components\Toggle::make('grade_published_mail')
                                    ->label('Email'),
                                Forms\Components\Toggle::make('grade_published_database')
                                    ->label('In-App'),
                            ]),
                    ]),

                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('save')
                        ->label('Save Preferences')
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
        $user = auth()->user();

        DB::transaction(function () use ($user, $data) {
            $this->savePreference($user, NotificationKeys::LOGIN_ATTEMPT, NotificationChannels::MAIL, $data['login_attempt_mail']);
            $this->savePreference($user, NotificationKeys::LOGIN_ATTEMPT, NotificationChannels::DATABASE, $data['login_attempt_database']);
            
            $this->savePreference($user, NotificationKeys::SECURITY_ALERT, NotificationChannels::MAIL, $data['security_alert_mail']);
            $this->savePreference($user, NotificationKeys::SECURITY_ALERT, NotificationChannels::DATABASE, $data['security_alert_database']);
            
            $this->savePreference($user, NotificationKeys::SYSTEM_UPDATE, NotificationChannels::MAIL, $data['system_update_mail']);
            $this->savePreference($user, NotificationKeys::SYSTEM_UPDATE, NotificationChannels::DATABASE, $data['system_update_database']);
            
            $this->savePreference($user, NotificationKeys::GRADE_PUBLISHED, NotificationChannels::MAIL, $data['grade_published_mail']);
            $this->savePreference($user, NotificationKeys::GRADE_PUBLISHED, NotificationChannels::DATABASE, $data['grade_published_database']);
        });

        Notification::make()
            ->title('Notification preferences updated successfully')
            ->success()
            ->send();
    }

    protected function savePreference($user, $key, $channel, $enabled): void
    {
        NotificationPreference::updateOrCreate(
            [
                'user_id' => $user->id,
                'key' => $key,
                'channel' => $channel,
            ],
            [
                'enabled' => $enabled
            ]
        );
    }
}