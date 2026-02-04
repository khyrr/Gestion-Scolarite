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
        $organizationSettings = $this->settingsService->getSchoolSettings();
        $systemSettings = $this->settingsService->getSystemSettings();
        
        $this->form->fill([
            // Organization Settings
            'school_name' => $organizationSettings['school.name'],
            'school_address' => $organizationSettings['school.address'],
            'school_phone' => $organizationSettings['school.phone'],
            'school_email' => $organizationSettings['school.email'],
            'school_website' => $organizationSettings['school.website'],
            'school_location' => $organizationSettings['school.location'],
            'school_latitude' => $organizationSettings['school.latitude'],
            'school_longitude' => $organizationSettings['school.longitude'],
            'academic_year_start' => $organizationSettings['school.academic_year_start'],
            'academic_year_end' => $organizationSettings['school.academic_year_end'],
            
            // System Settings
            'timezone' => $systemSettings['system.timezone'],
            'date_format' => $systemSettings['system.date_format'],
            'language' => $systemSettings['system.language'],
            'currency' => $systemSettings['system.currency'],
            'items_per_page' => $systemSettings['system.items_per_page'],
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
                        Forms\Components\TextInput::make('school_location')
                            ->label('Location/City')
                            ->maxLength(255)
                            ->helperText('e.g., Paris, London, New York'),
                    ])->columns(2),

                Forms\Components\Section::make('Map Coordinates')
                    ->description('Set the exact location coordinates for your school to display on the contact page map')
                    ->schema([
                        Forms\Components\TextInput::make('school_latitude')
                            ->label('Latitude')
                            ->numeric()
                            ->minValue(-90)
                            ->maxValue(90)
                            ->step('any')
                            ->reactive()
                            ->helperText('e.g., 48.8566 (for Paris)'),
                        Forms\Components\TextInput::make('school_longitude')
                            ->label('Longitude')
                            ->numeric()
                            ->minValue(-180)
                            ->maxValue(180)
                            ->step('any')
                            ->reactive()
                            ->helperText('e.g., 2.3522 (for Paris)'),
                        Forms\Components\Placeholder::make('coordinate_helper')
                            ->label('')
                            ->content(fn() => new \Illuminate\Support\HtmlString(
                                '<div x-data="{ 
                                    status: \'\',
                                    statusClass: \'\',
                                    loading: false,
                                    getCurrentLocation() {
                                        if (!navigator.geolocation) {
                                            this.status = \'Geolocation is not supported by your browser\';
                                            this.statusClass = \'text-red-600\';
                                            return;
                                        }
                                        
                                        this.status = \'Getting location...\';
                                        this.statusClass = \'text-blue-600\';
                                        this.loading = true;
                                        
                                        navigator.geolocation.getCurrentPosition(
                                            (position) => {
                                                const lat = position.coords.latitude.toFixed(6);
                                                const lng = position.coords.longitude.toFixed(6);
                                                
                                                // Use $wire to update Livewire component
                                                $wire.set(\'data.school_latitude\', lat);
                                                $wire.set(\'data.school_longitude\', lng);
                                                
                                                this.status = \'Location set successfully! (\' + lat + \', \' + lng + \')\';
                                                this.statusClass = \'text-green-600 font-medium\';
                                                this.loading = false;
                                            },
                                            (error) => {
                                                let errorMessage = \'Error getting location\';
                                                switch(error.code) {
                                                    case error.PERMISSION_DENIED:
                                                        errorMessage = \'Location access denied. Please enable location permissions.\';
                                                        break;
                                                    case error.POSITION_UNAVAILABLE:
                                                        errorMessage = \'Location information is unavailable.\';
                                                        break;
                                                    case error.TIMEOUT:
                                                        errorMessage = \'Location request timed out.\';
                                                        break;
                                                }
                                                this.status = errorMessage;
                                                this.statusClass = \'text-red-600\';
                                                this.loading = false;
                                            },
                                            { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
                                        );
                                    }
                                }">' .
                                '<div class="text-sm text-gray-600 mb-4">' .
                                '<p class="mb-2"><strong>Quick Setup:</strong></p>' .
                                '<button type="button" @click="getCurrentLocation()" :disabled="loading" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50">' .
                                '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>' .
                                '<span x-show="!loading">Get Current Location</span>' .
                                '<span x-show="loading">Getting...</span>' .
                                '</button>' .
                                '<span x-text="status" :class="statusClass" class="ml-3 text-sm"></span>' .
                                '</div>' .
                                '<div class="text-sm text-gray-600 mt-4 pt-4 border-t">' .
                                '<p class="mb-2"><strong>Or manually get coordinates:</strong></p>' .
                                '<ol class="list-decimal list-inside space-y-1">' .
                                '<li>Go to <a href="https://www.google.com/maps" target="_blank" class="text-primary-600 hover:underline">Google Maps</a></li>' .
                                '<li>Find your school location</li>' .
                                '<li>Right-click on the location and select "What\'s here?"</li>' .
                                '<li>Copy the coordinates (Latitude, Longitude)</li>' .
                                '</ol>' .
                                '</div>' .
                                '</div>'
                            )),
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
            'school.name' => $data['school_name'],
            'school.address' => $data['school_address'],
            'school.phone' => $data['school_phone'],
            'school.email' => $data['school_email'],
            'school.website' => $data['school_website'],
            'school.location' => $data['school_location'],
            'school.latitude' => $data['school_latitude'] ?? '',
            'school.longitude' => $data['school_longitude'] ?? '',
            'school.academic_year_start' => $data['academic_year_start'],
            'school.academic_year_end' => $data['academic_year_end'],
        ];
        $this->settingsService->updateSchoolSettings($organizationData);

        // Save system settings
        $systemData = [
            'system.timezone' => $data['timezone'],
            'system.date_format' => $data['date_format'],
            'system.language' => $data['language'],
            'system.currency' => $data['currency'],
            'system.items_per_page' => (int) $data['items_per_page'],
        ];
        $this->settingsService->updateSystemSettings($systemData);

        Notification::make()
            ->title('System settings saved successfully')
            ->success()
            ->send();
    }
}