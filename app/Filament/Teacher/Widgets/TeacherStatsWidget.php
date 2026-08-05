<?php

namespace App\Filament\Teacher\Widgets;

use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TeacherStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected ?string $heading = 'Muhtasari wa Wanafunzi';
    protected ?string $description = 'Takwimu za wanafunzi wako';

    protected function getStats(): array
    {
        $totalStudents     = Student::count();
        $activeStudents    = Student::where('status', 'Active')->count();
        $graduatedStudents = Student::where('status', 'Graduated')->count();
        $droppedStudents   = Student::where('status', 'Dropped')->count();
        $primary           = Student::where('education_level', 'Primary')->count();
        $secondary         = Student::where('education_level', 'Secondary')->count();
        $university        = Student::where('education_level', 'University')->count();

        return [
            Stat::make('Wanafunzi Wote', $totalStudents)
                ->description('Waliosajiliwa mfumoni')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('primary'),

            Stat::make('Wanafunzi Hai', $activeStudents)
                ->description('Wanaoendelea na masomo')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Wahitimu', $graduatedStudents)
                ->description('Waliomaliza masomo yao')
                ->descriptionIcon('heroicon-m-trophy')
                ->color('info'),

            Stat::make('Walioacha', $droppedStudents)
                ->description('Walioacha masomo')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),

            Stat::make('Sekondari', $secondary)
                ->description('Wanafunzi wa sekondari')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('warning'),

            Stat::make('Chuo Kikuu', $university)
                ->description('Wanafunzi wa chuo kikuu')
                ->descriptionIcon('heroicon-m-building-library')
                ->color('gray'),
        ];
    }
}
