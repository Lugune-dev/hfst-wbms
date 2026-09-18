<?php

namespace App\Filament\Teacher\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string $routePath = 'dashboard';
    protected static ?string $title = 'Dashibodi ya Mwalimu — Teacher Portal';

    public function getColumns(): int|array
    {
        return 3;
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Teacher\Widgets\TeacherWelcomeWidget::class,
            \App\Filament\Teacher\Widgets\TeacherStatsWidget::class,
            \App\Filament\Teacher\Widgets\TeacherStudentsLevelChartWidget::class,
            \App\Filament\Teacher\Widgets\TeacherRecentStudentsWidget::class,
        ];
    }
}
