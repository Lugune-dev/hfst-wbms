<?php

namespace App\Filament\Donor\Widgets;

use App\Models\Donation;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DonorStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected ?string $heading = 'Muhtasari wa Michango & Athari Yako (Your Giving Impact)';
    protected ?string $description = 'Asante sana kwa kuwezesha ndoto za wanafunzi wa Kitanzania!';

    protected function getStats(): array
    {
        $donor = auth()->user()->donor;

        $totalDonated = $donor 
            ? (float) Donation::where('donor_id', $donor->id)->where('status', 'Confirmed')->sum('amount') 
            : 250000;

        $donationsCount = $donor 
            ? Donation::where('donor_id', $donor->id)->where('status', 'Confirmed')->count() 
            : 2;

        $pendingDonations = $donor 
            ? Donation::where('donor_id', $donor->id)->where('status', 'Pending')->count() 
            : 0;

        $sponsoredStudents = $donor 
            ? Donation::where('donor_id', $donor->id)->where('status', 'Confirmed')->whereNotNull('student_id')->distinct('student_id')->count('student_id') 
            : 2;

        return [
            Stat::make('Jumla ya Michango', 'TZS ' . number_format($totalDonated, 0))
                ->description('Fedha zilizothibitishwa')
                ->descriptionIcon('heroicon-m-heart')
                ->chart([50000, 100000, 150000, 200000, 250000, (int)$totalDonated])
                ->color('success'),

            Stat::make('Michango Iliyothibitishwa', $donationsCount)
                ->description('Idadi ya awamu za michango')
                ->descriptionIcon('heroicon-m-check-badge')
                ->chart([1, 1, 2, 2, 3, $donationsCount])
                ->color('primary'),

            Stat::make('Wanafunzi Uliowasaidia', $sponsoredStudents)
                ->description('Maisha uliyoyagusa moja kwa moja')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->chart([1, 1, 2, 2, $sponsoredStudents])
                ->color('info'),

            Stat::make('Inayosubiri Kuthibitishwa', $pendingDonations)
                ->description('Michango inayoangaliwa')
                ->descriptionIcon('heroicon-m-clock')
                ->chart([0, 1, 0, $pendingDonations])
                ->color($pendingDonations > 0 ? 'warning' : 'gray'),
        ];
    }
}
