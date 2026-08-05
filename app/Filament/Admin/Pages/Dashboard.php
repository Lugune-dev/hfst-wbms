<?php

namespace App\Filament\Admin\Pages;

use App\Models\AidApplication;
use App\Models\Donation;
use App\Models\Message;
use App\Models\Project;
use App\Models\Student;
use App\Models\User;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string $routePath = 'dashboard';
    protected static ?string $title = 'Admin Dashboard — HFST Control Center';

    public function getHeaderWidgetsColumns(): int|array
    {
        return 3;
    }

    public function getColumns(): int|array
    {
        return 3;
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Admin\Widgets\AdminHeroWidget::class,
            \App\Filament\Admin\Widgets\StatsOverviewWidget::class,
            \App\Filament\Admin\Widgets\DonationsChartWidget::class,
            \App\Filament\Admin\Widgets\RecentDonationsWidget::class,
            \App\Filament\Admin\Widgets\RecentActivitiesWidget::class,
            \App\Filament\Admin\Widgets\PendingActionsWidget::class,
        ];
    }
}
