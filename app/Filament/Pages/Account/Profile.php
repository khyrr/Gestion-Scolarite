<?php

namespace App\Filament\Pages\Account;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class Profile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    
    protected static string $view = 'filament.pages.account.profile';
    
    protected static ?string $title = 'Profile';
    
    protected static ?string $navigationLabel = 'My Account';
    
    protected static ?string $slug = 'account/profile';
    
    protected static bool $shouldRegisterNavigation = true;
    
    protected static ?int $navigationSort = 9999;

    public ?array $data = [];

    public function mount(): void
    {
        $user = auth()->user();
        $this->form->fill([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->telephone,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Profile Information')
                    ->description('Update your profile information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->disabled()
                            ->dehydrated(false)
                            ->helperText('Email cannot be changed. Contact administrator if needed.'),
                        Forms\Components\TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->maxLength(20),
                    ])->columns(2),
                
                Forms\Components\Section::make('Account Details')
                    ->description('View your account information')
                    ->schema([
                        Forms\Components\Placeholder::make('role')
                            ->label('Role')
                            ->content(fn () => auth()->user()->roles->pluck('name')->join(', ') ?: 'No roles assigned'),
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Account Created')
                            ->content(fn () => auth()->user()->created_at?->format('M d, Y') ?: 'Unknown'),
                        Forms\Components\Placeholder::make('last_login')
                            ->label('Last Login')
                            ->content(fn () => auth()->user()->last_login_at?->format('M d, Y H:i') ?: 'Never'),
                        Forms\Components\Placeholder::make('profile_info')
                            ->label('Profile Type')
                            ->content(function () {
                                $user = auth()->user();
                                if ($user->profile) {
                                    return class_basename($user->profile_type);
                                }
                                return 'No profile linked';
                            }),
                        Forms\Components\Placeholder::make('is_active')
                            ->label('Account Status')
                            ->content(function () {
                                $user = auth()->user();
                                $isActive = $user->is_active;
                                
                                if ($isActive) {
                                    return new \Illuminate\Support\HtmlString(
                                        '<div class="flex items-center gap-2">' .
                                        '<svg class="w-5 h-5 text-success-600 dark:text-success-400" fill="currentColor" viewBox="0 0 20 20">' .
                                        '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>' .
                                        '</svg>' .
                                        '<span class="text-sm font-medium text-success-600 dark:text-success-400">Active</span>' .
                                        '</div>'
                                    );
                                } else {
                                    return new \Illuminate\Support\HtmlString(
                                        '<div class="flex items-center gap-2">' .
                                        '<svg class="w-5 h-5 text-danger-600 dark:text-danger-400" fill="currentColor" viewBox="0 0 20 20">' .
                                        '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>' .
                                        '</svg>' .
                                        '<span class="text-sm font-medium text-danger-600 dark:text-danger-400">Inactive</span>' .
                                        '</div>'
                                    );
                                }
                            }),
                    ])->columns(3),
                
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('save')
                        ->label('Save Changes')
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
        return [
            // Actions are now handled within the form schema
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $user = auth()->user();

        // Only update editable fields (email is disabled)
        $user->update([
            'name' => $data['name'],
            'telephone' => $data['phone'] ?? null,
        ]);

        Notification::make()
            ->title('Profile updated successfully')
            ->success()
            ->send();
    }
}