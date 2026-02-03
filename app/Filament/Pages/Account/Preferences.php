<?php

namespace App\Filament\Pages\Account;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class Preferences extends Page
{
    protected static ?string $navigationIcon = null;
    
    protected static string $view = 'filament.pages.account.preferences';
    
    protected static ?string $title = 'Preferences';
    
    protected static ?string $slug = 'account/preferences';
    
    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'preferred_language' => session('locale', 'fr'),
            'date_format' => 'Y-m-d',
            'time_format' => '24',
            'theme' => 'system',
            'sidebar_collapsed' => 'auto',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Language & Region')
                    ->description('Set your language and regional preferences')
                    ->schema([
                        Forms\Components\Select::make('preferred_language')
                            ->label('Preferred Language')
                            ->options([
                                'fr' => 'Français',
                                'ar' => 'العربية',
                                'en' => 'English',
                            ])
                            ->default('fr'),
                        Forms\Components\Select::make('date_format')
                            ->label('Date Format')
                            ->options([
                                'Y-m-d' => '2026-02-03',
                                'd/m/Y' => '03/02/2026',
                                'm/d/Y' => '02/03/2026',
                                'd-m-Y' => '03-02-2026',
                            ])
                            ->default('Y-m-d'),
                        Forms\Components\Select::make('time_format')
                            ->label('Time Format')
                            ->options([
                                '24' => '24-hour (14:30)',
                                '12' => '12-hour (2:30 PM)',
                            ])
                            ->default('24'),
                    ])->columns(2),
                
                Forms\Components\Section::make('Interface Preferences')
                    ->description('Customize your interface experience')
                    ->schema([
                        Forms\Components\Select::make('theme')
                            ->label('Theme')
                            ->options([
                                'system' => 'System Default',
                                'light' => 'Light',
                                'dark' => 'Dark',
                            ])
                            ->default('system'),
                        Forms\Components\Select::make('sidebar_collapsed')
                            ->label('Sidebar Behavior')
                            ->options([
                                'expanded' => 'Always Expanded',
                                'collapsed' => 'Always Collapsed',
                                'auto' => 'Auto (based on screen size)',
                            ])
                            ->default('auto'),
                    ])->columns(2)
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Preferences')
                ->color('primary')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Save language preference
        if ($data['preferred_language']) {
            session(['locale' => $data['preferred_language']]);
        }

        Notification::make()
            ->title('Preferences updated successfully')
            ->success()
            ->send();
    }
}