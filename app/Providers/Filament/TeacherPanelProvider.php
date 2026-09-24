<?php

namespace App\Providers\Filament;

use App\Filament\Teacher\Pages\Dashboard;
use App\Filament\Teacher\Widgets\TeacherRecentStudentsWidget;
use App\Filament\Teacher\Widgets\TeacherStatsWidget;
use App\Filament\Teacher\Widgets\TeacherWelcomeWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Models\School;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class TeacherPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('teacher')
            ->path('teacher')
            ->login()
            ->passwordReset()
            ->tenant(School::class, ownershipRelationship: 'schoolRelation')
            ->brandName('Hope for Students - Teacher Portal')
            ->brandLogo(asset('images/logo.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('favicon.ico'))
            ->darkMode(true)
            ->viteTheme('resources/css/filament/theme.css')
            ->profile(\App\Filament\Pages\Auth\EditProfile::class, isSimple: false)
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->renderHook('panels::user-menu.before', fn () => view('filament.widgets.language-switcher'))
            ->renderHook('panels::head.end', fn () => '<link rel="stylesheet" href="' . asset('css/filament/hfst-panel.css') . '">')
            ->renderHook('panels::auth.login.form.after', fn () => view('filament.auth.login-footer'))
            ->colors([
                'primary' => Color::hex('#13385E'),
                'success' => Color::hex('#2E7D32'),
                'warning' => Color::hex('#F6B219'),
                'danger'  => Color::hex('#DC2626'),
                'info'    => Color::hex('#1e5080'),
                'gray'    => Color::Slate,
            ])
            ->discoverResources(in: app_path('Filament/Teacher/Resources'), for: 'App\Filament\Teacher\Resources')
            ->discoverPages(in: app_path('Filament/Teacher/Pages'), for: 'App\Filament\Teacher\Pages')
            ->pages([
                \App\Filament\Teacher\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Teacher/Widgets'), for: 'App\Filament\Teacher\Widgets')
            ->widgets([
                TeacherWelcomeWidget::class,
                TeacherStatsWidget::class,
                TeacherRecentStudentsWidget::class,
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
            ]);
    }
}
