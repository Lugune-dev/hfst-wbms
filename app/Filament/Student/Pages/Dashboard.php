<?php

namespace App\Filament\Student\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string $routePath = 'dashboard';
    protected static ?string $title = 'Dashibodi Yangu — Mwanafunzi';

    public function getWidgets(): array
    {
        return [
            \App\Filament\Student\Widgets\StudentStatsWidget::class,
            \App\Filament\Student\Widgets\StudentWelcomeWidget::class,
            \App\Filament\Student\Widgets\StudentAidStatusWidget::class,
        ];
    }
}
