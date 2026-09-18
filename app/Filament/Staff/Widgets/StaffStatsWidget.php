<?php

namespace App\Filament\Staff\Widgets;

use App\Models\AidApplication;
use App\Models\Project;
use App\Models\School;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StaffStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected ?string $heading = 'Muhtasari wa Wanafunzi na Miradi (Staff Operations)';
    protected ?string $description = 'Takwimu za ufuatiliaji wa wanufaika na misaada ya elimu';

    protected function getStats(): array
    {
        $totalStudents       = Student::count();
        $activeStudents      = Student::where('status', 'Active')->count();
        $graduatedStudents   = Student::where('status', 'Graduated')->count();
        $activeProjects      = Project::where('status', 'Active')->count();
        $pendingApplications = AidApplication::where('status', 'Pending')->count();
        $totalSchools        = School::where('is_active', true)->count();

        return [
            Stat::make('Wanafunzi Wote', $totalStudents)
                ->description('Waliosajiliwa nchi nzima')
                ->descriptionIcon('heroicon-m-users')
                ->chart([10, 16, 22, 30, 42, 55, $totalStudents])
                ->color('primary'),

            Stat::make('Wanafunzi Hai', $activeStudents)
                ->description('Wanaopokea msaada sasa')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->chart([8, 14, 20, 26, 35, 48, $activeStudents])
                ->color('success'),

            Stat::make('Shule Washirika', $totalSchools)
                ->description('Shule zinazosimamiwa')
                ->descriptionIcon('heroicon-m-building-library')
                ->chart([1, 2, 2, 3, 3, 4, $totalSchools])
                ->color('info'),

            Stat::make('Miradi ya Elimu', $activeProjects)
                ->description(Project::count() . ' miradi jumla')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->chart([1, 2, 3, 4, 4, 5, $activeProjects])
                ->color('warning'),

            Stat::make('Wahitimu Waliofanikiwa', $graduatedStudents)
                ->description('Waliomaliza vyema masomo')
                ->descriptionIcon('heroicon-m-check-badge')
                ->chart([2, 4, 6, 8, 10, 12, $graduatedStudents])
                ->color('success'),

            Stat::make('Maombi Yanayosubiri', $pendingApplications)
                ->description('Yanahitaji ukaguzi wa wafanyakazi')
                ->descriptionIcon('heroicon-m-clock')
                ->chart([3, 5, 2, 6, 4, 7, $pendingApplications])
                ->color($pendingApplications > 0 ? 'danger' : 'success'),
        ];
    }
}
