<?php

namespace App\Providers\Filament;

use App\Filament\Admin\Pages\Dashboard;
use App\Filament\Admin\Widgets\DonationsChartWidget;
use App\Filament\Admin\Widgets\RecentDonationsWidget;
use App\Filament\Admin\Widgets\StatsOverviewWidget;
use App\Filament\Admin\Widgets\RecentActivitiesWidget;
use App\Filament\Admin\Widgets\PendingActionsWidget;
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

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Hope for Students Tanzania')
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
                NavigationGroup::make('People'),
                NavigationGroup::make('Finance'),
                NavigationGroup::make('Projects'),
                NavigationGroup::make('Content'),
                NavigationGroup::make('System'),
            ])
            ->discoverResources(
                in: app_path('Filament/Admin/Resources'),
                for: 'App\\Filament\\Admin\\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Admin/Pages'),
                for: 'App\\Filament\\Admin\\Pages'
            )
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(
                in: app_path('Filament/Admin/Widgets'),
                for: 'App\\Filament\\Admin\\Widgets'
            )
            ->widgets([
                \App\Filament\Admin\Widgets\AdminHeroWidget::class,
                StatsOverviewWidget::class,
                DonationsChartWidget::class,
                RecentDonationsWidget::class,
                RecentActivitiesWidget::class,
                PendingActionsWidget::class,
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
