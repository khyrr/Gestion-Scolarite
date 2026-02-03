<?php

namespace App\Filament\Pages\Account;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class Security extends Page
{
    protected static ?string $navigationIcon = null;
    
    protected static string $view = 'filament.pages.account.security';
    
    protected static ?string $title = 'Security';
    
    protected static ?string $slug = 'account/security';
    
    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Two-Factor Authentication')
                    ->description('Secure your account with two-factor authentication')
                    ->collapsible()
                    ->collapsed(fn () => auth()->user()->two_factor_confirmed_at !== null)
                    ->schema([
                        Forms\Components\Placeholder::make('two_factor_status')
                            ->label('Current Status')
                            ->content(function () {
                                $user = auth()->user();
                                $isEnabled = $user->two_factor_confirmed_at !== null;
                                
                                if ($isEnabled) {
                                    return new \Illuminate\Support\HtmlString(
                                        '<div class="flex items-center gap-2">' .
                                        '<svg class="w-5 h-5 text-success-600 dark:text-success-400" fill="currentColor" viewBox="0 0 20 20">' .
                                        '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>' .
                                        '</svg>' .
                                        '<span class="text-sm font-medium text-success-600 dark:text-success-400">Enabled</span>' .
                                        '</div>'
                                    );
                                } else {
                                    return new \Illuminate\Support\HtmlString(
                                        '<div class="flex items-center gap-2">' .
                                        '<svg class="w-5 h-5 text-danger-600 dark:text-danger-400" fill="currentColor" viewBox="0 0 20 20">' .
                                        '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>' .
                                        '</svg>' .
                                        '<span class="text-sm font-medium text-danger-600 dark:text-danger-400">Disabled</span>' .
                                        '</div>'
                                    );
                                }
                            }),
                        
                        // QR Code for setup
                        Forms\Components\Placeholder::make('qr_code')
                            ->label('QR Code')
                            ->content(function () {
                                $user = auth()->user();
                                if ($user->two_factor_confirmed_at !== null) {
                                    return '';
                                }
                                
                                $service = app(\App\Services\TwoFactorService::class);
                                return new \Illuminate\Support\HtmlString(
                                    '<div class="p-4 border rounded-lg bg-gray-50">' .
                                    '<p class="text-sm text-gray-600 mb-3">Scan this QR code with your authenticator app:</p>' .
                                    '<div class="flex justify-center">' .
                                    $service->qrCodeInline($user) .
                                    '</div>' .
                                    '</div>'
                                );
                            })
                            ->visible(fn () => auth()->user()->two_factor_confirmed_at === null),
                        
                        Forms\Components\Placeholder::make('secret_key')
                            ->label('Secret Key')
                            ->content(function () {
                                $user = auth()->user();
                                if ($user->two_factor_confirmed_at !== null) {
                                    return '';
                                }
                                
                                $service = app(\App\Services\TwoFactorService::class);
                                return new \Illuminate\Support\HtmlString(
                                    '<div class="p-3 bg-gray-50 border rounded-lg">' .
                                    '<p class="text-sm text-gray-600 mb-2">Or manually enter this key:</p>' .
                                    '<code class="bg-gray-100 px-2 py-1 rounded font-mono text-sm">' .
                                    e($service->getSecretKeyForSetup($user)) .
                                    '</code>' .
                                    '</div>'
                                );
                            })
                            ->visible(fn () => auth()->user()->two_factor_confirmed_at === null),
                        
                        Forms\Components\TextInput::make('two_factor_code')
                            ->label('Verification Code')
                            ->helperText('Enter the 6-digit code from your authenticator app')
                            ->numeric()
                            ->length(6)
                            ->placeholder('123456')
                            ->visible(fn () => auth()->user()->two_factor_confirmed_at === null),
                        
                        // Recovery codes for enabled 2FA
                        Forms\Components\Placeholder::make('backup_codes_info')
                            ->label('Recovery Codes')
                            ->content(function () {
                                $user = auth()->user();
                                $codes = json_decode(decrypt($user->two_factor_recovery_codes), true);
                                
                                return new \Illuminate\Support\HtmlString(
                                    '<div class="p-4 bg-amber-50 border border-amber-200 rounded-lg">' .
                                    '<p class="text-sm text-amber-800 mb-2 font-medium">Recovery Codes:</p>' .
                                    '<p class="text-xs text-amber-700 mb-3">Store these codes in a safe place. You can use them to access your account if you lose your device.</p>' .
                                    '<div class="grid grid-cols-2 gap-2">' .
                                    implode('', array_map(function($code) {
                                        return '<code class="bg-white px-2 py-1 rounded border text-xs font-mono">' . e($code) . '</code>';
                                    }, $codes)) .
                                    '</div>' .
                                    '</div>'
                                );
                            })
                            ->visible(fn () => auth()->user()->two_factor_confirmed_at !== null),
                        
                        // Action Buttons
                        Forms\Components\Actions::make([
                            Forms\Components\Actions\Action::make('enable_2fa')
                                ->label('Enable 2FA')
                                ->icon('heroicon-m-shield-check')
                                ->color('success')
                                ->action(function () {
                                    $this->enable2FA();
                                })
                                ->visible(fn () => auth()->user()->two_factor_confirmed_at === null),
                            
                            Forms\Components\Actions\Action::make('disable_2fa')
                                ->label('Disable 2FA')
                                ->icon('heroicon-m-shield-exclamation')
                                ->color('danger')
                                ->requiresConfirmation()
                                ->action(function () {
                                    $this->disable2FA();
                                })
                                ->visible(fn () => auth()->user()->two_factor_confirmed_at !== null),
                        ]),
                    ]),
                
