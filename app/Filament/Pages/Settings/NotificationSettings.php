<?php

namespace App\Filament\Pages\Settings;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use App\Services\SettingsService;
use App\Support\NotificationKeys;

class NotificationSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-bell';
    
    protected static string $view = 'filament.pages.settings.notification-settings';
    
    protected static ?string $title = 'Notification Settings';
    
    protected static ?string $slug = 'settings/notifications';
    
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
        $this->form->fill([
            // Academic Notifications
            'enable_grade_published' => $this->settingsService->get('notifications.grade_published.enabled', true),
            'enable_evaluation_created' => $this->settingsService->get('notifications.evaluation_created.enabled', true),
            
            // Financial Notifications
            'enable_teacher_payment' => $this->settingsService->get('notifications.teacher_payment.enabled', true),
            'enable_student_payment' => $this->settingsService->get('notifications.student_payment.enabled', true),
            
            // Security Notifications
            'enable_lockout' => $this->settingsService->get('notifications.lockout.enabled', true),
            'enable_security_alert' => $this->settingsService->get('notifications.security_alert.enabled', true),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Academic Notifications')
                    ->description('Control notifications for grades and evaluations')
                    ->schema([
                        Forms\Components\Toggle::make('enable_grade_published')
                            ->label('Grade Published Notifications')
                            ->helperText('Send notifications when grades are published to students')
                            ->inline(false),
                            
                        Forms\Components\Toggle::make('enable_evaluation_created')
                            ->label('Evaluation Created Notifications')
                            ->helperText('Send notifications when new evaluations are created')
                            ->inline(false),
                    ]),
                
                Forms\Components\Section::make('Financial Notifications')
                    ->description('Control payment-related notifications')
                    ->schema([
                        Forms\Components\Toggle::make('enable_teacher_payment')
                            ->label('Teacher Payment Notifications')
                            ->helperText('Send notifications when teacher payments are processed')
                            ->inline(false),
                            
                        Forms\Components\Toggle::make('enable_student_payment')
                            ->label('Student Payment Notifications')
                            ->helperText('Send notifications when student payments are received')
                            ->inline(false),
                    ]),
                
                Forms\Components\Section::make('Security Notifications')
                    ->description('Control security-related notifications')
                    ->schema([
                        Forms\Components\Toggle::make('enable_lockout')
                            ->label('Account Lockout Notifications')
                            ->helperText('Send notifications when accounts are locked due to failed login attempts')
                            ->inline(false),
                            
                        Forms\Components\Toggle::make('enable_security_alert')
                            ->label('Security Alert Notifications')
                            ->helperText('Send notifications for critical security events')
                            ->inline(false),
                    ]),
                
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('save')
                        ->label('Save Notification Settings')
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
        
        // Save all notification settings
        $this->settingsService->set('notifications.grade_published.enabled', $data['enable_grade_published']);
        $this->settingsService->set('notifications.evaluation_created.enabled', $data['enable_evaluation_created']);
        $this->settingsService->set('notifications.teacher_payment.enabled', $data['enable_teacher_payment']);
        $this->settingsService->set('notifications.student_payment.enabled', $data['enable_student_payment']);
        $this->settingsService->set('notifications.lockout.enabled', $data['enable_lockout']);
        $this->settingsService->set('notifications.security_alert.enabled', $data['enable_security_alert']);
        
        Notification::make()
            ->title('Notification settings updated successfully')
            ->success()
            ->send();
    }
}
