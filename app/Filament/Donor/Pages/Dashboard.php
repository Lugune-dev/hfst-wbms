<?php

namespace App\Filament\Donor\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string $routePath = 'dashboard';
    protected static ?string $title = 'Donor Dashboard — Impact Center';

    public function getWidgets(): array
    {
        return [
            \App\Filament\Donor\Widgets\DonorStatsWidget::class,
            \App\Filament\Donor\Widgets\DonorWelcomeWidget::class,
            \App\Filament\Donor\Widgets\DonorRecentDonationsWidget::class,
        ];
    }
}
