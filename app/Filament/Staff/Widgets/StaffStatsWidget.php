<?php

namespace App\Filament\Staff\Widgets;

use App\Models\AidApplication;
use App\Models\Project;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StaffStatsWidget extends BaseWidget
{
    protected ?string $heading = 'Muhtasari wa Shughuli';
    protected ?string $description = 'Hali ya sasa ya wanafunzi na miradi';

    protected function getStats(): array
    {
        $totalStudents       = Student::count();
        $activeStudents      = Student::where('status', 'Active')->count();
        $graduatedStudents   = Student::where('status', 'Graduated')->count();
        $droppedStudents     = Student::where('status', 'Dropped')->count();
        $activeProjects      = Project::where('status', 'Active')->count();
        $pendingApplications = AidApplication::where('status', 'Pending')->count();

        return [
            Stat::make('Wanafunzi Wote', $totalStudents)
                ->description('Waliosajiliwa mfumoni')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('primary'),

            Stat::make('Wanafunzi Hai', $activeStudents)
                ->description('Wanaosoma sasa hivi')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Wahitimu', $graduatedStudents)
                ->description('Waliomaliza masomo')
                ->descriptionIcon('heroicon-m-trophy')
                ->color('info'),

            Stat::make('Walioacha', $droppedStudents)
                ->description('Walioacha masomo')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),

            Stat::make('Miradi Hai', $activeProjects)
                ->description('Inayofanya kazi sasa')
                ->descriptionIcon('heroicon-m-folder-open')
                ->color('warning'),

            Stat::make('Maombi Yanayongoja', $pendingApplications)
                ->description('Yanasubiri ukaguzi')
                ->descriptionIcon('heroicon-m-inbox')
                ->color('gray'),
        ];
    }
}
