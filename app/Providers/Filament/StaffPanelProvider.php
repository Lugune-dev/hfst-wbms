<?php

namespace App\Providers\Filament;

use App\Filament\Staff\Pages\Dashboard;
use App\Filament\Staff\Widgets\StaffStatsWidget;
use App\Filament\Staff\Widgets\StaffRecentStudentsWidget;
use App\Filament\Staff\Widgets\StaffProjectsWidget;
use App\Filament\Staff\Widgets\StaffWelcomeWidget;
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
            ->passwordReset()
            ->brandName(fn () => app()->getLocale() === 'sw' ? 'Hope for Students – Mlango wa Watumishi' : 'Hope for Students – Staff Portal')
            ->brandLogo(fn () => view('filament.components.brand-logo'))
            ->brandLogoHeight('auto')
            ->favicon('/favicon.ico')
            ->darkMode(true)
            ->viteTheme('resources/css/filament/theme.css')
            ->profile(\App\Filament\Pages\Auth\EditProfile::class, isSimple: false)
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->renderHook('panels::user-menu.before', fn () => view('filament.widgets.language-switcher'))
            ->renderHook('panels::head.end', fn () => '<link rel="stylesheet" href="' . asset('css/filament/hfst-panel.css') . '">')
            ->renderHook('panels::simple-layout.start', fn () => view('filament.auth.login-header'))
            ->renderHook('panels::auth.login.form.after', fn () => view('filament.auth.login-footer'))
            ->colors([
                'primary' => Color::hex('#2E7D32'),
                'success' => Color::hex('#2E7D32'),
                'warning' => Color::hex('#F6B219'),
                'danger'  => Color::hex('#DC2626'),
                'info'    => Color::hex('#1e5080'),
                'gray'    => Color::Slate,
            ])
            ->navigationGroups([
                NavigationGroup::make(fn () => app()->getLocale() === 'sw' ? '1. Usimamizi wa Wanafunzi' : '1. Student Management'),
                NavigationGroup::make(fn () => app()->getLocale() === 'sw' ? '2. Usimamizi wa Miradi' : '2. Project Management'),
                NavigationGroup::make(fn () => app()->getLocale() === 'sw' ? '3. Fedha & Michango' : '3. Finance & Donations'),
                NavigationGroup::make(fn () => app()->getLocale() === 'sw' ? 'Maudhui & Mawasiliano' : 'Content & Media'),
            ])
            ->discoverResources(in: app_path('Filament/Staff/Resources'), for: 'App\Filament\Staff\Resources')
            ->discoverPages(in: app_path('Filament/Staff/Pages'), for: 'App\Filament\Staff\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Staff/Widgets'), for: 'App\Filament\Staff\Widgets')
            ->widgets([
                StaffWelcomeWidget::class,
                StaffStatsWidget::class,
                StaffRecentStudentsWidget::class,
                StaffProjectsWidget::class,
                AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                \App\Http\Middleware\SetLocale::class,
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
