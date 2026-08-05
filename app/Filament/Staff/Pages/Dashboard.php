<?php

namespace App\Filament\Staff\Pages;

use App\Models\AidApplication;
use App\Models\Project;
use App\Models\Student;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string $routePath = 'dashboard';
    protected static ?string $title = 'Staff Dashboard — Dashibodi ya Wafanyakazi';

    public function getWidgets(): array
    {
        return [
            \App\Filament\Staff\Widgets\StaffStatsWidget::class,
            \App\Filament\Staff\Widgets\StaffRecentStudentsWidget::class,
            \App\Filament\Staff\Widgets\StaffProjectsWidget::class,
        ];
    }
}
