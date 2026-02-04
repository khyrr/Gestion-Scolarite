<?php

namespace App\Filament\Pages\Settings;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use App\Services\SettingsService;

class System extends Page
{
    protected static ?string $navigationIcon = null;
    
    protected static string $view = 'filament.pages.settings.system';
    
    protected static ?string $title = 'System Settings';
    
    protected static ?string $slug = 'settings/system';
    
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
        $organizationSettings = $this->settingsService->getOrganizationSettings();
        $systemSettings = $this->settingsService->getSystemSettings();
        
        $this->form->fill([
            // Organization Settings
            'school_name' => $organizationSettings['school_name'],
            'school_address' => $organizationSettings['school_address'],
            'school_phone' => $organizationSettings['school_phone'],
            'school_email' => $organizationSettings['school_email'],
            'school_website' => $organizationSettings['school_website'],
            'academic_year_start' => $organizationSettings['academic_year_start'],
            'academic_year_end' => $organizationSettings['academic_year_end'],
            
            // System Settings
            'timezone' => $systemSettings['timezone'],
            'date_format' => $systemSettings['date_format'],
            'language' => $systemSettings['language'],
            'currency' => $systemSettings['currency'],
            'items_per_page' => $systemSettings['items_per_page'],
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Organization Information')
                    ->description('Configure your institution\'s basic information')
                    ->schema([
                        Forms\Components\TextInput::make('school_name')
                            ->label('School Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('school_address')
                            ->label('School Address')
                            ->rows(3),
                        Forms\Components\TextInput::make('school_phone')
                            ->label('Phone Number')
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('school_email')
                            ->label('Email Address')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('school_website')
                            ->label('Website')
                            ->url()
                            ->maxLength(255),
                    ])->columns(2),
                
                Forms\Components\Section::make('Academic Year')
                    ->description('Configure your academic year dates')
                    ->schema([
                        Forms\Components\TextInput::make('academic_year_start')
                            ->label('Academic Year Start (MM-DD)')
                            ->placeholder('09-01')
                            ->helperText('Format: MM-DD (e.g., 09-01 for September 1st)')
                            ->maxLength(5),
                        Forms\Components\TextInput::make('academic_year_end')
                            ->label('Academic Year End (MM-DD)')
                            ->placeholder('06-30')
                            ->helperText('Format: MM-DD (e.g., 06-30 for June 30th)')
                            ->maxLength(5),
                    ])->columns(2),
                
                Forms\Components\Section::make('Regional Settings')
                    ->description('Configure timezone, language, and currency settings')
                    ->schema([
                        Forms\Components\Select::make('timezone')
                            ->label('Default Timezone')
                            ->options([
                                'UTC' => 'UTC (UTC+0)',
                                'Africa/Casablanca' => 'Africa/Casablanca (UTC+1)',
                                'Africa/Tunis' => 'Africa/Tunis (UTC+1)',
                                'Africa/Algiers' => 'Africa/Algiers (UTC+1)',
                                'Europe/Paris' => 'Europe/Paris (UTC+1)',
                                'America/New_York' => 'America/New_York (UTC-5)',
                                'America/Los_Angeles' => 'America/Los_Angeles (UTC-8)',
                            ])
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('language')
                            ->label('Default Language')
                            ->options([
                                'en' => 'English',
                                'fr' => 'Français',
                                'ar' => 'العربية',
                                'es' => 'Español',
                            ])
                            ->required(),
                        Forms\Components\Select::make('currency')
                            ->label('Default Currency')
                            ->options([
                                'USD' => 'US Dollar (USD)',
                                'EUR' => 'Euro (EUR)',
                                'MAD' => 'Moroccan Dirham (MAD)',
                                'TND' => 'Tunisian Dinar (TND)',
                                'DZD' => 'Algerian Dinar (DZD)',
                            ])
                            ->required(),
                        Forms\Components\Select::make('date_format')
                            ->label('Date Format')
                            ->options([
                                'Y-m-d' => 'YYYY-MM-DD (2024-12-31)',
                                'd/m/Y' => 'DD/MM/YYYY (31/12/2024)',
                                'm/d/Y' => 'MM/DD/YYYY (12/31/2024)',
                                'd-m-Y' => 'DD-MM-YYYY (31-12-2024)',
                            ])
                            ->required(),
                    ])->columns(2),
                
                Forms\Components\Section::make('System Preferences')
                    ->description('Configure system-wide preferences')
                    ->schema([
                        Forms\Components\Select::make('items_per_page')
                            ->label('Items Per Page')
                            ->options([
                                '10' => '10',
                                '25' => '25',
                                '50' => '50',
                                '100' => '100',
                            ])
                            ->required(),
                    ]),
                
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('save')
                        ->label('Save System Settings')
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

        // Save organization settings
        $organizationData = [
            'school_name' => $data['school_name'],
            'school_address' => $data['school_address'],
            'school_phone' => $data['school_phone'],
            'school_email' => $data['school_email'],
            'school_website' => $data['school_website'],
            'academic_year_start' => $data['academic_year_start'],
            'academic_year_end' => $data['academic_year_end'],
        ];
        $this->settingsService->updateOrganizationSettings($organizationData);

        // Save system settings
        $systemData = [
            'timezone' => $data['timezone'],
            'date_format' => $data['date_format'],
            'language' => $data['language'],
            'currency' => $data['currency'],
            'items_per_page' => (int) $data['items_per_page'],
        ];
        $this->settingsService->updateSystemSettings($systemData);

        Notification::make()
            ->title('System settings saved successfully')
            ->success()
            ->send();
    }
}