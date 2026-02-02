<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\View\PanelsRenderHook;
use Filament\Support\Facades\FilamentView;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\NavigationGroup;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->navigationGroups([
                NavigationGroup::make(__('app.dashboard')),
                NavigationGroup::make(__('app.gestion_academique')),
                NavigationGroup::make(__('app.personnes')),
                NavigationGroup::make(__('app.gestion_financiere')),
                NavigationGroup::make(__('app.systeme')),
                NavigationGroup::make(__('app.securite')),
            ])
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
                'info' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'blue' => Color::Blue,
                'pink' => Color::Pink,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                \App\Filament\Pages\Dashboard::class,
            ])
            ->profile(isSimple: false)
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,

            ])
            ->bootUsing(function () {
                // Register a global loading overlay in the Filament panel body end
                FilamentView::registerRenderHook(
                    PanelsRenderHook::BODY_END,
                    fn () => view('filament.loading-overlay')
                );
            })
            ->brandName(function () {
                $user = auth()->user();
                if (!$user) return config('app.name');
                
                return __('app.administration_panel');
            })
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                // \App\Http\Middleware\EnsureTwoFactorIsVerified::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                \App\Http\Middleware\EnsureAdminRole::class,
            ])
            ->spa();
    }
}