                Forms\Components\Section::make('Change Password')
                    ->description('Update your account password')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('current_password')
                            ->label('Current Password')
                            ->password()
                            ->requiredWith('new_password')
                            ->currentPassword(),
                        Forms\Components\TextInput::make('new_password')
                            ->label('New Password')
                            ->password()
                            ->minLength(8)
                            ->confirmed()
                            ->requiredWith('current_password'),
                        Forms\Components\TextInput::make('new_password_confirmation')
                            ->label('Confirm New Password')
                            ->password()
                            ->requiredWith('new_password'),
                    ])->columns(1)
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Changes')
                ->color('primary')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $user = auth()->user();

        // Handle password change if provided
        if (!empty($data['new_password'])) {
            $user->update([
                'password' => \Hash::make($data['new_password'])
            ]);
            
            Notification::make()
                ->title('Password updated successfully')
                ->success()
                ->send();
        }
    }

    public function enable2FA(): void
    {
        $user = auth()->user();
        $service = app(\App\Services\TwoFactorService::class);

        $formState = $this->form->getState();
        $code = $formState['two_factor_code'] ?? null;

        if (empty($code)) {
            Notification::make()
                ->title('Code Required')
                ->body('Please enter the verification code from your authenticator app.')
                ->danger()
                ->send();
            return;
        }

        if (!$service->isEnabled($user)) {
            $service->enable($user);
        }

        if (!$service->verify($user, $code)) {
            Notification::make()
                ->title('Invalid Code')
                ->body('The verification code you entered is incorrect.')
                ->danger()
                ->send();
            return;
        }

        $user->forceFill([
            'two_factor_confirmed_at' => now(),
        ])->save();

        Notification::make()
            ->title('Two-Factor Authentication Enabled')
            ->body('Your account is now secured with two-factor authentication.')
            ->success()
            ->send();

        $this->form->fill($this->form->getState());
    }

    public function disable2FA(): void
    {
        $user = auth()->user();

        $user->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ])->save();

        Notification::make()
            ->title('Two-Factor Authentication Disabled')
            ->body('Two-factor authentication has been disabled for your account.')
            ->warning()
            ->send();

        $this->form->fill($this->form->getState());
    }
}