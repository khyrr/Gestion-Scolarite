<?php

namespace App\Filament\Pages\Settings;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class System extends Page
{
    protected static ?string $navigationIcon = null;
    
    protected static string $view = 'filament.pages.settings.system';
    
    protected static ?string $title = 'System Settings';
    
    protected static ?string $slug = 'settings/system';
    
    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'organization_name' => config('app.name', 'School Management'),
            'organization_code' => 'SCH001',
            'organization_email' => config('mail.from.address'),
            'default_timezone' => 'Africa/Casablanca',
            'default_language' => 'fr',
            'default_currency' => 'MAD',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Organization')
                    ->schema([
                        Forms\Components\TextInput::make('organization_name')
                            ->label('Organization Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('organization_code')
                            ->label('Organization Code')
                            ->required()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('organization_email')
                            ->label('Organization Email')
                            ->email()
                            ->required(),
                        Forms\Components\Textarea::make('organization_description')
                            ->label('Description')
                            ->rows(3),
                    ])->columns(2),
                
                Forms\Components\Section::make('Regional Settings')
                    ->schema([
                        Forms\Components\Select::make('default_timezone')
                            ->label('Default Timezone')
                            ->options([
                                'Africa/Casablanca' => 'Africa/Casablanca (UTC+1)',
                                'Africa/Tunis' => 'Africa/Tunis (UTC+1)',
                                'Africa/Algiers' => 'Africa/Algiers (UTC+1)',
                                'UTC' => 'UTC (UTC+0)',
                            ])
                            ->default('Africa/Casablanca'),
                        Forms\Components\Select::make('default_language')
                            ->label('Default Language')
                            ->options([
                                'fr' => 'Français',
                                'ar' => 'العربية',
                                'en' => 'English',
                            ])
                            ->default('fr'),
                        Forms\Components\Select::make('default_currency')
                            ->label('Default Currency')
                            ->options([
                                'MAD' => 'Moroccan Dirham (MAD)',
                                'TND' => 'Tunisian Dinar (TND)',
                                'DZD' => 'Algerian Dinar (DZD)',
                                'EUR' => 'Euro (EUR)',
                            ])
                            ->default('MAD'),
                    ])->columns(3),
                
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('save')
                        ->label('Save System Settings')
                        ->icon('heroicon-m-check')
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
        // You can save to database or config files

        Notification::make()
            ->title('System settings saved successfully')
            ->success()
            ->send();
    }
}