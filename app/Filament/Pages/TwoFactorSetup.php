<?php

namespace App\Filament\Pages;

use App\Services\TwoFactorService;
use Filament\Forms\Components\Actions\Action as FormAction;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\HtmlString;

class TwoFactorSetup extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static string $view = 'filament.pages.two-factor-setup';

    public static function getNavigationGroup(): ?string
    {
        return __('app.securite');
    }

    protected static ?int $navigationSort = 10;

    public ?string $code = null;

    /**
     * When true => show setup UI (QR + secret + confirm code)
     * When false => show intro block with Enable button
     */
    public bool $showSetup = false;

    public static function getNavigationLabel(): string
    {
        return __('app.two_factor_setup');
    }

    public function getTitle(): string
    {
        return __('app.two_factor_authentication');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return ! auth()->user()?->two_factor_confirmed_at;
    }

    public function mount(): void
    {
        $user = auth()->user();

        if (! $user) {
            redirect()->route('filament.admin.auth.login');
            return;
        }

        // Already confirmed => go to recovery codes page
        if ($user->two_factor_confirmed_at) {
            redirect()->route('filament.admin.pages.two-factor-recovery-codes');
            return;
        }

        // If secret exists but not confirmed => show setup directly
        if ($user->two_factor_secret && ! $user->two_factor_confirmed_at) {
            $this->showSetup = true;
        }
    }

    public function form(Form $form): Form
    {
        $user = auth()->user();
        $twoFactorService = app(TwoFactorService::class);

        return $form
            ->schema([
                /**
                 * Intro / status (before enabling)
                 */
                Section::make()
                    ->schema([
                        Placeholder::make('info')
                            ->label('')
                            ->content(new HtmlString('
                                <div class="space-y-4">
                                    <div class="flex items-start gap-3 p-4 bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-700 rounded-xl">
                                        <div class="flex-shrink-0 mt-0.5">
                                            <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-sm font-semibold text-primary-900 dark:text-primary-100">
                                                ' . e(__('app.secure_account')) . '
                                            </h3>
                                            <p class="mt-1 text-sm text-primary-700 dark:text-primary-300">
                                                ' . e(__('app.two_factor_hint')) . '
                                            </p>
                                        </div>
                                    </div>

                                    <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                                        <div class="flex flex-wrap items-center gap-2">
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                ' . e(__('app.statut')) . ':
                                            </span>
                                            <span class="text-sm text-gray-600 dark:text-gray-400">
                                                ⊗ ' . e(__('app.two_factor_not_enabled')) . '
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            ')),
                    ])
                    ->visible(! $this->showSetup),

                /**
                 * Setup section (responsive)
                 * ✅ Correct logic: Step 1 has TWO OPTIONS (A/B), not step 1 then step 2.
                 * ✅ Step 2 = confirmation
                 */
                Section::make(__('app.two_factor_setup'))
                    ->description(__('app.setup_minimal_description'))
                    ->schema([
                        /**
                         * ✅ Step 1: Choose method
                         */
                        Section::make()
                            ->heading(new HtmlString('
                                <div class="flex items-center gap-2">
                                    <span class="flex items-center justify-center w-7 h-7 text-xs font-bold text-white bg-primary-600 rounded-full">1</span>
                                    <span class="font-semibold">' . e(__('app.add_to_authenticator_choose_method')) . '</span>
                                </div>
                            '))
                            ->description(__('app.choose_one_method_qr_or_key'))
                            ->schema([
                                Grid::make()
                                    ->columns([
                                        'default' => 1,
                                        'lg' => 2,
                                    ])
                                    ->schema([
                                        // Option A: QR
                                        Section::make()
                                            ->heading(new HtmlString('
                                                <div class="flex items-center gap-2">
                                                    <span class="flex items-center justify-center w-7 h-7 text-xs font-bold text-white bg-gray-600 rounded-full">A</span>
                                                    <span class="font-semibold">' . e(__('app.option_scan_qr')) . '</span>
                                                </div>
                                            '))
                                            ->schema([
                                                Placeholder::make('qr_display')
                                                    ->label('')
                                                    ->content(function () use ($user, $twoFactorService) {
                                                        if (! $user->two_factor_secret) {
                                                            return new HtmlString('
                                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                                    ' . e(__('app.enable_2fa_to_show_qr')) . '
                                                                </div>
                                                            ');
                                                        }

                                                        return new HtmlString('
                                                            <div class="w-full flex flex-col items-center gap-3">
                                                                <div class="bg-white dark:bg-gray-900 p-4 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm max-w-full overflow-auto">
                                                                    ' . $twoFactorService->qrCodeInline($user) . '
                                                                </div>
                                                                <div class="text-center">
                                                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                        ' . e(__('app.scan_with_app')) . '
                                                                    </p>
                                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                                        Google Authenticator, Authy, Microsoft Authenticator...
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        ');
                                                    }),
                                            ])
                                            ->columnSpan(1),

                                        // Option B: Manual key
                                        Section::make()
                                            ->heading(new HtmlString('
                                                <div class="flex items-center gap-2">
                                                    <span class="flex items-center justify-center w-7 h-7 text-xs font-bold text-white bg-gray-600 rounded-full">B</span>
                                                    <span class="font-semibold">' . e(__('app.option_manual_key')) . '</span>
                                                </div>
                                            '))
                                            ->description(__('app.secret_label'))
                                            ->schema([
                                                Placeholder::make('secret_display')
                                                    ->label('')
                                                    ->content(function () use ($user, $twoFactorService) {
                                                        $secret = $twoFactorService->getSecretKeyForSetup($user);

                                                        if (! $secret) {
                                                            return new HtmlString('
                                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                                    ' . e(__('app.enable_2fa_to_show_secret')) . '
                                                                </div>
                                                            ');
                                                        }

                                                        $pretty = trim(chunk_split($secret, 4, ' '));

                                                        return new HtmlString('
                                                            <div class="space-y-3">
                                                                <div class="p-4 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl overflow-x-auto">
                                                                    <div class="font-mono text-base sm:text-lg font-bold text-center text-gray-900 dark:text-gray-100 tracking-wider select-all whitespace-nowrap">
                                                                        ' . e($pretty) . '
                                                                    </div>
                                                                </div>

                                                                <div class="p-3 bg-info-50 dark:bg-info-900/20 border border-info-200 dark:border-info-700 rounded-xl">
                                                                    <p class="text-xs text-info-800 dark:text-info-200">
                                                                        <span class="font-semibold">' . e(__('app.manual_entry_helper')) . '</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        ');
                                                    }),
                                            ])
                                            ->columnSpan(1),
                                    ]),
                            ])
                            ->columnSpanFull(),

                        /**
                         * ✅ Step 2: Confirm
                         */
                        Section::make()
                            ->heading(new HtmlString('
                                <div class="flex items-center gap-2">
                                    <span class="flex items-center justify-center w-7 h-7 text-xs font-bold text-white bg-primary-600 rounded-full">2</span>
                                    <span class="font-semibold">' . e(__('app.confirm_activation')) . '</span>
                                </div>
                            '))
                            ->description(__('app.enter_6_digit_code'))
                            ->schema([
                                TextInput::make('code')
                                    ->label(__('app.authentication_code'))
                                    ->placeholder('000000')
                                    ->required()
                                    ->minLength(6)
                                    ->maxLength(6)
                                    ->regex('/^\d{6}$/')
                                    ->inputMode('numeric')
                                    ->autocomplete('one-time-code')
                                    ->extraAttributes([
                                        'class' => 'text-center text-xl sm:text-2xl font-mono tracking-[0.25em]',
                                    ])
                                    ->helperText(__('app.enter_code_help')),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->visible(fn () => $this->showSetup),
            ]);
    }

    public function enableTwoFactor(): void
    {
        $twoFactorService = app(TwoFactorService::class);
        $user = auth()->user();

        $twoFactorService->enable($user);

        $this->showSetup = true;

        Notification::make()
            ->success()
            ->title(__('app.two_factor_enabled_title'))
            ->body(__('app.scan_qr_to_continue'))
            ->send();
    }

    public function confirmTwoFactor(): void
    {
        $this->validate([
            'code' => ['required', 'string', 'regex:/^\d{6}$/'],
        ]);

        $twoFactorService = app(TwoFactorService::class);
        $user = auth()->user();

        // Check rate limit
        try {
            $twoFactorService->ensureNotRateLimited($user);
        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title(__('app.too_many_attempts'))
                ->body(__('app.try_again_later'))
                ->send();

            return;
        }

        if (! $twoFactorService->confirm($user, $this->code)) {
            $twoFactorService->incrementFailedAttempts($user);

            Notification::make()
                ->danger()
                ->title(__('app.invalid_code'))
                ->body(__('app.check_your_app'))
                ->send();

            return;
        }

        $twoFactorService->clearFailedAttempts($user);
        $twoFactorService->markAsVerified($user);

        Notification::make()
            ->success()
            ->title(__('app.two_factor_confirmed_title'))
            ->body(__('app.two_factor_active'))
            ->send();

        redirect()->route('filament.admin.pages.two-factor-recovery-codes');
    }

    protected function getFormActions(): array
    {
        $user = auth()->user();

        // During setup: show confirm button
        if ($this->showSetup && $user->two_factor_secret && ! $user->two_factor_confirmed_at) {
            return [
                FormAction::make('confirm')
                    ->label(__('app.confirm_activation'))
                    ->action('confirmTwoFactor')
                    ->color('success')
                    ->icon('heroicon-o-check-circle'),
            ];
        }

        // Before enabling: show enable button
        if (! $user->two_factor_secret) {
            return [
                FormAction::make('enable')
                    ->label(__('app.enable_2fa'))
                    ->action('enableTwoFactor')
                    ->color('primary')
                    ->icon('heroicon-o-shield-check'),
            ];
        }

        return [];
    }
}
