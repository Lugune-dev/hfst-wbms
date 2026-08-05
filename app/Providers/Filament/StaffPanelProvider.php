<?php

namespace App\Providers\Filament;

use App\Filament\Staff\Pages\Dashboard;
use App\Filament\Staff\Widgets\StaffStatsWidget;
use App\Filament\Staff\Widgets\StaffRecentStudentsWidget;
use App\Filament\Staff\Widgets\StaffProjectsWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class StaffPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('staff')
            ->path('staff')
            ->login()
            ->brandName('Hope for Students – Staff Portal')
            ->brandLogo(asset('images/logo.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('favicon.ico'))
            ->darkMode(true)
            ->renderHook('panels::head.end', fn () => '<link rel="stylesheet" href="' . asset('css/filament/hfst-panel.css') . '">')
            ->colors([
                'primary' => Color::hex('#2E7D32'),
                'success' => Color::hex('#2E7D32'),
                'warning' => Color::hex('#F6B219'),
                'danger'  => Color::hex('#DC2626'),
                'info'    => Color::hex('#1e5080'),
                'gray'    => Color::Slate,
            ])
            ->navigationGroups([
                NavigationGroup::make('1. Usimamizi wa Wanafunzi'),
                NavigationGroup::make('2. Usimamizi wa Miradi'),
                NavigationGroup::make('Finance'),
            ])
            ->discoverResources(in: app_path('Filament/Staff/Resources'), for: 'App\Filament\Staff\Resources')
            ->discoverPages(in: app_path('Filament/Staff/Pages'), for: 'App\Filament\Staff\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Staff/Widgets'), for: 'App\Filament\Staff\Widgets')
            ->widgets([
                \App\Filament\Staff\Widgets\StaffHeroWidget::class,
                StaffStatsWidget::class,
                StaffRecentStudentsWidget::class,
                StaffProjectsWidget::class,
                AccountWidget::class,
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
