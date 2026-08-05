<?php

namespace App\Filament\Teacher\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            \App\Filament\Teacher\Widgets\TeacherHeroWidget::class,
            \App\Filament\Teacher\Widgets\TeacherStatsWidget::class,
            \App\Filament\Teacher\Widgets\TeacherRecentStudentsWidget::class,
        ];
    }
}
