<?php

namespace App\Filament\Admin\Widgets;

use App\Models\AidApplication;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Project;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected ?string $heading = 'HFST Executive Metrics & Live Performance';
    protected ?string $description = 'Real-time overview across beneficiaries, finance, and educational partners';

    protected function getStats(): array
    {
        $totalDonations    = (float) Donation::where('status', 'Confirmed')->sum('amount');
        $totalStudents     = Student::count();
        $activeStudents    = Student::where('status', 'Active')->count();
        $graduatedStudents = Student::where('status', 'Graduated')->count();
        $totalDonors       = Donor::count();
        $pendingAid        = AidApplication::where('status', 'Pending')->count();
        $activeProjects    = Project::where('status', 'Active')->count();
        $totalSchools      = School::where('is_active', true)->count();

        return [
            Stat::make('Jumla ya Michango (TZS)', 'TZS ' . number_format($totalDonations, 0))
                ->description('Fedha zilizothibitishwa mfumoni')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([350000, 800000, 1500000, 2200000, 3100000, 4500000, (int)$totalDonations])
                ->color('success'),

            Stat::make('Wanafunzi Wanaofadhiliwa', $totalStudents)
                ->description($activeStudents . ' Hai · ' . $graduatedStudents . ' Wahitimu')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->chart([15, 22, 28, 35, 42, 50, $totalStudents])
                ->color('primary'),

            Stat::make('Shule Washirika', $totalSchools)
                ->description('Arusha, Moshi & Kilimanjaro')
                ->descriptionIcon('heroicon-m-building-library')
                ->chart([1, 2, 2, 3, 4, 4, $totalSchools])
                ->color('info'),

            Stat::make('Wafadhili Waliosajiliwa', $totalDonors)
                ->description('Individual & Corporate Donors')
                ->descriptionIcon('heroicon-m-heart')
                ->chart([5, 8, 12, 17, 22, 28, $totalDonors])
                ->color('warning'),

            Stat::make('Miradi ya Elimu', $activeProjects)
                ->description(Project::count() . ' miradi jumla')
                ->descriptionIcon('heroicon-m-folder-open')
                ->chart([2, 3, 3, 4, 5, 5, $activeProjects])
                ->color('success'),

            Stat::make('Maombi Yanayosubiri', $pendingAid)
                ->description('Aid requests pending review')
                ->descriptionIcon($pendingAid > 0 ? 'heroicon-m-exclamation-triangle' : 'heroicon-m-check-circle')
                ->chart([2, 5, 3, 7, 4, 8, $pendingAid])
                ->color($pendingAid > 0 ? 'danger' : 'success'),
        ];
    }
}
