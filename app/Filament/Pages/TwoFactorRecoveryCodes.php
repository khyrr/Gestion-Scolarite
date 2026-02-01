<?php

namespace App\Filament\Pages;

use App\Services\TwoFactorService;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TwoFactorRecoveryCodes extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static string $view = 'filament.pages.two-factor-recovery-codes';

    public static function getNavigationGroup(): ?string
    {
        return __('app.securite');
    }

    protected static ?int $navigationSort = 11;

    public ?string $password = null;

    public bool $showCodes = false;

    public array $recoveryCodes = [];

    public static function getNavigationLabel(): string
    {
        return __('app.recovery_codes');
    }

    public function getTitle(): string
    {
        return __('app.two_factor_recovery_codes');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->two_factor_confirmed_at !== null;
    }

    public function mount(): void
    {
        $user = auth()->user();

        if (! $user?->two_factor_confirmed_at) {
            redirect()->route('filament.admin.pages.two-factor-setup');
            return;
        }

        // Optional: show automatically after setup
        if (session('show_recovery_codes')) {
            $this->showCodes = true;
            $this->loadRecoveryCodes();
            session()->forget('show_recovery_codes');
        }
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('password')
                ->label(__('app.current_password'))
                ->password()
                ->revealable()
                ->required()
                ->autocomplete('current-password')
                ->helperText(__('app.confirm_password_to_view'))
                ->visible(! $this->showCodes),
        ]);
    }

    // ----------------------------
    // Actions
    // ----------------------------

    protected function getFormActions(): array
    {
        if (! $this->showCodes) {
            return [
                Action::make('view')
                    ->label(__('app.view_codes'))
                    ->icon('heroicon-o-eye')
                    ->action('viewCodes')
                    ->color('primary'),
            ];
        }

        return [
            Action::make('copy_all')
                ->label(__('app.copy_all_codes') ?: 'Copier')
                ->icon('heroicon-o-clipboard-document')
                ->color('gray')
                ->action(function () {
                    $this->loadRecoveryCodes();

                    $plain = implode("\n", $this->recoveryCodes);

                    $this->dispatch('copy-to-clipboard', text: $plain);

                    Notification::make()
                        ->success()
                        ->title(__('app.codes_copied') ?: 'Codes copiés ✅')
                        ->send();
                }),

            Action::make('download')
                ->label(__('app.download_codes'))
                ->icon('heroicon-o-arrow-down-tray')
                ->action('downloadCodes')
                ->color('info'),

            Action::make('regenerate')
                ->label(__('app.regenerate_codes'))
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading(__('app.regenerate_codes_confirm'))
                ->modalDescription(__('app.regenerate_codes_warning'))
                ->form([
                    TextInput::make('password')
                        ->label(__('app.current_password'))
                        ->password()
                        ->revealable()
                        ->required()
                        ->autocomplete('current-password')
                        ->helperText(__('app.confirm_password_to_regenerate')),
                ])
                ->action(function (array $data) {
                    $this->assertPassword($data['password'] ?? null, 'data.password');

                    $twoFactorService = app(TwoFactorService::class);
                    $this->recoveryCodes = $twoFactorService->regenerateRecoveryCodes(auth()->user());

                    $this->showCodes = true;

                    Notification::make()
                        ->success()
                        ->title(__('app.codes_regenerated'))
                        ->body(__('app.old_codes_invalid'))
                        ->send();
                }),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('disable_2fa')
                ->label(__('app.disable_2fa'))
                ->icon('heroicon-o-shield-exclamation')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading(__('app.disable_2fa_confirm'))
                ->modalDescription(__('app.disable_2fa_warning'))
                ->form([
                    TextInput::make('password')
                        ->label(__('app.current_password'))
                        ->password()
                        ->revealable()
                        ->required()
                        ->autocomplete('current-password'),
                ])
                ->action(function (array $data) {
                    $this->assertPassword($data['password'] ?? null, 'data.password');

                    $twoFactorService = app(TwoFactorService::class);
                    $twoFactorService->disable(auth()->user());

                    Notification::make()
                        ->success()
                        ->title(__('app.two_factor_disabled'))
                        ->send();

                    redirect()->route('filament.admin.pages.dashboard');
                }),
        ];
    }

    // ----------------------------
    // Methods
    // ----------------------------

    public function viewCodes(): void
    {
        $this->assertPassword($this->password, 'password');

        //  load first, then show
        $this->loadRecoveryCodes();
        $this->showCodes = true;
        $this->password = null;

        //  forces immediate refresh in UI
        $this->dispatch('$refresh');


    }

    protected function loadRecoveryCodes(): void
    {
        $twoFactorService = app(TwoFactorService::class);
        $this->recoveryCodes = $twoFactorService->getRecoveryCodes(auth()->user());
    }

    public function downloadCodes()
    {
        $this->loadRecoveryCodes();

        $content = collect($this->recoveryCodes)
            ->map(fn ($code, $index) => ($index + 1) . '. ' . $code)
            ->implode("\n");

        $filename = 'recovery-codes-' . now()->format('Y-m-d') . '.txt';

        return response()->streamDownload(function () use ($content) {
            echo $content;
        }, $filename);
    }

    protected function assertPassword(?string $password, string $field): void
    {
        if (blank($password)) {
            throw ValidationException::withMessages([
                $field => __('app.password_required'),
            ]);
        }

        if (! Hash::check($password, auth()->user()->password)) {
            throw ValidationException::withMessages([
                $field => __('app.invalid_password'),
            ]);
        }
    }
}
