<?php

namespace App\Filament\Admin\Widgets;

use App\Models\AidApplication;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Project;
use App\Models\Student;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected ?string $heading = 'System Overview';
    protected ?string $description = 'Real-time statistics for Hope for Students Tanzania';

    protected function getStats(): array
    {
        $totalDonations   = Donation::where('status', 'Confirmed')->sum('amount');
        $activeStudents   = Student::where('status', 'Active')->count();
        $graduatedStudents = Student::where('status', 'Graduated')->count();
        $pendingAid       = AidApplication::where('status', 'Pending')->count();
        $activeProjects   = Project::where('status', 'Active')->count();
        $totalUsers       = User::count();

        return [
            Stat::make('Wanafunzi Wote', Student::count())
                ->description($activeStudents . ' active · ' . $graduatedStudents . ' graduated')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 4]),

            Stat::make('Wafadhili (Donors)', Donor::count())
                ->description('Registered supporters')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Jumla ya Michango', 'TZS ' . number_format($totalDonations, 0))
                ->description('All confirmed donations')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),

            Stat::make('Miradi Hai', $activeProjects)
                ->description(Project::count() . ' total projects')
                ->descriptionIcon('heroicon-m-folder-open')
                ->color('primary'),

            Stat::make('Maombi Yanayongoja', $pendingAid)
                ->description('Aid applications pending review')
                ->descriptionIcon('heroicon-m-inbox')
                ->color('danger'),

            Stat::make('Watumiaji Wote', $totalUsers)
                ->description('All system users')
                ->descriptionIcon('heroicon-m-users')
                ->color('gray'),
        ];
    }
}
