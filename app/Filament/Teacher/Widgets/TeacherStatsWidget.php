<?php

namespace App\Filament\Teacher\Widgets;

use App\Models\AidApplication;
use App\Models\Student;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TeacherStatsWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected ?string $heading = 'Muhtasari wa Shule (Tenant Analytics)';
    protected ?string $description = 'Takwimu za wanafunzi katika shule hii iliyochaguliwa';

    protected function getStats(): array
    {
        $tenant = Filament::getTenant();
        $query  = $tenant ? Student::where('school_id', $tenant->id) : Student::query();

        $totalStudents  = (clone $query)->count();
        $activeStudents = (clone $query)->where('status', 'Active')->count();
        $maleStudents   = (clone $query)->where('gender', 'Male')->count();
        $femaleStudents = (clone $query)->where('gender', 'Female')->count();

        $studentIds = (clone $query)->pluck('id');
        $pendingAid = AidApplication::whereIn('student_id', $studentIds)->where('status', 'Pending')->count();

        $schoolName = $tenant ? $tenant->name : 'Shule Yote';

        return [
            Stat::make('Wanafunzi wa Shule', $totalStudents)
                ->description($schoolName)
                ->descriptionIcon('heroicon-m-building-library')
                ->chart([5, 8, 12, 15, 18, 22, $totalStudents])
                ->color('primary'),

            Stat::make('Wanafunzi Hai', $activeStudents)
                ->description('Wanaosoma sasa shuleni')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->chart([4, 7, 10, 13, 16, 20, $activeStudents])
                ->color('success'),

            Stat::make('Wavulana / Wasichana', "{$maleStudents} 👦 · {$femaleStudents} 👧")
                ->description('Uwiano wa kijinsia shuleni')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart([$maleStudents, $femaleStudents, $maleStudents + $femaleStudents])
                ->color('info'),

            Stat::make('Maombi ya Msaada', $pendingAid)
                ->description('Wanafunzi wenye uhitaji wa msaada')
                ->descriptionIcon('heroicon-m-hand-raised')
                ->chart([1, 3, 2, 4, 3, 5, $pendingAid])
                ->color($pendingAid > 0 ? 'warning' : 'success'),
        ];
    }
}
