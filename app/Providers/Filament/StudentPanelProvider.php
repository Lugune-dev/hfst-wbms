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

class StudentPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('student')
            ->path('student')
            ->login()
            ->passwordReset()
            ->brandName(fn () => app()->getLocale() === 'sw' ? 'HFST – Mlango wa Mwanafunzi' : 'HFST – Student Portal')
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
                'primary' => Color::hex('#13385E'),
                'success' => Color::hex('#2E7D32'),
                'warning' => Color::hex('#F6B219'),
                'danger'  => Color::hex('#DC2626'),
                'info'    => Color::hex('#1e5080'),
                'gray'    => Color::Slate,
            ])

            ->navigationGroups([
                NavigationGroup::make(fn () => app()->getLocale() === 'sw' ? 'Wasifu Wangu' : 'My Profile'),
                NavigationGroup::make(fn () => app()->getLocale() === 'sw' ? 'Elimu na Masomo' : 'Education'),
                NavigationGroup::make(fn () => app()->getLocale() === 'sw' ? 'Usaidizi wa Masomo' : 'Support'),
                NavigationGroup::make(fn () => app()->getLocale() === 'sw' ? 'Nyaraka & Ripoti' : 'Documents'),
            ])
            ->discoverResources(
                in: app_path('Filament/Student/Resources'),
                for: 'App\\Filament\\Student\\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Student/Pages'),
                for: 'App\\Filament\\Student\\Pages'
            )
            ->pages([
                \App\Filament\Student\Pages\Dashboard::class,
            ])
            ->discoverWidgets(
                in: app_path('Filament/Student/Widgets'),
                for: 'App\\Filament\\Student\\Widgets'
            )
            ->widgets([
                \App\Filament\Student\Widgets\StudentStatsWidget::class,
                \App\Filament\Student\Widgets\StudentWelcomeWidget::class,
                \App\Filament\Student\Widgets\StudentAidStatusWidget::class,
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
