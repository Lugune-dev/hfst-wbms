<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;

use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class DonorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('donor')
            ->path('donor')
            ->login()
            ->brandName('HFST – Donor Portal')
            ->brandLogo(asset('images/logo.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('favicon.ico'))
            ->darkMode(true)
            ->renderHook('panels::head.end', fn () => '<link rel="stylesheet" href="' . asset('css/filament/hfst-panel.css') . '">')
            ->colors([
                'primary' => Color::hex('#13385E'),
                'success' => Color::hex('#2E7D32'),
                'warning' => Color::hex('#F6B219'),
                'danger'  => Color::hex('#DC2626'),
                'info'    => Color::hex('#1e5080'),
                'gray'    => Color::Slate,
            ])

            ->navigationGroups([
                NavigationGroup::make('My Donations'),
                NavigationGroup::make('Projects'),
                NavigationGroup::make('Account'),
            ])
            ->discoverResources(
                in: app_path('Filament/Donor/Resources'),
                for: 'App\\Filament\\Donor\\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Donor/Pages'),
                for: 'App\\Filament\\Donor\\Pages'
            )
            ->pages([
                \App\Filament\Donor\Pages\Dashboard::class,
            ])
            ->discoverWidgets(
                in: app_path('Filament/Donor/Widgets'),
                for: 'App\\Filament\\Donor\\Widgets'
            )
            ->widgets([
                \App\Filament\Donor\Widgets\DonorStatsWidget::class,
                \App\Filament\Donor\Widgets\DonorWelcomeWidget::class,
                \App\Filament\Donor\Widgets\DonorRecentDonationsWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->authGuard('web');
    }
}
